@php
    $user = config('portal.user');
@endphp

<div class="mx-auto max-w-[900px] text-center">
    <div class="text-lg tracking-[6px] text-gold" aria-label="Five out of five stars">★ ★ ★ ★ ★</div>

    <x-portal.eyebrow class="mt-6">The Journey Complete &middot; 90 / 90</x-portal.eyebrow>

    <h1 class="mt-6 font-display text-[clamp(46px,6vw,84px)] font-extrabold leading-[0.94] tracking-[-0.04em]">
        You completed<br>the <em class="not-italic text-gold">journey.</em>
    </h1>

    <p class="mx-auto mt-6 max-w-[58ch] text-base leading-[1.65] text-ink-2">
        For ninety days, you walked through the story of Scripture from Genesis to Jesus.
        From the first "let there be light" to the empty tomb. Through twelve quiet minutes a day,
        you built something that will outlast this page.
    </p>

    {{-- Certificate --}}
    <div class="mt-12 rounded-[26px] border border-hair bg-paper p-8 text-left shadow-card-lg lg:p-12">
        <div class="flex items-center gap-4 border-b border-hair pb-6">
            <span class="inline-flex size-14 flex-none items-center justify-center rounded-full bg-gold text-white">
                <x-portal.icon name="award" :size="28" />
            </span>
            <div class="font-mono text-[10.5px] font-medium uppercase tracking-[0.22em] text-ink-3">
                Certificate of Completion
                <span class="mt-1.5 block text-[12px] normal-case tracking-normal text-muted">The 90-Day Bible Journey</span>
            </div>
        </div>

        <h2 class="mt-8 font-display text-[clamp(34px,4.4vw,56px)] font-extrabold leading-[0.96] tracking-[-0.04em]">
            From Genesis<br>to Jesus.
        </h2>

        <div class="mt-6 font-display text-[26px] font-bold tracking-[-0.025em] text-gold">{{ $user['first_name'] }} {{ $user['last_name'] }}</div>

        <p class="mt-4 max-w-[64ch] text-[14px] leading-[1.7] text-ink-3">
            For walking faithfully through ninety days of guided Scripture reading, reflection,
            and prayer — from creation to resurrection. May the rhythm continue.
        </p>

        <div class="mt-8 grid grid-cols-1 gap-6 border-t border-hair pt-6 sm:grid-cols-3">
            @foreach ([['Journey started', $user['started_at']], ['Journey completed', $user['completed_at']], ['Translation', 'King James Version']] as [$k, $v])
                <div>
                    <div class="font-mono text-[9.5px] font-medium uppercase tracking-[0.18em] text-muted">{{ $k }}</div>
                    <div class="mt-1.5 font-display text-[15px] font-bold tracking-[-0.02em] text-ink">{{ $v }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-8 flex flex-wrap justify-center gap-3">
        <x-portal.button variant="primary" size="lg"><x-portal.icon name="download" :size="14" /> Download certificate</x-portal.button>
        <x-portal.button variant="ghost" size="lg"><x-portal.icon name="share" :size="14" /> Share testimony</x-portal.button>
    </div>

    {{-- Summary --}}
    <div class="mt-12 grid grid-cols-2 gap-4 lg:grid-cols-4">
        @foreach ([['Lessons completed', '90', null, false], ['Reflections written', '42', null, true], ['Prayers saved', '18', null, false], ['Longest streak', '34', ' days', true]] as [$label, $value, $suffix, $gold])
            <div class="rounded-[20px] border border-hair bg-paper p-6 text-left">
                <div class="font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">{{ $label }}</div>
                <div class="mt-3 font-display text-[40px] font-extrabold leading-none tracking-[-0.04em]">
                    <em @class(['not-italic', 'text-gold' => $gold])>{{ $value }}</em><span class="text-[22px] font-semibold text-ink-3">{{ $suffix }}</span>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Next journeys --}}
    <h2 class="mt-20 font-display text-[clamp(32px,4vw,52px)] font-bold leading-none tracking-[-0.032em]">Continue growing.</h2>
    <p class="mx-auto mt-3 max-w-[44ch] text-base text-ink-3">The next step is yours to choose. The path continues.</p>

    <div class="mt-8 grid grid-cols-1 gap-4 text-left md:grid-cols-3">
        @foreach ([
            ['Next journey', '30 Days with Jesus', 'One month walking slowly through the four Gospels — Matthew, Mark, Luke, John.', 'Begin journey'],
            ['Companion', 'The Prayer Journey', "Forty-five days of guided prayer practices — the Psalms, the Lord's Prayer, lament, and silence.", 'Begin journey'],
            ['Walk again', 'Repeat the 90-Day Journey', 'The same path, a different season of your life. Reset your start date and begin again.', 'Reset & restart'],
        ] as [$label, $name, $desc, $action])
            <div class="group flex cursor-pointer flex-col rounded-[20px] border border-hair bg-paper p-6 transition-all hover:-translate-y-0.5 hover:border-hair-soft">
                <div class="font-mono text-[10px] font-medium uppercase tracking-[0.18em] text-muted">{{ $label }}</div>
                <h4 class="mt-2.5 font-display text-[21px] font-bold leading-tight tracking-[-0.025em] text-ink">{{ $name }}</h4>
                <p class="mt-2.5 flex-1 text-[13.5px] leading-[1.55] text-ink-3">{{ $desc }}</p>
                <div class="mt-6 inline-flex items-center gap-2 border-t border-hair pt-4 font-mono text-[10px] font-medium uppercase tracking-[0.16em] text-gold">
                    {{ $action }}
                    <span class="arrow-mask h-2 w-3 bg-current transition-transform group-hover:translate-x-0.5"></span>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Invite --}}
    <div class="mt-14 flex flex-wrap items-center justify-between gap-6 rounded-[20px] border border-hair bg-paper p-8 text-left lg:p-10">
        <div class="max-w-[46ch]">
            <div class="font-display text-[28px] font-bold leading-[1.15] tracking-[-0.028em] text-ink">
                Invite a friend<br>to the <em class="not-italic text-gold">journey.</em>
            </div>
            <p class="mt-3 text-sm leading-[1.6] text-ink-3">The path is richer with company. Send a gift code to someone you love.</p>
        </div>
        <div class="flex flex-none flex-wrap gap-3">
            <x-portal.button variant="soft">Copy invite link</x-portal.button>
            <x-portal.button variant="primary" arrow>Gift a journey</x-portal.button>
        </div>
    </div>
</div>
