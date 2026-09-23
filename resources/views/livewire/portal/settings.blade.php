@php
    $user = config('portal.user');
@endphp

<div x-data="{ tab: 'profile', mode: 'daily', emailOn: true, reminderOn: true, streakOn: false }">
    <x-portal.page-head
        eyebrow="Account"
        title="Settings."
        sub="Make the journey fit your life. None of this is permanent — change it anytime." />

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[220px_1fr]">
        <nav class="flex flex-row gap-1 overflow-x-auto lg:flex-col">
            @foreach ([['profile', 'Profile'], ['journey', 'Journey settings'], ['mode', 'Course mode'], ['notify', 'Notifications'], ['account', 'Account & billing']] as [$key, $label])
                <button type="button" x-on:click="tab = '{{ $key }}'"
                        class="whitespace-nowrap rounded-[10px] px-3.5 py-2.5 text-left text-[13.5px] transition-colors"
                        x-bind:class="tab === '{{ $key }}' ? 'bg-bg-deep font-semibold text-ink' : 'font-medium text-ink-2 hover:bg-ink/5'">
                    {{ $label }}
                </button>
            @endforeach
        </nav>

        <div class="flex flex-col gap-4">
            {{-- Profile --}}
            <div x-show="tab === 'profile'" class="rounded-[20px] border border-hair bg-paper p-6 lg:p-8">
                <h3 class="font-display text-[22px] font-bold leading-none tracking-[-0.025em]">Profile</h3>
                <p class="mt-2 text-[13.5px] text-ink-3">How you appear to yourself inside DevotionHub.</p>

                <div class="mt-6 flex flex-wrap items-center gap-5">
                    <div class="inline-flex size-20 items-center justify-center rounded-full bg-ink font-display text-[30px] font-bold text-white">{{ $user['initials'] }}</div>
                    <div>
                        <div class="flex flex-wrap gap-2">
                            <x-portal.button variant="soft">Upload photo</x-portal.button>
                            <x-portal.button variant="soft">Remove</x-portal.button>
                        </div>
                        <p class="mt-2 text-[12.5px] text-ink-3">JPG or PNG, up to 2 MB.</p>
                    </div>
                </div>

                <div class="mt-7 grid grid-cols-1 gap-5 sm:grid-cols-2">
                    @foreach ([['First name', $user['first_name']], ['Last name', $user['last_name']], ['Email', $user['email']], ['Display name', 'Grace W.']] as [$label, $value])
                        <div>
                            <label class="mb-2 block font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">{{ $label }}</label>
                            <input value="{{ $value }}"
                                   class="w-full rounded-[11px] border border-hair bg-bg px-4 py-3 text-[14px] transition-colors focus:border-ink focus:outline-none">
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 flex justify-end gap-2.5">
                    <x-portal.button variant="soft">Discard</x-portal.button>
                    <x-portal.button variant="primary">Save profile</x-portal.button>
                </div>
            </div>

            {{-- Journey --}}
            <div x-show="tab === 'journey'" x-cloak class="rounded-[20px] border border-hair bg-paper p-6 lg:p-8">
                <h3 class="font-display text-[22px] font-bold leading-none tracking-[-0.025em]">Journey settings</h3>
                <p class="mt-2 text-[13.5px] text-ink-3">Tune the rhythm — when you read, in what translation, and how you'd like to be reminded.</p>

                <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div>
                        <label class="mb-2 block font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">Start date</label>
                        <input value="{{ $user['started_at'] }}" class="w-full rounded-[11px] border border-hair bg-bg px-4 py-3 text-[14px] focus:border-ink focus:outline-none">
                    </div>
                    <div>
                        <label class="mb-2 block font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">Preferred email time</label>
                        <input type="time" value="{{ $user['email_time'] }}" class="w-full rounded-[11px] border border-hair bg-bg px-4 py-3 text-[14px] focus:border-ink focus:outline-none">
                    </div>
                    <div>
                        <label class="mb-2 block font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">Timezone</label>
                        <select class="w-full rounded-[11px] border border-hair bg-bg px-4 py-3 text-[14px] focus:border-ink focus:outline-none">
                            @foreach (['America/Denver', 'America/New_York', 'America/Los_Angeles', 'Europe/London', 'Pacific/Auckland'] as $tz)
                                <option @selected($tz === $user['timezone'])>{{ $tz }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-2 block font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">Bible translation</label>
                        <select class="w-full rounded-[11px] border border-hair bg-bg px-4 py-3 text-[14px] focus:border-ink focus:outline-none">
                            @foreach (['KJV', 'ESV', 'NIV', 'NLT', 'CSB'] as $t)
                                <option @selected($t === $user['translation'])>{{ $t }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Course mode --}}
            <div x-show="tab === 'mode'" x-cloak class="rounded-[20px] border border-hair bg-paper p-6 lg:p-8">
                <h3 class="font-display text-[22px] font-bold leading-none tracking-[-0.025em]">Course mode</h3>
                <p class="mt-2 text-[13.5px] text-ink-3">Walk the journey at your pace. You can change this at any time.</p>

                <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-3">
                    @foreach ([['daily', 'Daily mode', 'One lesson per day, at your chosen time.'], ['self', 'Self-paced', 'Move at your own rhythm. No daily emails.'], ['pause', 'Pause journey', 'Pause indefinitely. Resume anytime.']] as [$key, $name, $desc])
                        <button type="button" x-on:click="mode = '{{ $key }}'"
                                class="rounded-[14px] border p-5 text-left transition-all"
                                x-bind:class="mode === '{{ $key }}' ? 'border-ink bg-bg-deep' : 'border-hair bg-bg hover:border-hair-soft'">
                            <div class="font-display text-[17px] font-bold tracking-[-0.02em] text-ink">{{ $name }}</div>
                            <div class="mt-1.5 text-[12.5px] leading-[1.5] text-ink-3">{{ $desc }}</div>
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Notifications --}}
            <div x-show="tab === 'notify'" x-cloak class="rounded-[20px] border border-hair bg-paper p-6 lg:p-8">
                <h3 class="font-display text-[22px] font-bold leading-none tracking-[-0.025em]">Notifications</h3>
                <p class="mt-2 text-[13.5px] text-ink-3">We keep it minimal. Only what helps you return.</p>

                <div class="mt-5">
                    @foreach ([['emailOn', 'Daily email reminder', "A short, warm email each morning with today's lesson."], ['reminderOn', 'Browser reminder', 'A quiet nudge from this device at your chosen time.'], ['streakOn', 'Streak alerts', 'Off by default. We never want to shame you for missing a day.']] as [$model, $name, $desc])
                        <div class="flex items-center justify-between gap-6 border-b border-hair py-4 last:border-0">
                            <div>
                                <div class="font-display text-[15px] font-bold tracking-[-0.02em] text-ink">{{ $name }}</div>
                                <div class="mt-1 text-[12.5px] leading-[1.5] text-ink-3">{{ $desc }}</div>
                            </div>
                            <button type="button" x-on:click="{{ $model }} = ! {{ $model }}"
                                    class="relative h-6 w-11 flex-none rounded-full transition-colors"
                                    x-bind:class="{{ $model }} ? 'bg-olive' : 'bg-hair-soft'"
                                    role="switch" x-bind:aria-checked="{{ $model }}">
                                <span class="absolute top-0.5 size-5 rounded-full bg-white transition-all"
                                      x-bind:class="{{ $model }} ? 'left-[22px]' : 'left-0.5'"></span>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Account --}}
            <template x-if="tab === 'account'">
                <div class="flex flex-col gap-4">
                    <div class="rounded-[20px] border border-hair bg-paper p-6 lg:p-8">
                        <h3 class="font-display text-[22px] font-bold leading-none tracking-[-0.025em]">Account</h3>
                        <p class="mt-2 text-[13.5px] text-ink-3">Sign-in and billing.</p>
                        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div>
                                <label class="mb-2 block font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">Current password</label>
                                <input type="password" value="password" class="w-full rounded-[11px] border border-hair bg-bg px-4 py-3 text-[14px] focus:border-ink focus:outline-none">
                            </div>
                            <div>
                                <label class="mb-2 block font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">New password</label>
                                <input type="password" class="w-full rounded-[11px] border border-hair bg-bg px-4 py-3 text-[14px] focus:border-ink focus:outline-none">
                            </div>
                        </div>
                        <div class="mt-5 flex flex-wrap gap-2.5">
                            <x-portal.button variant="primary">Update password</x-portal.button>
                            <x-portal.button variant="soft">Enable two-factor</x-portal.button>
                        </div>
                    </div>

                    <div class="rounded-[20px] border border-hair bg-paper p-6 lg:p-8">
                        <h3 class="font-display text-[22px] font-bold leading-none tracking-[-0.025em]">Billing</h3>
                        <p class="mt-2 text-[13.5px] text-ink-3">{{ $user['plan'] }} &middot; Free for first 7 days, then $4/mo.</p>
                        <div class="mt-5 flex flex-wrap gap-2.5">
                            <x-portal.button variant="soft">Manage subscription</x-portal.button>
                            <x-portal.button variant="soft">View invoices</x-portal.button>
                        </div>
                    </div>

                    <div class="rounded-[20px] border border-[#B33]/30 bg-paper p-6 lg:p-8">
                        <h3 class="font-display text-[22px] font-bold leading-none tracking-[-0.025em] text-[#B33]">Delete account</h3>
                        <p class="mt-2 text-[13.5px] text-ink-3">This permanently removes your account, journal entries, and saved prayers. We cannot recover them.</p>
                        <button type="button" class="mt-5 inline-flex items-center rounded-full border border-[#B33] px-[18px] py-3 text-[13.5px] font-semibold leading-none text-[#B33] transition-colors hover:bg-[#B33] hover:text-white">
                            Delete my account
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
