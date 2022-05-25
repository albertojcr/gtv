<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Visitas
                </h1>
            </div>
        </div>
    </header>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
        <h1 class="text-3xl text-center font-semibold mb-8">Detalles de la Visita</h1>

        <div class="bg-white shadow-xl rounded-lg p-6">
            <div class="grid grid-cols-2 gap-6 mb-4">

                <div class="mb-4">
                    <x-jet-label value="DeviceId:" /><label>{{ $visit->deviceid }}</label>
                </div>

                <div class="mb-4">
                    <x-jet-label value="AppVersion:" /><label>{{ $visit->appversion }}</label>
                </div>

                <div class="mb-4">
                    <x-jet-label value="UserAgent:" /><label>{{ $visit->useragent }}</label>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Ssoo:" />   <label>{{ $visit->ssoo }}</label>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Punto de Interes:" />  <label>{{ $visit->point_of_interest_id }}</label>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-4">
                    <div>
                        <x-jet-label value="Latitud:" /> <label>{{ $this->punto_interes->latitude }}</label>
                    </div>
                    <div>
                        <x-jet-label value="Longitud:" />   <label>{{ $this->punto_interes->longitude }}</label>
                    </div>
                </div>
                </div>

            <div class="flex justify-end items-center mt-4">
                <x-button-link href="{{ route('admin.visits.show') }}">
                    Volver
                </x-button-link>
            </div>
        </div>
    </div>
</div>
