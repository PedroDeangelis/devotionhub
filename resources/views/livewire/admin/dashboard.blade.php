<div>
    <div class="mb-9">
        <div class="inline-flex items-center gap-2.5 font-mono text-[10.5px] font-medium uppercase tracking-[0.22em] text-ink-3">
            <span class="size-1.5 rounded-full bg-gold"></span>
            Administration
        </div>

        <h1 class="mb-3.5 mt-[18px] font-display text-[clamp(38px,4vw,54px)] font-bold leading-[0.98] tracking-[-0.032em]">
            Console.
        </h1>

        <p class="max-w-[62ch] text-[15px] leading-[1.6] text-ink-3">
            Signed in as <b class="font-semibold text-ink">{{ auth()->user()->name }}</b>. Journey and lesson
            management will live here.
        </p>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([
            ['Total users', $totalUsers, 'Registered accounts', false],
            ['Administrators', $adminUsers, 'With console access', true],
            ['Journeys', '1', '90-Day Foundations', false],
            ['Lessons', '90', 'Genesis to Jesus', false],
        ] as [$label, $value, $desc, $gold])
            <div @class([
                'flex flex-col rounded-[20px] border p-6',
                'border-gold/30 bg-gold-light/40' => $gold,
                'border-hair bg-paper' => ! $gold,
            ])>
                <div class="font-mono text-[10px] font-medium uppercase tracking-[0.2em] text-muted">{{ $label }}</div>
                <div class="mt-3 font-display text-[38px] font-extrabold leading-[0.9] tracking-[-0.04em]">
                    <em @class(['not-italic', 'text-gold' => $gold])>{{ $value }}</em>
                </div>
                <div class="mt-2 text-[12.5px] leading-[1.4] text-ink-3">{{ $desc }}</div>
            </div>
        @endforeach
    </div>

    <div class="mt-6 rounded-[20px] border border-hair bg-paper p-6 lg:p-8">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-4 border-b border-hair pb-5">
            <div>
                <div class="font-display text-[22px] font-bold leading-none tracking-[-0.025em]">Recent accounts</div>
                <div class="mt-2 font-mono text-[10.5px] uppercase tracking-[0.16em] text-ink-3">Newest {{ $recentUsers->count() }} of {{ $totalUsers }}</div>
            </div>
        </div>

        @forelse ($recentUsers as $user)
            <div class="flex flex-wrap items-center gap-4 border-b border-hair py-4 last:border-0">
                <span class="inline-flex size-10 flex-none items-center justify-center rounded-full bg-ink font-display text-[15px] font-bold text-white">{{ $user->initials() }}</span>

                <div class="min-w-0 flex-1">
                    <div class="truncate font-display text-[16px] font-bold tracking-[-0.02em] text-ink">{{ $user->name }}</div>
                    <div class="mt-0.5 truncate font-mono text-[10.5px] uppercase tracking-[0.14em] text-muted">{{ $user->email }}</div>
                </div>

                @if ($user->is_admin)
                    <span class="rounded-full border border-gold/40 bg-gold-light px-2.5 py-1 font-mono text-[9.5px] font-semibold uppercase tracking-[0.14em] text-gold">Admin</span>
                @endif

                <span class="font-mono text-[10.5px] uppercase tracking-[0.14em] text-muted">
                    {{ $user->created_at?->format('M j, Y') }}
                </span>
            </div>
        @empty
            <p class="py-6 text-center text-[14px] text-ink-3">No accounts yet.</p>
        @endforelse
    </div>
</div>
