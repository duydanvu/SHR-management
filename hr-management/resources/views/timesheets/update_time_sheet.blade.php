<div class="modal-body">
    @csrf
    @foreach($user_timesheet as $user_timesheet)
    <input name="user_id" value="{{$user_timesheet->id}}" hidden/>
    <input name="user_id_logtime" value="{{$user_timesheet->user_id}}" hidden/>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card-body col-lg-12 float-left">
                <div class="form-group">
                    <label for="name">Ngày</label>
                    <input id="date_ts" type="date" class="form-control @error('date_ts') is-invalid @enderror" value="{{$user_timesheet->date}}" name="date_ts"  autocomplete="number" required readonly>
                    @error('txtComment')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Chấm Công</label>
                    <select id="status_timesheet" name = "status_timesheet" class="form-control select2"  value="{{ old('status_timesheet') }}" autocomplete="status_timesheet" style="width: 100%;">
                        <option value="present" @if($user_timesheet->logtime == 'present') selected @endif>Đi Làm</option>
                        <option value="absent" @if($user_timesheet->logtime == 'absent') selected @endif>Nghỉ Có Phép</option>
                        <option value="absent1" @if($user_timesheet->logtime == 'absent1') selected @endif>Nghỉ Không Phép</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Thời Gian Bắt Đầu</label>
                    <input id="timeStart" type="time" class="form-control @error('txtTimeStart') is-invalid @enderror" name="txtTimeStart" value="{{$user_timesheet->start_time}}" autocomplete="number" >
                    @error('txtTimeStart')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Thời Gian Kết Thúc</label>
                    <input id="timeEnd" type="time" class="form-control @error('txtTimeEnd') is-invalid @enderror" name="txtTimeEnd" value="{{$user_timesheet->end_time}}" autocomplete="number" >
                    @error('txtTimeEnd')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Comment</label>
                    <input id="address_CMT" type="text" class="form-control @error('txtComment') is-invalid @enderror" value="{{$user_timesheet->comment}}" name="txtComment"  autocomplete="number">
                    @error('txtComment')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>
</script>

