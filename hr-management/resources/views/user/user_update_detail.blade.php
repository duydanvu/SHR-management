
<div class="modal-body">
    @csrf
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card-body col-lg-6 float-left">
                <input name="user_id" value="{{$user_detail->id}}" hidden/>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input id="email" type="text" class="form-control @error('txtIdentity') is-invalid @enderror" name="txtEmail" value="{{$user_detail->email}}"  autocomplete="number" required>
                    @error('txtIdentity')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Số CMT</label>
                    <input id="cmt" type="number" class="form-control @error('txtIdentity') is-invalid @enderror" name="txtIdentity" value="{{$user_detail->identity_number}}"  autocomplete="number" required>
                    @error('txtIdentity')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Mã Số Thuế Cá Nhân</label>
                    <input id="MST" type="number" class="form-control @error('txtTIN') is-invalid @enderror" name="txtTIN" value="{{$user_detail->tin}}"  autocomplete="number">
                    @error('txtTIN')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Ngày Cấp CMT</label>
                    <input id="date_CMT" type="date" class="form-control @error('txtIdndate') is-invalid @enderror" name="txtIdndate" value="{{$user_detail->idn_date}}"  autocomplete="number" required>
                    @error('txtIdndate')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Nơi Cấp CMT</label>
                    <input id="address_CMT" type="text" class="form-control @error('txtIdnAdd') is-invalid @enderror" name="txtIdnAdd" value="{{$user_detail->idn_address}}"  autocomplete="number" required>
                    @error('txtIdnAdd')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Chỗ ở hiện tại</label>
                    <input id="txtAddr_Now" type="text" class="form-control @error('txtAddr_Now') is-invalid @enderror" name="txtAddr_Now" value="{{$user_detail->address_now}}"  autocomplete="number" required>
                    @error('txtAddr_Now')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
            </div>
            <div class="card-body col-lg-6 float-left">
                <div class="form-group">
                    <label for="name">Số Điện Thoại</label>
                    <input id="phone" type="number" class="form-control @error('txtIdentity') is-invalid @enderror" name="txtPhone" value="{{$user_detail->phone}}"  autocomplete="number" required>
                    @error('txtIdentity')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Số Bảo Hiểm Xã Hội</label>
                    <input id="txtSSC" type="number" class="form-control @error('txtNssc') is-invalid @enderror" name="txtNssc" value="{{$user_detail->ssc_number}}"  autocomplete="number" >
                    @error('txtNssc')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Nơi Đăng ký Khám chữa bệnh</label>
                    <input id="txtHospital" type="text" class="form-control @error('txtHospital') is-invalid @enderror" name="txtHospital" value="{{$user_detail->hospital}}"  autocomplete="number" >
                    @error('txtHospital')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Số Tài Khoản Ngân Hàng</label>
                    <input id="txtBan" type="number" class="form-control @error('txtBan') is-invalid @enderror" name="txtBan" value="{{$user_detail->ban}}"  autocomplete="number" >
                    @error('txtBan')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Tên Ngân Hàng</label>
                    <input id="txtBank" type="text" class="form-control @error('txtBank') is-invalid @enderror" name="txtBank" value="{{$user_detail->bank}}"  autocomplete="number" >
                    @error('txtBank')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Nơi đăng ký Hộ Khẩu</label>
                    <input id="txtAdd_Noi" type="text" class="form-control @error('txtAdd_Noi') is-invalid @enderror" name="txtAdd_Noi" value="{{$user_detail->noi_address}}"  autocomplete="number" >
                    @error('txtAdd_Noi')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

