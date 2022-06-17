<div>
    <h1 class="text-2xl font-semibold text-gray-700 mb-6">Metadatos de vídeos</h1>

    <div class="mb-3">
        <div class="inline">
            <select class="text-black  bg-blue-100 hover:bg-grey-200 focus:ring-4 focus:ring-blue-300
                    font-medium rounded-lg text-sm py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700
                    focus:outline-none dark:focus:ring-blue-800 ml-auto" wire:model="searchColumn">
                <option value="id">ID</option>
                <option value="video_id">ID VIDEO</option>
                <option value="quality">CALIDAD</option>
                <option value="format">FORMATO</option>
                <option value="orientation">HORIENTACIÓN</option>
                <option value="created_at">FECHA DE CREACIÓN</option>
            </select>
        </div>

        <x-jet-input class="py-1 border-black" type="text" wire:model="search"
                     placeholder="Buscar ..."></x-jet-input>

        <x-jet-button wire:click="resetFilters">Eliminar filtros</x-jet-button>

    @if(count($videoItems))
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
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sort('video_id')">
                    ID del vídeo
                    @if($sortField === 'video_id' && $sortDirection === 'asc')
                        <i class="fa-solid fa-arrow-up">
                            @elseif($sortField === 'video_id' && $sortDirection === 'desc')
                                <i class="fa-solid fa-arrow-down"></i>
                    @endif
                </th>
                <th scope="col" class="px-6 py-3">
                    Nombre del vídeo
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sort('quality')">
                    Calidad
                    @if($sortField === 'quality' && $sortDirection === 'asc')
                        <i class="fa-solid fa-arrow-up">
                            @elseif($sortField === 'quality' && $sortDirection === 'desc')
                                <i class="fa-solid fa-arrow-down"></i>
                    @endif
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sort('format')">
                    Formato
                    @if($sortField === 'format' && $sortDirection === 'asc')
                        <i class="fa-solid fa-arrow-up">
                            @elseif($sortField === 'format' && $sortDirection === 'desc')
                                <i class="fa-solid fa-arrow-down"></i>
                    @endif
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sort('orientation')">
                    Orientación
                    @if($sortField === 'orientation' && $sortDirection === 'asc')
                        <i class="fa-solid fa-arrow-up">
                            @elseif($sortField === 'orientation' && $sortDirection === 'desc')
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
            </x-slot>

            <x-slot name="tbody">
                @foreach($videoItems as $videoItem)
                    <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $videoItem->id }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $videoItem->video_id }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $videoItem->video->description }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $videoItem->quality }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $videoItem->format }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $videoItem->orientation }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $videoItem->created_at }}
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>

        @if($videoItems->hasPages())
            <div class="mt-6">
                {{ $videoItems->links() }}
            </div>
        @endif
    @else
        <p class="mt-4">No se han encontrado resultados</p>
    @endif
</div>
