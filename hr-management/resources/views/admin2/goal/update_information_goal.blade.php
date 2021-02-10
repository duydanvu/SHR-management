@csrf
<div class="row">
    <div id = "url_image1"><input name="id_goal" value="{{$goal_product->id}}" hidden></div>
    <div class="col-lg-12 col-sm-12">
        <div class="form-group">
            <label for="name">Tên Chương Trình</label>
            <input id="name" type="text" class="form-control @error('txtName') is-invalid
             @enderror" name="txtName" value="{{$goal_product->name}}"  autocomplete="number" required>
            @error('txtName')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Loại mục tiêu</label>
            <div class="form-check">
                <input id="sanluong" type="radio" class="form-check-input" name="txtType" value="sanluong"
                       @if($goal_product->type == "sanluong") checked @endif autocomplete="number" required>
                <label class="form-check-label " for="sanluong">
                    Theo Sản Lượng
                </label>
                <input id="doanhthu" type="radio" class="form-check-input ml-4" name="txtType" value="doanhthu"
                       @if($goal_product->type == "doanhthu") checked @endif autocomplete="number" required>
                <label class="form-check-label ml-5 " for="doanhthu">
                    Theo Doanh Thu
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="name">Mục Tiêu</label>
            <input id="goal" type="text" class="form-control @error('txtGoal') is-invalid
              @enderror" name="txtGoal" @if($goal_product->type == "sanluong") value="{{$goal_product->sl}}"
                   @elseif($goal_product->type == "doanhthu") value="{{$goal_product->dt}}"  @endif
                   autocomplete="number" required>
            @error('txtGoal')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Thời Gian Bắt Đầu</label>
            <input id="start" type="date" class="form-control @error('txtGoal') is-invalid
                                                      @enderror" name="txtStart" value="{{$goal_product->start_time}}"  autocomplete="number" required>
            @error('txtGoal')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Thời Gian Kết Thúc</label>
            <input id="end" type="date" class="form-control @error('txtGoal') is-invalid
                                                      @enderror" name="txtEnd" value="{{$goal_product->end_time}}"  autocomplete="number" required>
            @error('txtGoal')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>

    </div>
</div>
