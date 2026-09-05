## Livewire Component Architecture

This project uses Livewire with traditional class-based components.

Do not use single-file Livewire components.

Livewire PHP classes and Blade views must be stored separately.

Example:

app/Livewire/Portal/Dashboard.php

resources/views/livewire/portal/dashboard.blade.php

The PHP class is responsible for component state, actions, validation,
authorization, computed properties, and other server-side behavior.

The Blade file is responsible for presentation and markup.

Organize Livewire components by application area:

app/Livewire/
├── Marketing/
├── Portal/
└── Admin/

Corresponding views:

resources/views/livewire/
├── marketing/
├── portal/
└── admin/

The application should eventually have separate layouts for:

resources/views/layouts/
├── marketing.blade.php
├── portal.blade.php
└── admin.blade.php

Flux UI should be used for the admin dashboard.

The student portal may use Flux where useful, but custom Blade/Tailwind
components should be used when necessary to achieve the DevotionHub
design.