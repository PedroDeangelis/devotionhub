/*
 * Shared entry point for every area.
 *
 * Livewire ships its own Alpine and auto-injects it on the portal and admin
 * layouts, so starting a second copy there would register every directive
 * twice and break Livewire's bindings. The public site has no Livewire, so it
 * needs Alpine booted here.
 *
 * Livewire's script is a classic tag that executes during parsing, while this
 * bundle is a module and therefore deferred - so by the time this runs,
 * Livewire has already claimed window.Alpine if it is present on the page.
 */

import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

if (! window.Alpine && ! window.Livewire) {
    Alpine.plugin(intersect);
    window.Alpine = Alpine;
    Alpine.start();
}
