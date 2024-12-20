<x-app-layout>
    <x-slot name="header">
        <span>
            @yield('titulo_vista')
        </span>
        <nav>
            @yield('menu_vista')
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @yield('contenido_vista')
            </div>
        </div>
    </div>
</x-app-layout>
