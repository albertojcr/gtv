<div>
    <div>
        <div class="flex items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-700">Listado de áreas temáticas</h1>

            <button wire:click="$toggle('createForm.open')" type="button" class="text-white bg-blue-700
                hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm
                px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none
                dark:focus:ring-blue-800 ml-auto" style="margin-left:10px;">
                Añadir
            </button>
        </div>

        @if(count($thematicAreas))
            <x-table>
                <x-slot name="thead">
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Descripción
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
                    @foreach($thematicAreas as $thematicArea)
                        <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $thematicArea->id }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $thematicArea->name }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $thematicArea->description }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $thematicArea->created_at }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $thematicArea->updated_at }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <span class="font-medium text-blue-600 cursor-pointer"
                                      wire:click="show('{{ $thematicArea->id }}')">
                                    <i class="fa-solid fa-eye"></i> Ver
                                </span>
                                <span class="font-medium text-blue-600 cursor-pointer mr-3"
                                      wire:click="edit('{{ $thematicArea->id }}')">
                                    <i class="fa-solid fa-pencil"></i> Editar
                                </span>
                                <span class="font-medium text-red-500 cursor-pointer"
                                      wire:click="$emit('deleteThematicArea', '{{ $thematicArea->id }}')">
                                    <i class="fa-solid fa-trash"></i> Eliminar
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>

            @if($thematicAreas->hasPages())
                <div class="mt-6">
                    {{ $thematicAreas->links() }}
                </div>
            @endif
        @else
            <p class="mt-4">No se han encontrado resultados</p>
        @endif
    </div>

    <x-jet-dialog-modal wire:model="showModal.open">
        <x-slot name="title">
            <span class="text-2xl">Detalle del área temática #{{ $showModal['id'] }}</span>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                <div class="mb-4">
                    <x-jet-label>
                        Nombre: {{ $showModal['name'] }}
                    </x-jet-label>
                </div>

                <div class="mb-4">
                    <x-jet-label>
                        Descripción: {{ $showModal['description'] }}
                    </x-jet-label>
                </div>

                <div class="mb-4">
                    <x-jet-label>
                        Fecha de creación: {{ $showModal['createdAt'] }}
                    </x-jet-label>
                </div>

                <div class="mb-4">
                    <x-jet-label>
                        Fecha de actualización: {{ $showModal['updatedAt'] }}
                    </x-jet-label>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="$toggle('showModal.open')">
                Cerrar
            </x-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="createForm.open">
        <x-slot name="title">
            <span class="text-2xl">Crear área temática</span>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                <div class="mb-4">
                    <x-jet-label>
                        Nombre
                    </x-jet-label>

                    <x-jet-input type="text" wire:model="createForm.name"></x-jet-input>

                    <x-jet-input-error for="createForm.name" class="mt-2" />
                </div>
                <div>
                    <x-jet-label>
                        Descripción
                    </x-jet-label>

                    <textarea wire:model="createForm.description" rows="4" class="block p-2.5 w-full
                    text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500
                    focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1"></textarea>

                    <x-jet-input-error for="createForm.description" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button style="margin-right: 10px;" wire:click="save">
                Crear
            </x-button>
            <x-button wire:click="$toggle('createForm.open')">
                Cerrar
            </x-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="editModal.open">
        <x-slot name="title">
            <span class="text-2xl">Actualizar área temática</span>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                <div class="mb-4">
                    <x-jet-label>
                        Nombre
                    </x-jet-label>

                    <x-jet-input type="text" wire:model="editForm.name"></x-jet-input>

                    <x-jet-input-error for="editForm.name" class="mt-2" />
                </div>
                <div>
                    <x-jet-label>
                        Descripción
                    </x-jet-label>

                    <textarea wire:model="editForm.description" rows="4" class="block p-2.5 w-full
                    text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500
                    focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1"></textarea>

                    <x-jet-input-error for="editForm.description" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button style="margin-right: 10px;" wire:click="update({{ $editModal['id'] }})">
                Actualizar
            </x-button>
            <x-button wire:click="$toggle('editModal.open')">
                Cerrar
            </x-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('scripts')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            Livewire.on('thematicAreaCreated', () => {
                Swal.fire(
                    '¡Hecho!',
                    'El área temática ha sido creada.',
                    'success'
                )
            });
        </script>

        <script>
            Livewire.on('thematicAreaUpdated', () => {
                Swal.fire(
                    '¡Hecho!',
                    'El área temática ha sido actualizada.',
                    'success'
                )
            });
        </script>

        <script>
            Livewire.on('deleteThematicArea', thematicAreaId => {
                Swal.fire({
                    title: '¿Quieres eliminar esta área temática?',
                    text: 'Esta operación es irreversible',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.thematic-areas', 'delete', thematicAreaId)
                        Swal.fire(
                            '¡Hecho!',
                            'El área temática ha sido eliminada.',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>
