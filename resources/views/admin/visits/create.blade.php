<div class="modal fade" id="createVisits" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="{{ route('admin.visits.store','#visit') }}" method="POST">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Crear visita </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="deviceid">Dispositivo:</label>
                        <input type="text" id="visits-deviceid" name="deviceid" class="form-control {{ $errors->has('deviceid') ? 'active' : '' }}" placeholder="Escribe un dispositivo para la visita " required>
                        {!! $errors->first('deviceid', '<span class="form-text text-danger">:message</span>') !!}
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
        if (window.location.hash === '#visit') {
            $('#createVisits').modal('show');
        }
        $('#createVisits').on('hide.bs.modal', function () {
            window.location.hash = '#';
        });
        $('#createVisits').on('shown.bs.modal', function () {
            $('#visits-deviceid').focus();
            window.location.hash = '#visit';
        });
    </script>
@endpush
