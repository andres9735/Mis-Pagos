<div>
    <x-nav-link :href="route('users-users-index')" :active="request()->routeIs('users-users-*')">Usuarios</x-nav-link>
    <x-nav-link :href="route('users-roles-index')" :active="request()->routeIs('users-roles-*')">Roles</x-nav-link>
    <x-nav-link :href="route('users-solicitud-create')" :active="request()->routeIs('users-solicitud-*')">Solicitud</x-nav-link>
</div>