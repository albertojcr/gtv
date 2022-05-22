<div>category.blade
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Productos
                </h1>
                <x-jet-danger-button wire:click="$emit('deleteVisit')">
                    Eliminar
                </x-jet-danger-button>
            </div>
        </div>
    </header>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
        <h1 class="text-3xl text-center font-semibold mb-8">Complete los datos para crear un producto</h1>

        <div class="mb-4" wire:ignore>
            <form action="{{ route('admin.products.files', $product) }}"
                  method="POST"
                  class="dropzone"
                  id="my-awesome-dropzone"></form>
        </div>

        @livewire('admin.status-product',['product' => $product], key('status-product-'.$product->id))

        <div class="bg-white shadow-xl rounded-lg p-6">
            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <x-jet-label value="Categorías" />
                    <select class="w-full form-control" wire:model="category_id">
                        <option value="" selected disabled>Seleccione una categoría</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="category_id" />
                </div>
                <div>
                    <x-jet-label value="Subcategorías" />
                    <select class="w-full form-control" wire:model="product.subcategory_id">
                        <option value="" selected disabled>Seleccione una subcategoría</option>
                        @foreach($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="product.subcategory_id" />
                </div>
            </div>
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input type="text"
                             class="w-full"
                             wire:model="product.name"
                             placeholder="Ingrese el nombre del producto" />
                <x-jet-input-error for="product.name" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Slug" />
                <x-jet-input type="text"
                             disabled
                             wire:model="product.slug"
                             class="w-full bg-gray-200"
                             placeholder="Ingrese el slug del producto" />
                <x-jet-input-error for="product.slug" />
            </div>
            <div class="mb-4">
                <div wire:ignore>
                    <x-jet-label value="Descripción" />
                    <textarea class="w-full form-control" rows="4"
                              wire:model="product.description"
                              x-data
                              x-init="ClassicEditor.create($refs.miEditor)
                                 .then(function(editor){
                                 editor.model.document.on('change:data', () => {
                                 @this.set('product.description', editor.getData())
                                 })
                                 })
                                 .catch( error => {
                                 console.error( error );
                                 } );"
                              x-ref="miEditor">
                    </textarea>
                </div>
                <x-jet-input-error for="product.description" />
            </div>
            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <x-jet-label value="Marca" />
                    <select class="form-control w-full" wire:model="product.brand_id">
                        <option value="" selected disabled>Seleccione una marca</option>
                        @foreach ($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="product.brand_id" />
                </div>
                <div>
                    <x-jet-label value="Precio" />
                    <x-jet-input
                        wire:model="product.price"
                        type="number"
                        class="w-full"
                        step=".01" />
                    <x-jet-input-error for="product.price" />
                </div>
            </div>
            @if ($this->subcategory && !$this->subcategory->color && !$this->subcategory->size)
                <div>
                    <x-jet-label value="Cantidad" />
                    <x-jet-input
                        wire:model="product.quantity"
                        type="number"
                        class="w-full" />
                    <x-jet-input-error for="product.quantity" />
                </div>
            @endif
            <div class="flex justify-end items-center mt-4">
                <x-jet-action-message class="mr-3" on="saved">
                    Actualizado
                </x-jet-action-message>
                <x-jet-button
                    wire:loading.attr="disabled"
                    wire:target="save"
                    wire:click="save"
                    class="ml-auto">
                    Actualizar producto
                </x-jet-button>
            </div>
        </div>
        @if($this->subcategory)
            @if($this->subcategory->size)
                @livewire('admin.size-product', ['product' => $product], key('size-product-' . $product->id))
            @elseif($this->subcategory->color)
                @livewire('admin.color-product', ['product' => $product], key('color-product-' . $product->id))
            @endif
        @endif
    </div>

    @push('scripts')
        <script>
            Livewire.on('deleteVisit', () => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.edit-visit', 'delete');
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>
