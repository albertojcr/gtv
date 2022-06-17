<div>
    <div class="flex items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-700">Listado de vídeos</h1>

        <button type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 ml-auto"
                wire:click="$emitTo('admin.video.create-video', 'openCreationModal')">
            Añadir
        </button>
    </div>

    @livewire('admin.video.create-video')

    @if(count($videos))
        @livewire('admin.video.edit-video')

        <x-table>
            <x-slot name="thead">
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Descripción
                </th>
                <th scope="col" class="px-6 py-3">
                    Punto de interés
                </th>
                <th scope="col" class="px-6 py-3">
                    Orden
                </th>
                <th scope="col" class="px-6 py-3">
                    Área temática
                </th>
                <th scope="col" class="px-6 py-3">
                    Creador
                </th>
                <th scope="col" class="px-6 py-3">
                    Actualizador
                </th>
                <th scope="col" class="px-6 py-3">
                    Fecha creación
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Actions</span>
                </th>
            </x-slot>

            <x-slot name="tbody">
                @foreach($videos as $video)
                    <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $video->id }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $video->description }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $video->pointOfInterest->id }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $video->order }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            @if( ! is_null($video->thematic_area_id))
                                {{ $video->thematicArea->name }}
                            @else
                               <span class="text-red-600">Sin área temática</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ \App\Models\User::find($video->creator)->name }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            @if($video->updater)
                                {{ \App\Models\User::find($video->updater)->name }}
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $video->created_at }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap flex gap-4">
                            <span class="font-medium text-blue-600 cursor-pointer" wire:click="show('{{ $video->id }}')">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                            <span class="font-medium text-yellow-400 cursor-pointer"
                               wire:click="$emitTo('admin.video.edit-video', 'openEditModal', '{{ $video->id }}')">
                                <i class="fa-solid fa-pencil"></i>
                            </span>
                            <span class="font-medium text-red-500 cursor-pointer"
                               wire:click="$emit('deleteVideo', '{{ $video->id }}')">
                                <i class="fa-solid fa-trash"></i>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>

        @if($videos->hasPages())
            <div class="mt-6">
                {{ $videos->links() }}
            </div>
        @endif
    @else
        <p class="mt-4">No se han encontrado resultados</p>
    @endif

    {{-- Modal show --}}
    <x-jet-dialog-modal wire:model="detailsModal.open">
        <x-slot name="title">
            <span class="text-2xl">Detalles del vídeo #{{ $detailsModal['id'] }}</span>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-3">
                @if($detailsModal['route'] !== null)
                    @livewire('admin.video.video-preview', ['route' => $detailsModal['route']])
                @endif
                <div>
                    <x-jet-label>
                        Descripción: {{ $detailsModal['description']}}
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Ruta: {{ $detailsModal['route'] }}
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Orden: {{ $detailsModal['order'] }}
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Punto de interés: {{ $detailsModal['pointOfInterest'] }}
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        @if( ! empty($detailsModal['thematicAreaId']))
                            Área temática: {{ $detailsModal['thematicAreaName'] }} ({{ $detailsModal['thematicAreaId'] }})
                        @else
                            Área temática: <span class="text-red-600">Sin área temática</span>
                        @endif
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Creador: {{ $detailsModal['creatorName'] }} ({{ $detailsModal['creatorId'] }})
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Actualizador:
                        @if($detailsModal['updaterName'])
                            {{ $detailsModal['updaterName'] }} ({{ $detailsModal['updaterId'] }})
                        @else
                            {{ 'ninguno' }}
                        @endif
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Fecha de creación: {{ $detailsModal['createdAt'] }}
                    </x-jet-label>
                </div>
                <div>
                    <x-jet-label>
                        Fecha de actualización: {{ $detailsModal['updatedAt'] }}
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

    @push('scripts')
        <script>
            Livewire.on('deleteVideo', videoId => {
                Swal.fire({
                    title: '¿Quieres eliminar este vídeo?',
                    text: 'Esta operación es irreversible',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.video.list-videos', 'delete', videoId)
                        Swal.fire(
                            '¡Hecho!',
                            'El vídeo ha sido eliminado.',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>
