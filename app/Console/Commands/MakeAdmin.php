<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password as promptPassword;
use function Laravel\Prompts\text;

class MakeAdmin extends Command
{
    protected $signature = 'make:admin
                            {--name= : The administrator\'s name}
                            {--email= : The administrator\'s email address}
                            {--password= : The administrator\'s password}';

    protected $description = 'Create a new administrator, or promote an existing user to one';

    public function handle(): int
    {
        $name = $this->option('name') ?: text(
            label: 'Name',
            required: true,
        );

        $email = $this->option('email') ?: text(
            label: 'Email address',
            required: true,
        );

        $existing = User::where('email', $email)->first();

        /*
         * Promoting an existing account is the common case when someone has
         * already signed up, so do not force them to pick a new password.
         */
        if ($existing) {
            if ($existing->is_admin) {
                $this->components->info("{$existing->email} is already an administrator.");

                return self::SUCCESS;
            }

            $existing->update(['is_admin' => true]);
            $this->components->info("Promoted {$existing->email} to administrator.");

            return self::SUCCESS;
        }

        $password = $this->option('password') ?: promptPassword(
            label: 'Password',
            required: true,
        );

        $validator = Validator::make(
            ['name' => $name, 'email' => $email, 'password' => $password],
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', Password::default()],
            ],
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->components->error($error);
            }

            return self::FAILURE;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $user->forceFill(['is_admin' => true])->save();

        $this->components->info("Created administrator {$user->email}.");

        return self::SUCCESS;
    }
}
