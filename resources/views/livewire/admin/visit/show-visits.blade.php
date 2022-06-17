<div>
    <div class="flex items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-700">Listado de visitas</h1>
    </div>

    <div class="mb-3">
        <div class="inline">
            <select class="text-black  bg-blue-100 hover:bg-grey-200 focus:ring-4 focus:ring-blue-300
                    font-medium rounded-lg text-sm py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700
                    focus:outline-none dark:focus:ring-blue-800 ml-auto" wire:model="searchColumn">
                <option value="id">ID</option>
                <option value="deviceid">DEVICE ID</option>
                <option value="ssoo">SSOO</option>
                <option value="ssooversion">SSOO VERSION</option>
                <option value="point_of_interest_id">PUNTO DE INTERÉS</option>
                <option value="created_at">FECHA DE CREACIÓN</option>
            </select>
        </div>

        <x-jet-input class="py-1 border-black" type="text" wire:model="search"
                     placeholder="Buscar ..."></x-jet-input>

        <x-jet-button wire:click="resetFilters">Eliminar filtros</x-jet-button>


    @if(count($visits))
        <x-table>
            <x-slot name="thead">
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sort('id')">
                    ID
                    @if($sortField === 'id' && $sortDirection === 'asc')
                        <i class="fa-solid fa-arrow-up">
                            @elseif($sortField === 'id' && $sortDirection === 'desc')
                                <i class="fa-solid fa-arrow-down"></i>
                    @endif
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sort('deviceid')">
                    Device ID
                    @if($sortField === 'deviceid' && $sortDirection === 'asc')
                        <i class="fa-solid fa-arrow-up">
                            @elseif($sortField === 'deviceid' && $sortDirection === 'desc')
                                <i class="fa-solid fa-arrow-down"></i>
                    @endif
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sort('ssoo')">
                    SSOO
                    @if($sortField === 'ssoo' && $sortDirection === 'asc')
                        <i class="fa-solid fa-arrow-up">
                            @elseif($sortField === 'ssoo' && $sortDirection === 'desc')
                                <i class="fa-solid fa-arrow-down"></i>
                    @endif
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sort('ssooversion')">
                    SSOO Version
                    @if($sortField === 'ssooversion' && $sortDirection === 'asc')
                        <i class="fa-solid fa-arrow-up">
                            @elseif($sortField === 'ssooversion' && $sortDirection === 'desc')
                                <i class="fa-solid fa-arrow-down"></i>
                    @endif
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sort('point_of_interest_id')">
                    Punto de Interes
                    @if($sortField === 'point_of_interest_id' && $sortDirection === 'asc')
                        <i class="fa-solid fa-arrow-up">
                            @elseif($sortField === 'point_of_interest_id' && $sortDirection === 'desc')
                                <i class="fa-solid fa-arrow-down"></i>
                    @endif
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sort('created_at')">
                    Fecha creación
                    @if($sortField === 'created_at' && $sortDirection === 'asc')
                        <i class="fa-solid fa-arrow-up">
                            @elseif($sortField === 'created_at' && $sortDirection === 'desc')
                                <i class="fa-solid fa-arrow-down"></i>
                    @endif
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
