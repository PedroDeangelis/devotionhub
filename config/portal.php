<?php

/*
 * Presentation data for the student portal.
 *
 * Lifted from the design source so the portal renders exactly as designed.
 * Replace these with real models and user progress once journeys are modelled.
 */

return [
    'user' => [
        'first_name' => 'Grace',
        'last_name' => 'Williams',
        'email' => 'grace@hand.co',
        'initials' => 'GW',
        'started_at' => 'March 1, 2026',
        'completed_at' => 'May 30, 2026',
        'translation' => 'KJV',
        'email_time' => '07:00',
        'timezone' => 'America/Denver',
        'plan' => '90-Day Foundations',
    ],

    'today_day' => 12,
    'total_days' => 90,
    'streak' => 7,
    'reflections_count' => 8,
    'prayers_count' => 5,

    'sections' => [
        ['key' => 'creation', 'name' => 'Creation', 'ord' => '01', 'days' => [1, 8], 'desc' => 'In the beginning, God spoke light into darkness.', 'state' => 'completed', 'done' => 8, 'total' => 8],
        ['key' => 'abraham', 'name' => 'Abraham', 'ord' => '02', 'days' => [9, 18], 'desc' => 'Promise, covenant, testing, and faith.', 'state' => 'current', 'done' => 4, 'total' => 10],
        ['key' => 'moses', 'name' => 'Moses', 'ord' => '03', 'days' => [19, 32], 'desc' => 'Out of Egypt, into a new way of being free.', 'state' => 'locked', 'done' => 0, 'total' => 14],
        ['key' => 'kings', 'name' => 'Kings', 'ord' => '04', 'days' => [33, 48], 'desc' => 'A throne, a temple, a kingdom torn.', 'state' => 'locked', 'done' => 0, 'total' => 16],
        ['key' => 'prophets', 'name' => 'Prophets', 'ord' => '05', 'days' => [49, 62], 'desc' => 'Voices in exile, hope in the dark.', 'state' => 'locked', 'done' => 0, 'total' => 14],
        ['key' => 'jesus', 'name' => 'Jesus', 'ord' => '06', 'days' => [63, 82], 'desc' => 'The promise made flesh in a Galilean village.', 'state' => 'locked', 'done' => 0, 'total' => 20],
        ['key' => 'resurrection', 'name' => 'Resurrection', 'ord' => '07', 'days' => [83, 90], 'desc' => 'Death undone, the story turned.', 'state' => 'locked', 'done' => 0, 'total' => 8],
    ],

    'abraham_lessons' => [
        ['day' => 9, 'title' => 'The Call of Abraham', 'scrip' => 'Genesis 12', 'state' => 'completed'],
        ['day' => 10, 'title' => "God's Covenant with Abraham", 'scrip' => 'Genesis 15', 'state' => 'completed'],
        ['day' => 11, 'title' => 'Sarah and the Promise', 'scrip' => 'Genesis 17–18', 'state' => 'completed'],
        ['day' => 12, 'title' => "Abraham's Ultimate Test", 'scrip' => 'Genesis 22', 'state' => 'current'],
        ['day' => 13, 'title' => 'Isaac and Rebekah', 'scrip' => 'Genesis 24', 'state' => 'upcoming'],
        ['day' => 14, 'title' => 'Jacob and the Wrestling Match', 'scrip' => 'Genesis 32', 'state' => 'locked'],
        ['day' => 15, 'title' => "Joseph's Coat", 'scrip' => 'Genesis 37', 'state' => 'locked'],
        ['day' => 16, 'title' => 'Joseph in Egypt', 'scrip' => 'Genesis 39–41', 'state' => 'locked'],
        ['day' => 17, 'title' => 'The Reconciliation', 'scrip' => 'Genesis 42–45', 'state' => 'locked'],
        ['day' => 18, 'title' => 'A Family Restored', 'scrip' => 'Genesis 46–50', 'state' => 'locked'],
    ],

    'creation_lessons' => [
        ['day' => 1, 'title' => 'In the Beginning', 'scrip' => 'Genesis 1'],
        ['day' => 2, 'title' => 'The Sabbath', 'scrip' => 'Genesis 2:1–3'],
        ['day' => 3, 'title' => 'The Garden', 'scrip' => 'Genesis 2:4–25'],
        ['day' => 4, 'title' => 'The Fall', 'scrip' => 'Genesis 3'],
    ],

    'milestones' => [
        ['name' => 'First Lesson Complete', 'desc' => 'You showed up. The first day is the hardest.', 'done' => true, 'next' => false],
        ['name' => '7-Day Streak', 'desc' => 'A week of returning. The rhythm is becoming yours.', 'done' => true, 'next' => false],
        ['name' => 'First Reflection', 'desc' => 'Words on paper — a small altar in your week.', 'done' => true, 'next' => false],
        ['name' => '14-Day Milestone', 'desc' => 'Two full weeks. The Foundations Journey opens.', 'done' => false, 'next' => true],
        ['name' => '30 Days Complete', 'desc' => 'A month walked. One third of the way home.', 'done' => false, 'next' => false],
        ['name' => 'Halfway Point', 'desc' => 'Day 45 — the story turns from Old to New.', 'done' => false, 'next' => false],
        ['name' => 'New Testament Begins', 'desc' => 'The promise made flesh.', 'done' => false, 'next' => false],
        ['name' => 'Journey Complete', 'desc' => 'From Genesis to Jesus, finished.', 'done' => false, 'next' => false],
    ],

    'prayer_history' => [
        ['date' => 'May 22, 2026', 'lesson' => "Day 12 · Abraham's Test", 'preview' => 'Father, what You have given, I receive with open hands. What You ask back, I release in trust…'],
        ['date' => 'May 21, 2026', 'lesson' => 'Day 11 · Sarah & the Promise', 'preview' => "Lord, where I have stopped believing You will keep Your word, give me the small faith of Sarah's laugh…"],
        ['date' => 'May 19, 2026', 'lesson' => 'Day 9 · The Call', 'preview' => 'God of Abraham — give me courage to follow even when the directions are not coordinates, just a direction…'],
        ['date' => 'May 17, 2026', 'lesson' => 'Day 7 · Cain & Abel', 'preview' => "Help me hear the question 'where is your brother' and not look away. Soften my heart toward the people I am avoiding…"],
    ],

    'resources' => [
        ['title' => 'The Bible Timeline', 'kind' => 'Overview', 'desc' => 'A simple visual of the story of Scripture from Eden to New Jerusalem.', 'action' => 'Open guide', 'icon' => 'map'],
        ['title' => 'How to Use This Journey', 'kind' => 'Getting started', 'desc' => 'Tips for building a daily rhythm — when, where, and how to make it stick.', 'action' => 'Read tips', 'icon' => 'compass'],
        ['title' => 'Printable Workbook', 'kind' => 'Workbook · PDF', 'desc' => 'A 90-day reflection workbook you can print and write in by hand.', 'action' => 'Download PDF', 'icon' => 'doc'],
        ['title' => 'Recommended Next Steps', 'kind' => "What's next", 'desc' => 'Three thoughtful next journeys for after you complete the 90 days.', 'action' => 'See journeys', 'icon' => 'wave'],
        ['title' => 'Frequently Asked', 'kind' => 'FAQ', 'desc' => 'Common questions about translations, pacing, missed days, and account.', 'action' => 'Browse FAQ', 'icon' => 'stack'],
        ['title' => 'Statement of Faith', 'kind' => 'About', 'desc' => 'What we believe, why we built this, and the tradition we stand in.', 'action' => 'Read statement', 'icon' => 'book'],
    ],

    'faqs' => [
        ['q' => 'What if I miss a day — am I behind?', 'a' => "Not at all. Your journey resumes wherever you stop. The platform is built around returning, not catching up. We'll never shame you for a missed day — God doesn't, and neither do we."],
        ['q' => 'Which Bible translation does DevotionHub use?', 'a' => 'By default we use the KJV, but you can switch to ESV, NIV, NLT or other supported translations from your Settings. Your translation choice applies to all readings, past and future.'],
        ['q' => 'Can I pause my journey?', 'a' => 'Yes. From Settings → Course Mode, you can pause indefinitely. When you resume, your next lesson will be waiting — no penalties, no expired access.'],
        ['q' => 'Is my journal private?', 'a' => 'Always. Reflections are private by default and encrypted at rest. Only you can read them. Sharing is opt-in, per-entry.'],
        ['q' => 'Can I gift the journey to someone?', 'a' => "Yes — gift a journey from your account settings. We'll send a personal note from you and they can start whenever they're ready."],
    ],
];
