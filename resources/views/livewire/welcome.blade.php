<div>

    @hasanyrole('Administrador|Profesor')

    <!--TABLA VIDEOS   ID-DESCRIPCION-AREA TEMATICA-->

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3" colspan="2">
                    ÚLTIMOS VIDEOS
                </th>
                <th scope="col" class="px-6 py-3 text-right" colspan="2">
                    TOTAL - {{$countvideos}}
                </th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-6 py-3">
                        ID
                    </td>
                    <td class="px-6 py-3">
                        DESCRIPCIÓN
                    </td>
                    <td class="px-6 py-3">
                        ÁREA TEMÁTICA
                    </td>
                </tr>
                @foreach($videos as $video)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        {{ $video->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $video->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $video->description }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button wire:click="showPlaces('{{ $video->id }}')" class="text-orange-500 hover:text-orange-400 hover:underline ml-2 font-semibold">
                        Ver más
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!--TABLA LUGARES   ID-NOMBRE-DESCRIPCION-->

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3" colspan="2">
                    ÚLTIMOS LUGARES
                </th>
                <th scope="col" class="px-6 py-3 text-right" colspan="2">
                    TOTAL - {{$countplaces}}
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="px-6 py-3">
                    ID
                </td>
                <td class="px-6 py-3">
                    NOMBRE
                </td>
                <td class="px-6 py-3">
                    DESCRIPCIÓN
                </td>
            </tr>
            @foreach($places as $place)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        {{ $place->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $place->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $place->description }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button wire:click="showPlaces('{{ $place->id }}')" class="text-orange-500 hover:text-orange-400 hover:underline ml-2 font-semibold">
                            Ver más
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!--TABLA LUGARES   ID-NOMBRE-DESCRIPCION-->

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3" colspan="2">
                    ÚLTIMOS LUGARES
                </th>
                <th scope="col" class="px-6 py-3 text-right" colspan="2">
                    TOTAL - {{$countplaces}}
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="px-6 py-3">
                    ID
                </td>
                <td class="px-6 py-3">
                    NOMBRE
                </td>
                <td class="px-6 py-3">
                    DESCRIPCIÓN
                </td>
            </tr>
            @foreach($places as $place)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        {{ $place->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $place->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $place->description }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button wire:click="showPlaces('{{ $place->id }}')" class="text-orange-500 hover:text-orange-400 hover:underline ml-2 font-semibold">
                            Ver más
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!--TABLA LUGARES   ID-NOMBRE-DESCRIPCION-->

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3" colspan="2">
                    ÚLTIMOS LUGARES
                </th>
                <th scope="col" class="px-6 py-3 text-right" colspan="2">
                    TOTAL - {{$countplaces}}
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="px-6 py-3">
                    ID
                </td>
                <td class="px-6 py-3">
                    NOMBRE
                </td>
                <td class="px-6 py-3">
                    DESCRIPCIÓN
                </td>
            </tr>
            @foreach($places as $place)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        {{ $place->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $place->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $place->description }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button wire:click="showPlaces('{{ $place->id }}')" class="text-orange-500 hover:text-orange-400 hover:underline ml-2 font-semibold">
                            Ver más
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!--TABLA LUGARES   ID-NOMBRE-DESCRIPCION-->

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3" colspan="2">
                    ÚLTIMOS LUGARES
                </th>
                <th scope="col" class="px-6 py-3 text-right" colspan="2">
                    TOTAL - {{$countplaces}}
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="px-6 py-3">
                    ID
                </td>
                <td class="px-6 py-3">
                    NOMBRE
                </td>
                <td class="px-6 py-3">
                    DESCRIPCIÓN
                </td>
            </tr>
            @foreach($places as $place)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        {{ $place->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $place->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $place->description }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button wire:click="showPlaces('{{ $place->id }}')" class="text-orange-500 hover:text-orange-400 hover:underline ml-2 font-semibold">
                            Ver más
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!--TABLA LUGARES   ID-NOMBRE-DESCRIPCION-->

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3" colspan="2">
                    ÚLTIMOS LUGARES
                </th>
                <th scope="col" class="px-6 py-3 text-right" colspan="2">
                    TOTAL - {{$countplaces}}
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="px-6 py-3">
                    ID
                </td>
                <td class="px-6 py-3">
                    NOMBRE
                </td>
                <td class="px-6 py-3">
                    DESCRIPCIÓN
                </td>
            </tr>
            @foreach($places as $place)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        {{ $place->id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $place->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $place->description }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button wire:click="showPlaces('{{ $place->id }}')" class="text-orange-500 hover:text-orange-400 hover:underline ml-2 font-semibold">
                            Ver más
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    @endrole


    {{-- Modal showPlaces --}}

    <x-jet-dialog-modal wire:model="detailsModal.open">
        <x-slot name="title">
            <span class="text-2xl">Detalles del lugar #{{ $detailsModalPlaces['id'] }}</span>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-3">
                <div>
                    <x-jet-label>
                        ID: {{ $detailsModalPlaces['id']}}
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Nombre: {{ $detailsModalPlaces['name']}}
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Descripción: {{ $detailsModalPlaces['description']}}
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Creador: {{ $detailsModalPlaces['creatorName'] }} ({{ $detailsModalPlaces['creatorId'] }})
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Actualizador:
                        @if($detailsModalPlaces['updaterName'])
                            {{ $detailsModalPlaces['updaterName'] }} ({{ $detailsModalPlaces['updaterId'] }})
                        @else
                            {{ 'ninguno' }}
                        @endif
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Fecha de creación: {{ $detailsModalPlaces['createdAt'] }}
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Última actualización: {{ $detailsModalPlaces['updatedAt'] }}
                    </x-jet-label>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="$set('detailsModalPlaces.open', false)">
                Cerrar
            </x-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
