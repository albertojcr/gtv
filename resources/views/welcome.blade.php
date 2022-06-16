<x-app-layout>

    <div class="container-menu py-8">
        <section class="mb-6">
            <h1 class="text-lg uppercase font-semibold text-gray-700">
                Lugares más visitados:
            </h1>
            <div class="flex items-center mb-2">
                @foreach($places as $place)
                    <td class="text-lg uppercase font-semibold text-gray-700">
                        {{ $place->name }}
                    </td>
                @endforeach

                <a href="{{ route('places.index', $place) }}" class="text-orange-500 hover:text-orange-400 hover:underline ml-2 font-semibold">Ver más</a>
            </div>
        </section>
    </div>

</x-app-layout>

