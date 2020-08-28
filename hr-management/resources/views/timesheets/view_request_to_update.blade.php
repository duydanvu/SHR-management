<div class="modal-body">
    @csrf
    <input name="timesheet_id" value="{{$time_request->id}}" hidden/>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card-body col-lg-12 float-left">
                <div class="form-group">
                    <label for="name">Họ tên</label>
                    <input id="cmt" type="text" class="form-control @error('txtName') is-invalid @enderror"
                           name="txtName" value="{{$user_infor->first_name}}{{$user_infor->last_name}}"  autocomplete="number" required readonly>
                    @error('txtName')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input id="MST" type="text" class="form-control @error('txtEmail') is-invalid @enderror"
                           name="txtEmail" value="{{$user_infor->email}}"  autocomplete="number" readonly>
                    @error('txtEmail')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Ngày</label>
                    <input id="date_CMT" type="date" class="form-control @error('txtdate') is-invalid @enderror"
                           name="txtdate" value="{{$time_request->date}}"  autocomplete="number" required readonly>
                    @error('txtdate')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Timesheet</label>
                    <select id="status_timesheet" name = "status_timesheet" class="form-control select2"  value="{{ old('status_timesheet') }}" autocomplete="status_timesheet" style="width: 100%;">
                        <option value="present" @if($time_request->logtime == 'present') selected @endif>Present</option>
                        <option value="absent" @if($time_request->logtime == 'absent') selected @endif>Absent</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Reason</label>
                    <input id="txtReason" type="text" class="form-control @error('txtComment') is-invalid @enderror"
                           name="txtReason" value="{{$time_request->reason_request}}" autocomplete="number" readonly>
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

