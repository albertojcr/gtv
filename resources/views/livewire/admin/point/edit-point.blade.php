<div>
    <x-jet-dialog-modal wire:model="editForm.open">
        <x-slot name="title">
            <span class="text-2xl">Editar Punto de Interes #{{ $pointId }}</span>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                <div>
                    <x-jet-label>
                        Nombre
                    </x-jet-label>
                    <input wire:model="editForm.name" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1">
                    <x-jet-input-error for="editForm.name" class="mt-2" />

                    <x-jet-label>
                        Distancia
                    </x-jet-label>
                    <input wire:model="editForm.distance" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1">
                    <x-jet-input-error for="editForm.distance" class="mt-2" />

                    <x-jet-label>
                        Longitud
                    </x-jet-label>
                    <input wire:model="editForm.longitude" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1"></input>
                    <x-jet-input-error for="editForm.longitude" class="mt-2" />

                    <x-jet-label>
                        Latitud
                    </x-jet-label>
                    <input wire:model="editForm.latitude" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1"></input>
                    <x-jet-input-error for="editForm.latitude" class="mt-2" />

                    <x-jet-label>
                        Sitio
                    </x-jet-label>
                    <select wire:model="editForm.place" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1">
                        <option value="" selected disabled>Elige uno</option>
                        @foreach($places as $place)
                            <option value="{{ $place->id }}">{{ $place->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="editForm.place" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button color="blue" wire:click="update('{{ $pointId }}')">
                Actualizar
            </x-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('scripts')
        <script>
            Livewire.on('pointUpdated', () => {
                Swal.fire(
                    '¡Hecho!',
                    'El punto ha sido actualizado.',
                    'success'
                )
            });
        </script>
    @endpush
</div>
