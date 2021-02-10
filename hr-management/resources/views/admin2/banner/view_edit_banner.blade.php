@csrf
<div class="row">
    <div class="col-md-10 float-left">
        <form>
            <div class="modal-body col-md-12">
                <div class="row">
                    <div class="card-body col-lg-12 float-left">
                        <span id="uploaded_image"><img id="img_prv1" src="{{URL::to('/')}}{{$banner->image}}" style="max-width: 150px;max-height: 200px; width: 150px;height: 200px"></span>
                        <div class="form-group col-6 float-right">
                            <label for="name">Tải Ảnh Banner</label>
                            <form id="upload_form" enctype="multipart/form-data" method="post">
                                <meta name="csrf-token1" content="{{ csrf_token() }}">
                                <input id="select_file" type="file" name="select_file" required="true" class="pb-3">
                            </form>
                            <span id="mgs_ta"></span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-12 col-sm-12">
        <input name="id_banner" value="{{$banner->id}}" hidden>
        <div class="form-group">
            <div id = "url_image1"></div>
            <label for="name">Tên Banner</label>
            <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName" value="{{$banner->title}}"  autocomplete="number" required>
            @error('txtName')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Nội Dung</label>
            <input id="content" type="text" class="form-control @error('txtContent') is-invalid @enderror" name="txtContent" value="{{$banner->content}}"  autocomplete="number" required>
            @error('txtContent')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Đường Dẫn</label>
            <input id="link" type="text" class="form-control @error('txtLink') is-invalid @enderror" name="txtLink" value="{{$banner->link}}"  autocomplete="number" required>
            @error('txtLink')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        $('#select_file').on('change',function(event){
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
                    $('#img_prv1').attr('src', event.target.result).css('width', '150').css('height', '200');
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
                        console.log(dataresult);
                        $("#url_image1").html(dataresult['url']);
                    }
                })

            }

        });

    });
</script>

