@csrf
@foreach($emula as $emula)
<div class="row">
    <div id = "url_image1"><input name="id_emulation_pdu" value="{{$emula['id']}}" hidden></div>
    <div id = "url_image1"><input name="id_emulation" value="{{$emula['id_emulation']}}" hidden></div>
    <div class="col-lg-12 col-sm-12">
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
            <label for="name">Hình Thức Thi Đua</label>
            <div class="form-check">
                <input id="sanluong" type="radio" class="form-check-input" name="txtType" value="sanluong"
                       @if($emula['type'] == 'sanluong') checked @endif autocomplete="number" required>
                <label class="form-check-label " for="sanluong" >
                    Sản Lượng
                </label>
                <input id="doanhso" type="radio" class="form-check-input ml-4" name="txtType" value="doanhso"
                       @if($emula['type'] == 'doanhso') checked @endif autocomplete="number" required>
                <label class="form-check-label ml-5 " for="doanhso">
                    Doanh Số
                </label>
            </div>
        </div>
        <div class="form-group">
            <meta name="csrf-token2" content="{{ csrf_token() }}">
            <label for="exampleInputEmail1">Giải Thưởng</label>
            <select id="reward" name = "txtReward" class="form-control select2"  value="{{ old('txtReward') }}" autocomplete="txtReward" style="width: 100%;">
                @foreach ($gift as $reward)
                    <option value="{{$reward->id}}" @if($emula['id_reward'] == $reward->id) selected @endif >
                        {{$reward->name}}-{{$reward->values}}
                        -SL:{{$reward->sl_min}}-DS:{{$reward->ds_min}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
@endforeach
