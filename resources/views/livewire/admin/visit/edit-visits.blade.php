<div>
    <x-jet-dialog-modal wire:model="editForm.open">
        <x-slot name="title">
            <span class="text-2xl">Editar Visita #{{ $visitId }}</span>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                <div>
                    <x-jet-label>
                        DeviceId
                    </x-jet-label>
                    <input disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1" />
                </div>
                <div>
                    <x-jet-label>
                        App Version
                    </x-jet-label>
                    <input disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1" />
                </div>
                <div>
                    <x-jet-label>
                        User Agent
                    </x-jet-label>
                    <input wire:model="editForm.useragent" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1" />
                    <x-jet-input-error for="editForm.useragent" class="mt-2" />
                </div>
                <div>
                    <x-jet-label>
                        SSOO
                    </x-jet-label>
                    <input wire:model="editForm.ssoo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1" />
                    <x-jet-input-error for="editForm.ssoo" class="mt-2" />
                </div>
                <div>
                    <x-jet-label>
                        Punto de interés
                    </x-jet-label>
                    <select wire:model="editForm.pointOfInterest" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1">
                        @foreach($pointsOfInterest as $pointOfInterest)
                            <option value="{{ $pointOfInterest->id }}" @if($pointOfInterest->id === $editForm['pointOfInterest']) {{ 'selected' }} @endif>
                                {{ $pointOfInterest->id }}
                            </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="editForm.pointOfInterest" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button color="blue" wire:click="update('{{ $visitId }}')">
                Actualizar
            </x-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('scripts')
        <script>
            Livewire.on('visitUpdated', () => {
                Swal.fire(
                    '¡Hecho!',
                    'La Visita ha sido actualizado.',
                    'success'
                )
            });
        </script>
    @endpush
</div>
