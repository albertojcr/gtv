<div>
    <x-jet-dialog-modal wire:model="createForm.open">
        <x-slot name="title">
            <span class="text-2xl">Añadir usuario</span>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                @if($avatarTemporaryUrl)
                    <img class="w-36 h-36 rounded-full mx-auto" src="{{ $avatarTemporaryUrl }}" alt="User avatar">
                @endif

                <div>
                    <x-jet-label>
                        Avatar
                    </x-jet-label>
                    <input wire:model="createForm.avatar" type="file" accept=".png, .jpg" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 mt-1">
                    <p wire:loading wire:target="createForm.avatar">Subiendo...</p>
                    <x-jet-input-error for="createForm.avatar" class="mt-2" />
                </div>

                <div class="grid gap-6 mb-6 lg:grid-cols-2">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nombre</label>
                        <input wire:model="createForm.name" type="text" id="name" minlength="1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <x-jet-input-error for="createForm.name" class="mt-2" />
                    </div>
                    <div>
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Role</label>
                        <select wire:model="createForm.role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1">
                            <option value="" selected disabled>Elige uno</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="createForm.role" class="mt-2" />
                    </div>
                </div>

                <div class="grid gap-6 mb-6 lg:grid-cols-2">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                        <input wire:model="createForm.email" type="email" id="email" minlength="1" maxlength="45" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <x-jet-input-error for="createForm.email" class="mt-2" />
                    </div>
                    <div>
                        <label for="email_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirmar email</label>
                        <input wire:model="createForm.email_confirmation" type="email" id="email_confirmation" minlength="1" maxlength="45" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                </div>

                <div class="grid gap-6 mb-6 lg:grid-cols-2">
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Contraseña</label>
                        <input wire:model="createForm.password" type="password" id="password" minlength="8" maxlength="45" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <x-jet-input-error for="createForm.password" class="mt-2" />
                    </div>
                    <div>
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirmar contraseña</label>
                        <input wire:model="createForm.password_confirmation" type="password" id="password_confirmation" minlength="8" maxlength="45" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="save">
                Crear
            </x-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('scripts')
        <script>
            Livewire.on('userCreated', () => {
                Swal.fire(
                    '¡Hecho!',
                    'El usuario ha sido creado.',
                    'success'
                )
            });
        </script>
    @endpush
</div>
