<div class="modal-body">
    @csrf
    <input name="user_id" value="{{$time_request->id}}" hidden/>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card-body col-lg-12 float-left">
                <div class="form-group">
                    <label for="name">Date</label>
                    <input id="date_ts" type="text" class="form-control @error('date_ts') is-invalid @enderror" value="{{$time_request->date}}" name="date_ts"  autocomplete="number" required readonly>
                </div>
                <div class="form-group">
                    <label for="name">Time sheet</label>
                    <input id="address_CMT" type="text" class="form-control @error('txtComment')  is-invalid @enderror" value="{{$time_request->logtime}}" name="txtComment"  autocomplete="number" required readonly>
                </div>
                <div class="form-group">
                    <label for="name">Request</label>
                    <input id="txtRequest" type="text" class="form-control @error('txtRequest') is-invalid @enderror"  name="txtRequest"  autocomplete="number" required>
                    @error('txtComment')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Reason</label>
                    <input id="txtComment" type="text" class="form-control @error('txtComment') is-invalid @enderror" name="txtComment"  autocomplete="number" required>
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


