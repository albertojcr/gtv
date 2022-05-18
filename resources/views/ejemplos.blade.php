<x-app-layout>
    <h1 class="text-2xl font-semibold text-gray-700 mb-6">Ejemplos de componentes</h1>

    <x-button>Botón azul</x-button>
    <x-button color="red">Botón rojo</x-button>
    <x-button-link href="#">Botón azul con link</x-button-link>
    <x-button-link color="red" href="#">Botón rojo con link</x-button-link>

    <x-table>
        <x-slot name="title">Tabla de ejemplo</x-slot>
        <x-slot name="thead">
            <th scope="col" class="px-6 py-3">
                Product name
            </th>
            <th scope="col" class="px-6 py-3">
                Color
            </th>
            <th scope="col" class="px-6 py-3">
                Category
            </th>
            <th scope="col" class="px-6 py-3">
                Price
            </th>
            <th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
            </th>
        </x-slot>
        <x-slot name="tbody">
            <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    Apple MacBook Pro 17"
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    Sliver
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    Laptop
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    $2999
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
        </x-slot>
    </x-table>
</x-app-layout>
