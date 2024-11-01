<div class="container mx-auto my-8 p-4">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Auditoría de Cambios</h2>
    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg overflow-hidden">
        <thead class="bg-gray-100 border-b border-gray-300">
            <tr>
                <th class="px-6 py-3 text-left text-gray-700 font-medium uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-gray-700 font-medium uppercase tracking-wider">Usuario</th>
                <th class="px-6 py-3 text-left text-gray-700 font-medium uppercase tracking-wider">Evento</th>
                <th class="px-6 py-3 text-left text-gray-700 font-medium uppercase tracking-wider">Fecha</th>
                <th class="px-6 py-3 text-left text-gray-700 font-medium uppercase tracking-wider">Cambios</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($auditorias as $auditoria)
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">{{ $auditoria->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                        {{ optional($auditoria->user)->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ ucfirst($auditoria->event) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $auditoria->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                        <ul class="list-disc ml-6 space-y-1 text-sm">
                            @foreach ($auditoria['old_values'] as $old)
                                <li><span class="text-red-500 font-semibold">Antes:</span> {{ $old }}</li>
                            @endforeach
                            @foreach ($auditoria['new_values'] as $new)
                                <li><span class="text-green-500 font-semibold">Después:</span> {{ $new }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    {{--  <div class="mt-4">
        {{ $auditorias->links() }}
    </div> --}}
</div>
