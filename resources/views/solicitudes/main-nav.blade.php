<div>
    {{-- links solo al modulo de solicitudes --}}
    <x-nav-link wire:navigate :href="route('solicitudes-solicitud-create')" :active="request()->routeIs('solicitudes-solicitud-*')">Solicitudes</x-nav-link>
</div>