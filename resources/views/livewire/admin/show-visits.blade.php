    <h1 class="text-2xl font-semibold text-gray-700 mb-6">Visitas</h1>

    <x-button>Botón azul</x-button>
    <x-button color="red">Botón rojo</x-button>
    <x-button-link href="#">Botón azul con link</x-button-link>
    <x-button-link color="red" href="#">Botón rojo con link</x-button-link>

    @if($visits->count())
    <x-table>
        <x-slot name="title">Tabla de ejemplo</x-slot>
        <x-slot name="thead">
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Visit_id
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Deviceid
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                SSOO
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                SSOO Version
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Punto de Interes
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Acciones
            </th>
        </x-slot>
        <x-slot name="tbody">
            @foreach($visits as $visit)
                <tr>
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        <div>{{ $visit->id}}</div>
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        <div>{{ $visit->deviceid }}</div>
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        <div>{{ $visit->ssoo }}</div>
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        <div>{{ $visit->ssooversion }}</div>
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        <div >{{ $visit->point_of_interest_id }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <x-button-link href="{{ route('admin.visits.edit', $visit) }}">Ver Detalles(Todavia no va)</x-button-link>
                        <x-button color="red">Eliminar</x-button>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-table>
    @if($visits->hasPages())
        <div class="px-6 py-4">
            {{ $visits->links() }}
        </div>
    @endif
    @else
        <div class="px-6 py-4">
            No existen productos coincidentes
        </div>
    @endif
