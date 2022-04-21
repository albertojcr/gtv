<div class="card-header ">
    <h4 class="card-title">Lugar nº {{ $place->id }}</h4>
</div>
<div class="card-body">
    <div class="text-left">
        <p><span class="font-weight-bold">Nombre:</span> {{ $place->name }}</p>
        <p><span class="font-weight-bold">Descripción:</span> {{ $place->description }}</p>
        <p><span class="font-weight-bold">¿Hay más lugares?:</span> {{ $place->place_id ? 'Si' : 'No' }}</p>
        <p><span class="font-weight-bold">Creado por:</span> {{ $place->userCreator->login }} {{ $place->date_create->diffForHumans() }}</p>
        <p><span class="font-weight-bold">Editado por:</span> {{ $place->userUpdater ? $place->userUpdater->login : '' }} {{ $place->last_update ? $place->last_update->diffForHumans() : '' }}</p>
    </div>
    <div class="text-center">
        <a href="{{ route('admin.places.index') }}" class="btn btn-primary">Volver</a>
    </div>
</div>
