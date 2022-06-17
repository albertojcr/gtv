<div>
    <div class="flex items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-700">Listado de vídeos</h1>
    </div>

    @if(count($visits))
        <x-table>
            <x-slot name="thead">
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Device ID
                </th>
                <th scope="col" class="px-6 py-3">
                    SSOO
                </th>
                <th scope="col" class="px-6 py-3">
                    SSOO Version
                </th>
                <th scope="col" class="px-6 py-3">
                    Punto de Interes
                </th>
                <th scope="col" class="px-6 py-3">
                    Fecha creación
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Actions</span>
                </th>
            </x-slot>

            <x-slot name="tbody">
                @foreach($visits as $visit)
                    <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
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
                            @if( ! empty($visit->point_of_interest_id))
                                <div >{{ $visit->point_of_interest_id }}</div>
                            @else
                                <span class="text-red-600">Ninguno</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div>{{ $visit->created_at }}</div>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap flex gap-4">
                            <span class="font-medium text-blue-600 cursor-pointer" wire:click="show('{{ $visit->id }}')">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>

        @if($visits->hasPages())
            <div class="mt-6">
                {{ $visits->links() }}
            </div>
        @endif
    @else
        <p class="mt-4">No se han encontrado resultados</p>
    @endif

    {{-- Modal show --}}
    <x-jet-dialog-modal wire:model="detailsModal.open">
        <x-slot name="title">
            <span class="text-2xl">Detalles de la Visita #{{ $detailsModal['id'] }}</span>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-3">
                <div>
                    <x-jet-label>
                        Hora: {{ $detailsModal['hour']}}
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Id Dispositivo: {{ $detailsModal['deviceid'] }}
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Version de la App: {{ $detailsModal['appversion'] }}
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Agente: {{ $detailsModal['useragent'] }}
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Sistema Operativo: {{ $detailsModal['ssoo'] }}
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Version Sistema Operativo: {{ $detailsModal['ssooversion'] }}
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Punto de Interest:
                        {!!QrCode::size(100)->generate(json_encode($detailsModal['point_of_interest_id'], JSON_PRETTY_PRINT)) !!}
                    </x-jet-label>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="$set('detailsModal.open', false)">
                Cerrar
            </x-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
