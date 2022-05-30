<div>
    <h1 class="text-2xl font-semibold text-gray-700 mb-6">Metadatos de vídeos</h1>

    @if(count($videoItems))
        <x-table>
            <x-slot name="thead">
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    ID del vídeo
                </th>
                <th scope="col" class="px-6 py-3">
                    Nombre del vídeo
                </th>
                <th scope="col" class="px-6 py-3">
                    Calidad
                </th>
                <th scope="col" class="px-6 py-3">
                    Formato
                </th>
                <th scope="col" class="px-6 py-3">
                    Orientación
                </th>
                <th scope="col" class="px-6 py-3">
                    Fecha creación
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
