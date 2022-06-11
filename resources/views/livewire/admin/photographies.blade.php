<div>
    <div>
        <div class="flex items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-700">Listado de fotografías</h1>
            <button wire:click="$toggle('showForm')" type="button" class="text-white bg-blue-700
                hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm
                px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none
                dark:focus:ring-blue-800 ml-auto">
                {{ ($this->showForm) ? 'Cerrar' : 'Añadir' }}
            </button>
        </div>



        <form class="p-5 mb-6 rounded-md drop-shadow-lg bg-gray-50 {{ ($this->showForm) ? '' : 'hidden' }}"
              wire:submit.prevent="save">
            <h2 class="text-2xl mb-6">Añadir fotografía</h2>

            @if ($this->createForm['route'])
                Preview
                <img src="{{ $this->createForm['route']->temporaryUrl() }}">
            @endif

            <div class="mb-6">
                <label for="Fotografía" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Fotografía
                </label>
                <input type="file" id="Fotografía" class="bg-gray-100 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       wire:model="createForm.route">
                @error('createForm.route') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="pointsOfInterest" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                    Punto de interés
                </label>
                <select id="pointsOfInterest" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="createForm.pointOfInterestId">
                    <option>Seleccione un punto de interes</option>
                    @foreach ($pointsOfInterest as $pointOfInterest)
                        <option value="{{ $pointOfInterest->id}}">{{ $pointOfInterest->id }}</option>
                    @endforeach
                </select>
                @error('createForm.pointOfInterestId') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="thematicAreas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                    Área temática
                </label>
                <select id="thematicAreas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="createForm.thematicAreaId">
                    <option>Seleccione un area de temática</option>
                    @foreach ($thematicAreas as $thematicArea)
                        <option value="{{ $thematicArea->id }}">{{ $thematicArea->name }}</option>
                    @endforeach
                </select>
                @error('createForm.thematicAreaId') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4
                focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full
                sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700
                dark:focus:ring-blue-800">
                Añadir
            </button>
        </form>



        @if(count($photographies))
            <x-table>
                <x-slot name="thead">
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ruta
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Orden
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Punto de interés
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
                        Fecha actualización
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </x-slot>

                <x-slot name="tbody">
                    @foreach($photographies as $photography)
                        <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $photography->id }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <a class="max-w-xs" href="{{ $photography->route }}" target="_blank">
                                    <img src="{{ $photography->route }}">
                                </a>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $photography->order }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $photography->point_of_interest_id }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ \App\Models\ThematicArea::find($photography->thematic_area_id)->name }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ \App\Models\User::find($photography->creator)->name }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ \App\Models\User::find($photography->updater)->name }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $photography->created_at }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $photography->updated_at }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <span class="font-medium text-blue-600 cursor-pointer mr-3"
                                      wire:click="edit('{{ $photography->id }}')">
                                    <i class="fa-solid fa-pencil"></i>
                                </span>
                                <span class="font-medium text-red-500 cursor-pointer"
                                      wire:click="$emit('deletePhotography', '{{ $photography->id }}')">
                                    <i class="fa-solid fa-trash"></i>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>

            @if($photographies->hasPages())
                <div class="mt-6">
                    {{ $photographies->links() }}
                </div>
            @endif
        @else
            <p class="mt-4">No se han encontrado resultados</p>
        @endif
    </div>



    <x-jet-dialog-modal wire:model="editModal.open">
        <x-slot name="title">
            <span class="text-2xl">Editar la fotografía #{{ $editModal['id'] }}</span>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-3">

                <form wire:submit.prevent="update({{ $editModal['id'] }})">
                    <div class="mb-4">
                        @if ($this->editForm['route'])
                            Preview:
                            <img src="{{ $this->editForm['route']->temporaryUrl() }}">
                        @else
                            <a class="max-w-xs" href="{{ $this->editModal['route'] }}" target="_blank">
                                <img src="{{ $this->editModal['route'] }}">
                            </a>
                        @endif
                    </div>

                    <div class="mb-4">
                        <x-jet-label>
                            Ruta: {{ $editModal['route'] }}
                        </x-jet-label>
                    </div>

                    <div class="mb-4">
                        <x-jet-label>
                            Cambiar fotografía
                        </x-jet-label>
                        <x-jet-input type="file" wire:model="editForm.route"></x-jet-input>
                        <x-jet-input-error for="editForm.route" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-jet-label>
                            Orden: {{ $editModal['order'] }}
                        </x-jet-label>
                    </div>

                    <div class="mb-4">
                        <x-jet-label>
                            Punto de interés
                        </x-jet-label>
                        <select wire:model="editForm.pointOfInterestId" class="bg-gray-50 border border-gray-300
                            text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full
                            p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                            dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1">
                            @foreach($pointsOfInterest as $pointOfInterest)
                                <option value="{{ $pointOfInterest->id }}">{{ $pointOfInterest->id }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="editForm.pointOfInterest" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-jet-label>
                            Área temática
                        </x-jet-label>
                        <select wire:model="editForm.thematicAreaId" class="bg-gray-50 border border-gray-300
                            text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full
                            p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                            dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1">
                            @foreach($thematicAreas as $thematicArea)
                                <option value="{{ $thematicArea->id }}">{{ $thematicArea->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="editForm.thematicAreaId" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-jet-label>
                            Creador: {{ $editModal['creatorName'] }} (ID: {{ $editModal['creatorId'] }})
                        </x-jet-label>
                    </div>

                    <div class="mb-4">
                        <x-jet-label>
                            Actualizador: {{ $editModal['updaterName'] }} (ID: {{ $editModal['updaterId'] }})
                        </x-jet-label>
                    </div>

                    <div class="mb-4">
                        <x-jet-label>
                            Fecha de creación: {{ $editModal['createdAt'] }}
                        </x-jet-label>
                    </div>

                    <div class="mb-4">
                        <x-jet-label>
                            Fecha de actualización: {{ $editModal['updatedAt'] }}
                        </x-jet-label>
                    </div>

                    <button wire:click="update({{ $editModal['id'] }})" type="submit" class="text-white
                    bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300
                    font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center
                    dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Editar
                    </button>
                </form>

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="$set('editModal.open', false)">
                Cerrar
            </x-button>
        </x-slot>
    </x-jet-dialog-modal>



    @push('scripts')
        <script>
            Livewire.on('deletePhotography', photographyId => {
                Swal.fire({
                    title: '¿Quieres eliminar esta fotografía?',
                    text: 'Esta operación es irreversible',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.photographies', 'delete', photographyId)
                        Swal.fire(
                            '¡Hecho!',
                            'La fotografía ha sido eliminada.',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>
