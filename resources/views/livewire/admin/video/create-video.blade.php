<div>
    <x-jet-dialog-modal wire:model="createForm.open">
        <x-slot name="title">
            <span class="text-2xl">Añadir vídeo</span>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                @if($videoTemporaryUrl)
                    @livewire('admin.video.video-preview', ['route' => $videoTemporaryUrl])
                @endif
                <div>
                    <x-jet-label>
                        Archivo
                    </x-jet-label>
                    <input wire:model="createForm.file" type="file" accept="video/mp4" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 mt-1">
                    <p wire:loading wire:target="createForm.file">Subiendo...</p>
                    <x-jet-input-error for="createForm.file" class="mt-2" />
                </div>
                <div>
                    <x-jet-label>
                        Punto de interés
                    </x-jet-label>
                    <select wire:model="createForm.pointOfInterest" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1">
                        <option value="" selected disabled>Elige uno</option>
                        @foreach($pointsOfInterest as $pointOfInterest)
                            <option value="{{ $pointOfInterest->id }}">{{ $pointOfInterest->id }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="createForm.pointOfInterest" class="mt-2" />
                </div>
                <div>
                    <x-jet-label>
                        Área temática
                    </x-jet-label>
                    <select wire:model="createForm.thematicArea" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1">
                        <option value="" selected disabled>Elige una</option>
                        @foreach($thematicAreas as $thematicArea)
                            <option value="{{ $thematicArea->id }}">{{ $thematicArea->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="createForm.thematicArea" class="mt-2" />
                </div>
                <div>
                    <x-jet-label>
                        Descripción
                    </x-jet-label>
                    <textarea wire:model="createForm.description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1"></textarea>
                    <x-jet-input-error for="createForm.description" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button color="green" wire:click="save">
                Crear
            </x-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('scripts')
        <script>
            Livewire.on('videoCreated', () => {
                Swal.fire(
                    '¡Hecho!',
                    'El vídeo ha sido creado.',
                    'success'
                )
            });
        </script>
    @endpush
</div>
