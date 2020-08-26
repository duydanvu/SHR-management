<div class="modal-body">
    @csrf
    <input name="user_id" value="{{$user_timesheet->id}}" hidden/>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card-body col-lg-12 float-left">
                <div class="form-group">
                    <label for="name">Date</label>
                    <input id="date_ts" type="text" class="form-control @error('date_ts') is-invalid @enderror" value="{{$user_timesheet->date}}" name="date_ts"  autocomplete="number" required readonly>
                    @error('txtComment')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Status</label>
                    <select id="status_timesheet" name = "status_timesheet" class="form-control select2"  value="{{ old('status_timesheet') }}" autocomplete="status_timesheet" style="width: 100%;">
                        <option value="">Pendding</option>
                        <option value="present">Present</option>
                        <option value="absent">Absent</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Comment</label>
                    <input id="address_CMT" type="text" class="form-control @error('txtComment') is-invalid @enderror" name="txtComment"  autocomplete="number" required>
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

