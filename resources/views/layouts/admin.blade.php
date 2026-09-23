@php
    $current = request()->route()?->getName();

    $nav = [
        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'home', 'match' => 'admin.dashboard'],
        ['route' => 'admin.courses.index', 'label' => 'Courses', 'icon' => 'book', 'match' => 'admin.courses.'],
    ];

    /*
     * Child pages keep their parent lit: /admin/courses/3/edit should highlight
     * Courses, so anything but the dashboard matches on a route-name prefix.
     */
    $isActive = function (array $item) use ($current): bool {
        return $item['match'] === 'admin.dashboard'
            ? $current === 'admin.dashboard'
            : str_starts_with((string) $current, $item['match'])
                || str_starts_with((string) $current, 'admin.lessons.');
    };
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ?? 'Admin — '.config('app.name', 'DevotionHub') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        @fonts

        @vite(['resources/css/admin/admin.css', 'resources/js/app.js'])
    </head>
    <body>
        @auth
            <div class="grid min-h-screen grid-cols-1 lg:grid-cols-[236px_1fr]">
                <aside class="hidden flex-col gap-7 border-r border-hair bg-bg px-[18px] pb-6 pt-7 lg:sticky lg:top-0 lg:flex lg:h-screen">
                    <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center gap-2.5 px-2 py-1">
                        <span class="relative inline-flex size-[30px] flex-none items-center justify-center rounded-md bg-black" aria-hidden="true">
                            <span class="diamond absolute inset-[7px] bg-gold"></span>
                        </span>
                        <span class="font-display text-lg font-extrabold tracking-[0.02em] text-ink">
                            DevotionHub<span class="text-gold">.</span>
                        </span>
                    </a>

                    <div class="flex flex-col gap-0.5">
                        <div class="px-2.5 pb-2 font-mono text-[10px] font-medium uppercase tracking-[0.22em] text-muted">Admin</div>
                        @foreach ($nav as $item)
                            <a href="{{ route($item['route']) }}" wire:navigate
                               @class([
                                   'group relative flex items-center gap-3 rounded-[10px] px-3 py-2.5 text-[13.5px] transition-colors',
                                   'bg-bg-deep font-semibold text-ink' => $isActive($item),
                                   'font-medium text-ink-2 hover:bg-ink/5 hover:text-ink' => ! $isActive($item),
                               ])>
                                @if ($isActive($item))
                                    <span class="absolute left-1 top-1/2 h-[18px] w-[3px] -translate-y-1/2 rounded-sm bg-gold"></span>
                                @endif
                                <x-admin.icon :name="$item['icon']" :size="17" @class(['text-gold' => $isActive($item), 'text-ink-3' => ! $isActive($item)]) />
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-auto flex flex-col gap-3 border-t border-hair pt-[18px]">
                        <a href="{{ route('portal.dashboard') }}" wire:navigate
                           class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-[12.5px] font-medium text-ink-3 transition-colors hover:bg-ink/5 hover:text-ink">
                            <x-admin.icon name="arrow-left" :size="15" />
                            Back to portal
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-2.5 rounded-lg px-3 py-2 text-[12.5px] font-medium text-ink-3 transition-colors hover:bg-ink/5 hover:text-ink">
                                <x-admin.icon name="logout" :size="15" />
                                Sign out
                            </button>
                        </form>
                    </div>
                </aside>

                <div class="flex min-w-0 flex-col">
                    <header class="sticky top-0 z-20 flex h-[72px] items-center justify-between gap-6 border-b border-hair bg-bg/85 px-5 backdrop-blur-[14px] lg:px-10">
                        <div class="flex items-center gap-3">
                            <span class="rounded-full border border-hair bg-paper px-3 py-1.5 font-mono text-[10px] font-semibold uppercase tracking-[0.16em] text-gold">Admin</span>
                            <span class="hidden font-mono text-[11px] uppercase tracking-[0.16em] text-ink-3 sm:block">DevotionHub administration</span>
                        </div>

                        <div class="flex items-center gap-2.5">
                            <span class="inline-flex size-[30px] items-center justify-center rounded-full bg-ink font-display text-[13px] font-bold text-white">{{ auth()->user()->initials() }}</span>
                            <span class="hidden text-[13px] font-semibold text-ink sm:block">{{ auth()->user()->name }}</span>
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
