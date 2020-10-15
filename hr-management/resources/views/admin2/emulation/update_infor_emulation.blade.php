@csrf
@foreach($emula as $emula)
<div class="row">
    <div id = "url_image1"><input name="id_emulation_pdu" value="{{$emula['id']}}" hidden></div>
    <div id = "url_image1"><input name="id_emulation" value="{{$emula['id_emulation']}}" hidden></div>
    <div class="col-lg-6 col-sm-6">
        <div class="form-group">
            <label for="name">Tên Chương Trình</label>
            <input id="name" type="text" class="form-control @error('txtName') is-invalid
                                                      @enderror" name="txtName" value="{{$emula['name']}}"  autocomplete="number" required>
            @error('txtName')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Quyết định tham chiếu</label>
            <input id="qdtc" type="text" class="form-control @error('txtQdtc') is-invalid
                                                      @enderror" name="txtQdtc" value="{{$emula['qdtc']}}"  autocomplete="number" required>
            @error('txtQdtc')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name"> Sản Lượng Yêu Cầu</label>
            <input id="sl_min" type="number" class="form-control @error('txtSl_min') is-invalid
                    @enderror" name="txtSl_min" value="{{$emula['total']}}"  autocomplete="number" required>
            @error('txtSl_min')
            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name"> Doanh Số Yêu Cầu</label>
            <input id="ds_min" type="number" class="form-control @error('txtDs_min') is-invalid
                                                          @enderror" name="txtDs_min" value="{{$emula['revenue']}}"  autocomplete="number" required>
            @error('txtDs_min')
            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
            @enderror
        </div>
        <div class="form-group">
            <meta name="csrf-token2" content="{{ csrf_token() }}">
            <label for="exampleInputEmail1">Giải Thưởng</label>
            <select id="reward" name = "txtReward[]" class="form-control select2" multiple  value="{{ old('txtReward') }}" autocomplete="txtReward" style="width: 100%;">
                @foreach ($gift as $reward)
                    <option value="{{$reward->id}}">
                        {{$reward->name}}-{{$reward->values}}
                        -SL:{{$reward->sl_min}}-DS:{{$reward->ds_min}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Thời Gian Áp Dụng</label>
            <input id="time" type="date" class="form-control  @error('txtTime') is-invalid
            @enderror" name="txtTime" value="{{$emula['time']}}"  autocomplete="number" required>
            @error('txtTime')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6 col-sm-6">
        <div class="form-group">
            <label for="name">Chi tiết Chương trình</label>
            <textarea name="editor1" id="editor1" rows="10" cols="60" >
            {{$emula['content']}}
            </textarea>
        </div>
    </div>
</div>
@endforeach

<script src="{{asset("../ckeditor/ckeditor.js")}}"></script>
<script>
    CKEDITOR.replace( 'editor1' );
</script>
