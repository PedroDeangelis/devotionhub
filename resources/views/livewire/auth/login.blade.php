<div class="grid min-h-screen grid-cols-1 min-[1100px]:grid-cols-[minmax(0,1fr)_560px]">
    {{-- ---------------------------------------------------------------- --}}
    {{-- Left: the form                                                    --}}
    {{-- ---------------------------------------------------------------- --}}
    <div class="flex min-w-0 flex-col px-6 pb-8 pt-10 sm:px-10 min-[1100px]:px-14">
        {{-- Wordmark --}}
        <div class="flex-none">
            <span class="inline-flex items-center gap-[11px]">
                <span class="relative inline-flex size-[30px] items-center justify-center rounded-md bg-black">
                    <span class="absolute inset-[7px] bg-gold [clip-path:polygon(50%_0,100%_50%,50%_100%,0_50%)]"></span>
                </span>
                <span class="font-display text-lg font-extrabold tracking-[0.02em]">
                    DEVOTION<span class="text-gold">.</span>
                </span>
            </span>
        </div>

        {{-- Form --}}
        <div class="flex flex-1 items-center py-10">
            <form wire:submit="login" class="w-full max-w-[440px]">
                <div class="inline-flex items-center gap-[9px] font-mono text-[10.5px] font-medium uppercase tracking-[0.22em] text-ink-3">
                    <span class="size-1.5 rounded-full bg-gold"></span>
                    Welcome back
                </div>

                <h1 class="mb-3.5 mt-[18px] font-display text-[56px] font-extrabold leading-[0.94] tracking-[-0.038em]">
                    Continue<br>your journey.
                </h1>

                <p class="mb-[30px] max-w-[40ch] text-base leading-[1.5] text-ink-3">
                    Day 12 is waiting. Sign in to pick up where you left off.
                </p>

                {{-- Social sign-in: not wired up yet, so shown disabled. --}}
                <div class="grid grid-cols-1 gap-2.5 sm:grid-cols-2">
                    <button type="button" disabled title="Social sign-in isn't available yet"
                            class="inline-flex cursor-not-allowed items-center justify-center gap-[9px] whitespace-nowrap rounded-full border border-hair bg-paper px-[18px] py-[13px] text-[13.5px] font-semibold leading-none text-ink opacity-40">
                        <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill="#4285F4" d="M22.6 12.2c0-.7-.1-1.4-.2-2H12v4h6a5 5 0 01-2.2 3.3v2.8h3.5c2-1.9 3.3-4.7 3.3-8.1z"/>
                            <path fill="#34A853" d="M12 23c3 0 5.5-1 7.3-2.7l-3.5-2.8c-1 .7-2.3 1.1-3.8 1.1-2.9 0-5.4-2-6.3-4.6H2v2.9A11 11 0 0012 23z"/>
                            <path fill="#FBBC05" d="M5.7 14c-.2-.7-.4-1.4-.4-2.1s.1-1.4.4-2.1V6.9H2A11 11 0 001 12c0 1.8.4 3.5 1 5l3.7-3z"/>
                            <path fill="#EA4335" d="M12 4.8c1.6 0 3.1.6 4.2 1.7l3.1-3.1A11 11 0 002 6.9l3.7 2.9C6.6 6.8 9.1 4.8 12 4.8z"/>
                        </svg>
                        Continue with Google
                    </button>

                    <button type="button" disabled title="Social sign-in isn't available yet"
                            class="inline-flex cursor-not-allowed items-center justify-center gap-[9px] whitespace-nowrap rounded-full border border-hair bg-paper px-[18px] py-[13px] text-[13.5px] font-semibold leading-none text-ink opacity-40">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M17.05 12.6c0-2.4 2-3.6 2.1-3.6-1.1-1.7-2.9-1.9-3.5-1.9-1.5-.2-2.9.9-3.7.9-.8 0-1.9-.9-3.1-.8-1.6 0-3.1.9-3.9 2.3-1.7 2.9-.4 7.2 1.2 9.6.8 1.2 1.7 2.5 3 2.4 1.2 0 1.6-.8 3.1-.8 1.4 0 1.8.8 3.1.7 1.3 0 2.1-1.2 2.9-2.3.9-1.3 1.3-2.6 1.3-2.7 0 0-2.5-1-2.5-3.8zM14.6 5.2c.7-.8 1.1-2 1-3.2-1 0-2.2.7-2.9 1.5-.6.7-1.2 1.9-1 3 1.1.1 2.2-.6 2.9-1.3z"/>
                        </svg>
                        Continue with Apple
                    </button>
                </div>

                <div class="my-6 flex items-center gap-3.5 font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">
                    <span class="h-px flex-1 bg-hair"></span>
                    <span>or use your email</span>
                    <span class="h-px flex-1 bg-hair"></span>
                </div>

                {{-- Email --}}
                <div class="mb-4 block">
                    <label for="email" class="mb-[7px] flex items-center justify-between font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">
                        Email address
                    </label>
                    <input type="email" id="email" wire:model="email" required autofocus autocomplete="email"
                           placeholder="grace@example.com"
                           class="w-full rounded-[11px] border border-hair bg-paper px-4 py-[15px] text-[15px] transition-colors placeholder:text-hair-soft focus:border-ink focus:outline-none">
                </div>

                {{-- Password. The show/hide toggle is presentation only. --}}
                <div class="mb-4 block" x-data="{ show: false }">
                    <label for="password" class="mb-[7px] flex items-center justify-between font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">
                        Password
                        <button type="button" x-on:click="show = !show"
                                class="font-mono text-[10px] font-semibold uppercase tracking-[0.14em] text-gold">
                            <span x-text="show ? 'Hide' : 'Show'">Show</span>
                        </button>
                    </label>
                    <input id="password" wire:model="password" required autocomplete="current-password"
                           placeholder="••••••••"
                           x-bind:type="show ? 'text' : 'password'" type="password"
                           class="w-full rounded-[11px] border border-hair bg-paper px-4 py-[15px] text-[15px] transition-colors placeholder:text-hair-soft focus:border-ink focus:outline-none">
                </div>

                @error('email')
                    <div class="mb-3.5 rounded-[10px] border border-[#EBD3D3] bg-[#FBEEEE] px-3.5 py-[11px] text-[13px] text-[#9B3B3B]">{{ $message }}</div>
                @enderror

                @error('password')
                    <div class="mb-3.5 rounded-[10px] border border-[#EBD3D3] bg-[#FBEEEE] px-3.5 py-[11px] text-[13px] text-[#9B3B3B]">{{ $message }}</div>
                @enderror

                <div class="mb-[22px] mt-1 flex items-center justify-between gap-4">
                    <label for="remember" class="inline-flex cursor-pointer items-center gap-[9px] text-[13px] text-ink-3">
                        <input type="checkbox" id="remember" wire:model="remember"
                               class="size-4 cursor-pointer accent-ink">
                        <span>Keep me signed in</span>
                    </label>

                    <button type="button" disabled title="Password reset isn't available yet"
                            class="cursor-not-allowed text-[13px] text-ink-3 underline decoration-hair-soft underline-offset-[3px] opacity-40">
                        Forgot password?
                    </button>
                </div>

                <button type="submit" wire:loading.attr="disabled"
                        class="group inline-flex w-full items-center justify-center gap-[9px] whitespace-nowrap rounded-full bg-black px-[22px] py-[17px] text-sm font-semibold leading-none text-white transition-transform hover:-translate-y-px disabled:translate-y-0 disabled:cursor-default disabled:opacity-70">
                    <span wire:loading.remove wire:target="login">Sign in</span>
                    <span wire:loading wire:target="login">Signing you in…</span>
                    <span wire:loading.remove wire:target="login"
                          class="arrow-mask h-2.5 w-3.5 bg-current transition-transform group-hover:translate-x-0.5"></span>
                </button>

                <p class="mt-5 text-center text-[13.5px] text-ink-3">
                    New here?
                    <button type="button" disabled title="Registration isn't available yet"
                            class="cursor-not-allowed font-semibold text-ink underline decoration-gold underline-offset-[3px] opacity-40">
                        Start the 90-day journey
                    </button>
                </p>
            </form>
        </div>

        {{-- Footer --}}
        <div class="flex items-center justify-between gap-5 border-t border-hair pt-[22px] font-mono text-[10.5px] font-medium uppercase tracking-[0.14em] text-muted">
            <span>&copy; {{ date('Y') }} DEVOTION</span>
            <span class="flex gap-1.5">
                <i class="size-[5px] rounded-full bg-gold"></i>
                <i class="size-[5px] rounded-full bg-hair-soft"></i>
                <i class="size-[5px] rounded-full bg-hair-soft"></i>
            </span>
            <button type="button" disabled title="Support isn't available yet"
                    class="cursor-not-allowed text-[13px] normal-case tracking-normal text-ink-3 underline decoration-hair-soft underline-offset-[3px] opacity-40">
                Need help?
            </button>
        </div>
    </div>

    {{-- ---------------------------------------------------------------- --}}
    {{-- Right: testimonial rail                                           --}}
    {{-- ---------------------------------------------------------------- --}}
    <aside class="relative hidden flex-col justify-between overflow-hidden bg-black px-12 pb-11 pt-10 text-white min-[1100px]:flex">
        <span class="rail-glow pointer-events-none absolute -right-[30%] -top-[20%] size-[600px] rounded-full"></span>

        <div class="relative">
            <span class="inline-flex items-center gap-[9px] rounded-full border border-gold/30 px-[13px] py-[7px] font-mono text-[10px] font-semibold uppercase tracking-[0.2em] text-gold">
                The 90-Day Bible Journey
            </span>
        </div>

        <div class="relative">
            <div class="mb-[22px] font-display text-[80px] leading-[0.5] text-gold">&ldquo;</div>
            <blockquote class="m-0 font-display text-[40px] font-bold leading-[1.06] tracking-[-0.032em] text-white">
                I've started a hundred Bible plans. This is the <em class="not-italic text-gold">first one</em> I've finished.
            </blockquote>
            <div class="mt-8 flex items-center gap-[13px]">
                <span class="inline-flex size-[42px] flex-none items-center justify-center rounded-full bg-gold font-display text-[17px] font-bold text-black">M</span>
                <span>
                    <b class="block text-sm font-semibold">Maren A.</b>
                    <i class="mt-0.5 block text-[12.5px] not-italic text-white/50">Completed Day 90 &middot; Auckland, NZ</i>
                </span>
            </div>
        </div>

        <div class="relative">
            <div class="grid grid-cols-3 gap-5 border-b border-white/10 pb-[26px]">
                <div>
                    <b class="block font-display text-[34px] font-extrabold leading-[0.9] tracking-[-0.035em]">90</b>
                    <i class="mt-2 block font-mono text-[9.5px] font-medium not-italic uppercase leading-[1.4] tracking-[0.14em] text-white/45">Days, Genesis to Jesus</i>
                </div>
                <div>
                    <b class="block font-display text-[34px] font-extrabold leading-[0.9] tracking-[-0.035em]">12</b>
                    <i class="mt-2 block font-mono text-[9.5px] font-medium not-italic uppercase leading-[1.4] tracking-[0.14em] text-white/45">Minutes a day</i>
                </div>
                <div>
                    <b class="block font-display text-[34px] font-extrabold leading-[0.9] tracking-[-0.035em]">4.2K</b>
                    <i class="mt-2 block font-mono text-[9.5px] font-medium not-italic uppercase leading-[1.4] tracking-[0.14em] text-white/45">Walking it today</i>
                </div>
            </div>

            <div class="mt-[26px] max-w-[34ch] font-display text-[17px] font-medium leading-[1.25] tracking-[-0.018em] text-white/85">
                Thy word is a lamp unto my feet, and a light unto my path.
                <span class="mt-3 block font-mono text-[9.5px] font-medium uppercase tracking-[0.18em] text-white/40">Psalm 119:105 &middot; KJV</span>
            </div>
        </div>
    </aside>
</div>
