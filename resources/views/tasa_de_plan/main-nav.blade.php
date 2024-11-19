<div>
    {{-- Links solo para el módulo de Tasas --}}
    <x-nav-link wire:navigate :href="route('tasas-tasa-list')" :active="request()->routeIs('tasas-tasa-*')">
        Tasas de Plan
    </x-nav-link>
</div>
