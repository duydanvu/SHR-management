@csrf
<div class="modal-body">
    <div id = "url_image_1"></div>
    <input name="user_id" value="{{$user->id}}" hidden/>
    <div class="row">
        <div class="card-body col-lg-12 float-left">
            <span id="uploaded_image"><img id="img_prv_up" src="{{URL::to('/')}}{{$user->url_image}}" style="max-width: 250px;max-height: 300px; width: 200px;height: 250px"></span>
            <div class="form-group col-8 float-right">
                <label class="pl-4" for="name">Upload Ảnh</label>
                <meta name="csrf-token1" content="{{ csrf_token() }}">
                <input class="col-12" id="select_file_update" type="file" name="select_file_update" required="true" class="pb-3">
                <span id="mgs_ta"></span>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        $('#select_file_update').on('change',function(event){
            console.log("da vao day");
            var reader = new FileReader();

            var filedata = this.files[0];
            var imgtype = filedata.type;

            var match = ['image/jpeg','image/jpg','image/png']

            if(!(imgtype == match[0])||(imgtype == match[1])||(imgtype == match[2])){
                $('#mgs_ta').html('<p style = "color:red">Chọn đúng kiểu cho ảnh ... chỉ có jpeg, jpg và png</p>');
            }
            else {
                $('#mgs_ta').empty();
                //preview image
                reader.onload = function (event) {
                    $('#img_prv_up').attr('src', event.target.result).css('width', '200').css('height', '250');
                }
                reader.readAsDataURL(this.files[0]);
                //end preview

                // upload file
                var postData = new FormData();
                postData.append('file',this.files[0]);

                var url = "{{url('file/upload_file')}}";

                $.ajax({
                    headers:{'X-CSRF-Token':$('meta[name="csrf-token1"]').attr('content')},
                    url:url,
                    type:"post",
                    async:true,
                    contentType: false,
                    data: postData,
                    processData: false,
                    success:function(dataresult)
                    {
                        $("#url_image_1").html(dataresult['url']);
                    }
                })

            }

        });

    });
</script>
