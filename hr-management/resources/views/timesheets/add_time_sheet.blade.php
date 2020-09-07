<div class="modal-body">
    @csrf
    <input name="user_id" value="{{$user->id}}" hidden/>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card-body col-lg-12 float-left">
                <div class="form-group">
                    <label for="name">Họ tên</label>
                    <input id="cmt" type="text" class="form-control @error('txtName') is-invalid @enderror"
                           name="txtName" value="{{$user->last_name}}"  autocomplete="number" required readonly>
                    @error('txtName')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input id="MST" type="text" class="form-control @error('txtEmail') is-invalid @enderror"
                           name="txtEmail" value="{{$user->email}}"  autocomplete="number" readonly>
                    @error('txtEmail')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Thời Gian Bắt Đầu</label>
                    <input id="timeStart" type="time" class="form-control @error('txtTimeStart') is-invalid @enderror" name="txtTimeStart"  autocomplete="number" >
                    @error('txtTimeStart')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Thời Gian Kết Thúc</label>
                    <input id="timeEnd" type="time" class="form-control @error('txtTimeEnd') is-invalid @enderror" name="txtTimeEnd"  autocomplete="number" >
                    @error('txtTimeEnd')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Status</label>
                    <select id="status_timesheet" name = "status_timesheet" class="form-control select2"  value="{{ old('status_timesheet') }}" autocomplete="status_timesheet" style="width: 100%;">
                        <option value="present">Present</option>
                        <option value="absent">Absent</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Comment</label>
                    <input id="address_CMT" type="text" class="form-control @error('txtComment') is-invalid @enderror" name="txtComment"  autocomplete="number" >
                    @error('txtComment')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<script>
</script>
