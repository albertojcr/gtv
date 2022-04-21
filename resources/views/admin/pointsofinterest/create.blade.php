<div class="modal fade" id="createPointsofinterest" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="{{ route('admin.pointsofinterest.store', '#point') }}" method="POST">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Crear punto de interés</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="qr">Codigo qr: </label>
                        <input type="text" id="pointsofinterest-qr" name="qr" class="form-control {{ $errors->has('qr') ? 'active' : '' }}" placeholder="Escribe un codigo de barras" required>
                        {!!  $errors->first('qr', '<span class="form-text text-danger">:message</span>') !!}
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
        if (window.location.hash === '#point') {
            $('#createPointsofinterest').modal('show');
        }
        $('#createPointsofinterest').on('hide.bs.modal', function () {
            window.location.hash = '#';
        });
        $('#createPointsofinterest').on('shown.bs.modal', function () {
            $('#pointsofinterest-qr').focus();
            window.location.hash = '#point';
        });
    </script>
@endpush
