
<div class="modal " id="editPhoto" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">

        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>


                </div>
                <div class="modal-body">
                    <img id="photo-img" class="demo-cropper cr-original-image"
                         src="{{ $user->profile ? Storage::url($user->profile) : '/admin/img/default-avatar.png' }}">
                    <input type="file" name="upload_image" id="upload_image" />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="cropImageBtn" class="btn btn-primary">Recortar foto</button>
                </div>
            </div>
        </div>

</div>
@push('scripts')
    <script>
        $(function () {
             $basic = $('#photo-img').croppie({
                destroy:true,
                viewport: {
                    width: 200,
                    height: 200 ,
                    type:'circle' //circle
                },
                boundary:{
                  width:400,
                  height:400
                },
                enableExif:true,
                enforceBoundary:true,
            });
            $('#upload_image').on('change', function(){
                      var reader = new FileReader();
                      reader.onload = function (event) {
                          $basic.croppie('bind', {
                          url: event.target.result
                        }).then(function(){
                          console.log('jQuery bind complete');
                        });
                      }
                      reader.readAsDataURL(this.files[0]);
                      $('#uploadimageModal').modal('show');
                    });

        });
        $('#cropImageBtn').click(function(event){
            $basic.croppie('result', {
            type: 'canvas',
            size: 'viewport'
          }).then(function(response){
            $.ajax({
              url:"/admin/users/photo/update",
                dataType: "json",
                type: "POST",
                headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
              data:{'profile':response,'user':  "{{$idEncript}}" },
              success:function(data) {
                  window.location.hash = '#';
                  location.reload();
                console.log(Object.values(data));
              },
                error:function (jqXHR, textStatus, errorThrown,XMLHttpRequest) {

                }
            }).fail(function (jqXHR, textStatus, errorThrown) {

                console.log(errorThrown);
            });
          })
        });

        if (window.location.hash === '#photo') {

            $('#editPhoto').modal('show');

        }
        $('#editPhoto').on('hide.bs.modal', function () {
            window.location.hash = '#';


        });
        $('#editPhoto').on('shown.bs.modal', function () {

            window.location.hash = '#photo';
            location.reload();
        });
    </script>

@endpush



