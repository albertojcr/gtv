<div class="modal fade" id="createPhotographies" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="{{ route('admin.photographies.store','#photography') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="photography">Crear fotografia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group has-label">
                        <label for="name">Nombre de la foto:</label>
                        <input type="text" name="name" id="photographies-name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                               placeholder="Escribe el nombre de la foto" value="{{ old('name') }}" required>
                        {!! $errors->first('name','<span class="form-text text-danger">:message</span>') !!}
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
        if (window.location.hash === '#photography') {
            $('#createPhotographies').modal('show');
        }
        $('#createPhotographies').on('hide.bs.modal', function () {
            window.location.hash = '#';
        });
        $('#createPhotographies').on('shown.bs.modal', function () {
            $('#photographies-name').focus();
            window.location.hash = '#photography';
        });
    </script>
@endpush
