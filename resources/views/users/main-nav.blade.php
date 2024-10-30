<div>
    {{-- links solo al modulo de usuarios --}}
    <x-nav-link wire:navigate :href="route('users-users-index')" :active="request()->routeIs('users-users-*')">Usuarios</x-nav-link>
    <x-nav-link wire:navigate :href="route('users-roles-index')" :active="request()->routeIs('users-roles-*')">Roles</x-nav-link>
</div>
