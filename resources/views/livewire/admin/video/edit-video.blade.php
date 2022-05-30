<div>
    <x-jet-dialog-modal wire:model="editForm.open">
        <x-slot name="title">
            <span class="text-2xl">Editar vídeo #{{ $videoId }}</span>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                @livewire('admin.video.video-preview', ['route' => $videoRoute])
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
                <div>
                    <x-jet-label>
                        Área temática
                    </x-jet-label>
                    <select wire:model="editForm.thematicArea" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1">
                        @foreach($thematicAreas as $thematicArea)
                            <option value="{{ $thematicArea->id }}" @if($thematicArea->id === $editForm['thematicArea']) {{ 'selected' }} @endif>
                                {{ $thematicArea->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="editForm.thematicArea" class="mt-2" />
                </div>
                <div>
                    <x-jet-label>
                        Descripción
                    </x-jet-label>
                    <textarea wire:model="editForm.description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1"></textarea>
                    <x-jet-input-error for="editForm.description" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button color="green" wire:click="update('{{ $videoId }}')">
                Actualizar
            </x-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('scripts')
        <script>
            Livewire.on('videoUpdated', () => {
                Swal.fire(
                    '¡Hecho!',
                    'El vídeo ha sido actualizado.',
                    'success'
                )
            });
        </script>
    @endpush
</div>
