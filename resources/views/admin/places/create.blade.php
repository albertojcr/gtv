<div class="modal fade" id="createPlaces" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="{{ route('admin.places.store','#place') }}" method="POST">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Crear lugar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre: </label>
                        <input type="text" name="name" id="places-name" class="form-control {{ $errors->has('name') ? 'active' : '' }}" placeholder="Introduce un nombre para el lugar" required>
                        {!! $errors->first('name', '<span class="form-text text-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        if (window.location.hash === '#place') {
            $('#createPlaces').modal('show');
        }
        $('#createPlaces').on('hide.bs.modal', function () {
            window.location.hash = '#';
        });
        $('#createPlaces').on('shown.bs.modal', function () {
            $('#places-name').focus();
            window.location.hash = '#place';
        });
    </script>
@endpush
