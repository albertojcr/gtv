<div class="modal fade" id="createVideos" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="videos" aria-hidden="true">
    <form action="{{ route('admin.videos.store', '#video') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videos">Crear video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group has-label">
                        <label for="name">Nombre del vídeo:</label>
                        <input type="text" name="name" id="videos-name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                               placeholder="Escribe el nombre del vídeo" value="{{ old('name') }}" required>
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
        if (window.location.hash === '#video') {
            $('#createVideos').modal('show');
        }
        $('#createVideos').on('hide.bs.modal', function () {
            window.location.hash = '#';
        });
        $('#createVideos').on('shown.bs.modal', function () {
            $('#videos-name').focus();
            window.location.hash = '#video';
        });
    </script>
@endpush
