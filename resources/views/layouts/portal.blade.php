@php
    $portal = config('portal');
    $today = $portal['today_day'];
    $total = $portal['total_days'];
    $user = $portal['user'];

    $nav = [
        ['route' => 'portal.dashboard', 'label' => 'Dashboard', 'icon' => 'home'],
        ['route' => 'portal.lesson', 'label' => "Today's Lesson", 'icon' => 'book', 'pill' => 'D'.$today],
        ['route' => 'portal.journey', 'label' => 'Journey', 'icon' => 'map'],
        ['route' => 'portal.reflections', 'label' => 'Reflections', 'icon' => 'leaf'],
        ['route' => 'portal.prayer', 'label' => 'Prayer', 'icon' => 'prayer'],
        ['route' => 'portal.progress', 'label' => 'Progress', 'icon' => 'chart'],
    ];

    $accountNav = [
        ['route' => 'portal.resources', 'label' => 'Resources', 'icon' => 'stack'],
        ['route' => 'portal.settings', 'label' => 'Settings', 'icon' => 'gear'],
    ];

    $titles = [
        'portal.dashboard' => 'Continue your journey',
        'portal.lesson' => "Today's lesson is ready",
        'portal.journey' => 'From Genesis to Jesus',
        'portal.reflections' => 'A private place to remember',
        'portal.prayer' => 'Bring today before God',
        'portal.progress' => 'Quiet progress matters',
        'portal.resources' => 'Companions for the journey',
        'portal.settings' => 'Your account & journey',
        'portal.completion' => 'You finished the journey',
    ];

    $current = request()->route()?->getName();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ?? config('app.name', 'DevotionHub') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        @fonts

        @vite(['resources/css/portal/portal.css', 'resources/js/app.js'])
    </head>
    <body>
        @auth
            <div x-data="{ mobileNav: false }" class="grid min-h-screen grid-cols-1 lg:grid-cols-[248px_1fr]">
                {{-- ============================ SIDEBAR ============================ --}}
                <aside x-bind:class="mobileNav ? 'flex' : 'hidden lg:flex'"
                       class="fixed inset-y-0 left-0 z-40 w-[248px] flex-col gap-7 overflow-y-auto border-r border-hair bg-bg px-[18px] pb-6 pt-7 lg:sticky lg:top-0 lg:h-screen">
                    <a href="{{ route('portal.dashboard') }}" wire:navigate class="flex items-center gap-2.5 px-2 py-1">
                        <span class="relative inline-flex size-[30px] flex-none items-center justify-center rounded-md bg-black" aria-hidden="true">
                            <span class="diamond absolute inset-[7px] bg-gold"></span>
                        </span>
                        <span class="font-display text-lg font-extrabold tracking-[0.02em] text-ink">
                            DevotionHub<span class="text-gold">.</span>
                        </span>
                    </a>

                    <div class="flex flex-col gap-0.5">
                        <div class="px-2.5 pb-2 font-mono text-[10px] font-medium uppercase tracking-[0.22em] text-muted">Journey</div>
                        @foreach ($nav as $item)
                            @include('layouts.partials.portal-nav-link', ['item' => $item, 'current' => $current])
                        @endforeach
                    </div>

                    <div class="flex flex-col gap-0.5">
                        <div class="px-2.5 pb-2 font-mono text-[10px] font-medium uppercase tracking-[0.22em] text-muted">Account</div>
                        @foreach ($accountNav as $item)
                            @include('layouts.partials.portal-nav-link', ['item' => $item, 'current' => $current])
                        @endforeach

                        @include('layouts.partials.portal-nav-link', [
                            'item' => ['route' => 'portal.completion', 'label' => 'Completion', 'icon' => 'award', 'pill' => 'Preview', 'pillClass' => 'bg-olive text-white'],
                            'current' => $current,
                        ])
                    </div>

                    <div class="mt-auto flex flex-col gap-3.5 border-t border-hair pt-[18px]">
                        <div class="flex items-center gap-2.5 rounded-xl border border-hair bg-paper p-3">
                            <x-portal.progress-ring :value="$today / $total" :size="36" :stroke="4" />
                            <div class="text-[11.5px] leading-[1.3] text-ink-3">
                                <b class="block text-[12.5px] font-semibold text-ink">{{ $user['plan'] }}</b>
                                Day {{ $today }} of {{ $total }}
                            </div>
                        </div>

                        <div class="px-2.5 font-display text-[15px] font-medium leading-[1.2] tracking-[-0.018em] text-ink">
                            Be still, and know that I am God.
                            <span class="mt-2 block font-mono text-[9.5px] font-medium uppercase tracking-[0.18em] text-muted">Psalm 46:10 &middot; KJV</span>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-2.5 rounded-lg px-3 py-2 text-[12.5px] font-medium text-ink-3 transition-colors hover:bg-ink/5 hover:text-ink">
                                <x-portal.icon name="logout" :size="15" />
                                Sign out
                            </button>
                        </form>
                    </div>
                </aside>

                {{-- backdrop for the mobile drawer --}}
                <div x-show="mobileNav" x-on:click="mobileNav = false" x-cloak
                     class="fixed inset-0 z-30 bg-black/40 lg:hidden"></div>

                {{-- ============================== MAIN ============================== --}}
                <div class="flex min-w-0 flex-col">
                    <header class="sticky top-0 z-20 flex h-[72px] items-center justify-between gap-7 border-b border-hair bg-bg/85 px-5 backdrop-blur-[14px] backdrop-saturate-150 lg:px-10">
                        <div class="flex min-w-0 items-center gap-4">
                            <button type="button" x-on:click="mobileNav = true"
                                    class="inline-flex size-9 items-center justify-center rounded-lg text-ink-2 transition-colors hover:bg-bg-deep hover:text-ink lg:hidden"
                                    aria-label="Open navigation">
                                <x-portal.icon name="stack" :size="18" />
                            </button>

                            <div class="flex flex-none items-center gap-3.5 rounded-full border border-hair bg-paper py-2 pl-2.5 pr-3.5">
                                <span class="pulse-dot size-2 rounded-full bg-gold shadow-[0_0_0_4px_rgb(184_135_60/0.15)]"></span>
                                <span class="font-mono text-[11px] font-semibold uppercase tracking-[0.16em] text-ink">Day {{ $today }} of {{ $total }}</span>
                            </div>

                            <div class="hidden truncate font-mono text-[11px] uppercase tracking-[0.16em] text-ink-3 xl:block">
                                &middot; {{ $titles[$current] ?? '' }}
                            </div>
                        </div>

                        <div class="flex items-center gap-3.5">
                            <div class="hidden min-w-[240px] items-center gap-2.5 rounded-[10px] border border-hair bg-paper px-3 py-2 text-[13px] text-ink-3 xl:flex">
                                <x-portal.icon name="search" :size="15" />
                                <span>Search lessons, reflections…</span>
                                <kbd class="ml-auto rounded border border-hair bg-bg-deep px-1.5 py-[3px] font-mono text-[10px] tracking-[0.05em] text-muted">&#8984;K</kbd>
                            </div>

                            <button type="button" class="relative inline-flex size-9 items-center justify-center rounded-lg text-ink-2 transition-colors hover:bg-bg-deep hover:text-ink" aria-label="Notifications">
                                <x-portal.icon name="bell" :size="17" />
                                <span class="absolute right-2 top-2 size-[7px] rounded-full border-2 border-bg bg-gold"></span>
                            </button>

                            <button type="button" class="flex items-center gap-2.5 rounded-full border border-hair bg-paper py-1 pl-1 pr-2.5 transition-colors hover:border-ink">
                                <span class="inline-flex size-[30px] items-center justify-center rounded-full bg-ink font-display text-[13px] font-bold tracking-[-0.01em] text-white">{{ $user['initials'] }}</span>
                                <span class="hidden text-[13px] font-semibold text-ink sm:block">{{ $user['first_name'] }}</span>
                                <x-portal.icon name="caret" :size="14" class="text-muted" />
                            </button>
                        </div>
                    </header>

                    <main class="mx-auto w-full max-w-[1320px] px-5 pb-20 pt-10 lg:px-10">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        @else
            {{ $slot }}
        @endauth
    </body>
</html>
