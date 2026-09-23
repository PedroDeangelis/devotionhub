<div class="flex min-h-screen items-center justify-center px-6 py-12">
    <div class="w-full max-w-[420px]">
        <div class="mb-10 flex items-center gap-3">
            <span class="relative inline-flex size-[30px] flex-none items-center justify-center rounded-md bg-black" aria-hidden="true">
                <span class="diamond absolute inset-[7px] bg-gold"></span>
            </span>
            <span class="font-display text-lg font-extrabold tracking-[0.02em] text-ink">
                DevotionHub<span class="text-gold">.</span>
            </span>
            <span class="ml-1 rounded-full border border-hair bg-paper px-2.5 py-1 font-mono text-[9.5px] font-semibold uppercase tracking-[0.16em] text-gold">Admin</span>
        </div>

        <form wire:submit="login">
            <div class="inline-flex items-center gap-2.5 font-mono text-[10.5px] font-medium uppercase tracking-[0.22em] text-ink-3">
                <span class="size-1.5 rounded-full bg-gold"></span>
                Administration
            </div>

            <h1 class="mb-3 mt-4 font-display text-[42px] font-extrabold leading-[0.96] tracking-[-0.035em]">
                Sign in to<br>the console.
            </h1>

            <p class="mb-8 text-[15px] leading-[1.55] text-ink-3">
                This area is restricted to administrators.
            </p>

            <div class="mb-4">
                <label for="email" class="mb-[7px] block font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">Email address</label>
                <input type="email" id="email" wire:model="email" required autofocus autocomplete="email"
                       placeholder="you@example.com"
                       class="w-full rounded-[11px] border border-hair bg-paper px-4 py-[15px] text-[15px] transition-colors placeholder:text-hair-soft focus:border-ink focus:outline-none">
            </div>

            <div class="mb-4" x-data="{ show: false }">
                <label for="password" class="mb-[7px] flex items-center justify-between font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">
                    Password
                    <button type="button" x-on:click="show = ! show"
                            class="font-mono text-[10px] font-semibold uppercase tracking-[0.14em] text-gold">
                        <span x-text="show ? 'Hide' : 'Show'">Show</span>
                    </button>
                </label>
                <input id="password" wire:model="password" required autocomplete="current-password"
                       placeholder="••••••••" type="password"
                       x-bind:type="show ? 'text' : 'password'"
                       class="w-full rounded-[11px] border border-hair bg-paper px-4 py-[15px] text-[15px] transition-colors placeholder:text-hair-soft focus:border-ink focus:outline-none">
            </div>

            @error('email')
                <div class="mb-3.5 rounded-[10px] border border-[#EBD3D3] bg-[#FBEEEE] px-3.5 py-[11px] text-[13px] text-[#9B3B3B]">{{ $message }}</div>
            @enderror

            @error('password')
                <div class="mb-3.5 rounded-[10px] border border-[#EBD3D3] bg-[#FBEEEE] px-3.5 py-[11px] text-[13px] text-[#9B3B3B]">{{ $message }}</div>
            @enderror

            <label for="remember" class="mb-[22px] mt-1 inline-flex cursor-pointer items-center gap-[9px] text-[13px] text-ink-3">
                <input type="checkbox" id="remember" wire:model="remember" class="size-4 cursor-pointer accent-ink">
                <span>Keep me signed in</span>
            </label>

            <button type="submit" wire:loading.attr="disabled"
                    class="inline-flex w-full items-center justify-center gap-2.5 rounded-full bg-black px-[22px] py-[17px] text-sm font-semibold leading-none text-white transition-transform hover:-translate-y-px disabled:translate-y-0 disabled:cursor-default disabled:opacity-70">
                <span wire:loading.remove wire:target="login">Sign in</span>
                <span wire:loading wire:target="login">Signing you in…</span>
            </button>
        </form>

        <p class="mt-8 text-center text-[13px] text-ink-3">
            Not an administrator?
            <a href="{{ route('login') }}" wire:navigate class="font-semibold text-ink underline decoration-gold underline-offset-[3px]">Student sign in</a>
        </p>
    </div>
</div>
