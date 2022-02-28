<div class="collapse" id="formLaundry">
    <div class="card-body">
    {{-- data awal pelanggan --}}
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="row" class="col-12">
                        <div class="row col-6 form-group">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Tanggal Transaksi</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control" id="cash_tgl" required="required" name="tgl_masuk">
                            </div>
                        </div>
                    <div class="form-group col-6">
                        <label for="inputPassword" class="col-4 col-form-label">Estimasi Selesai</label>
                        <div>
                            <input type="date" class="form-control ml-auto" id="cash_tgl2" value="{{ date('Y-m-d', strtotime(date('Y-m-d') . '+3 day'))}}">
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <button type="button" class="btn btn-primary" id="tambahMemberBtn" data-toggle="modal" data-target="#tblMemberModal">
                           Pilih Member
                        </button>

                        <div class="data-member">

                            <div class=" col-lg-12 mt-3 mb-3">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" readonly id="v-nama" name="nama">
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" readonly  id="v-alamat" name="alamat">
                                </div>
                                <div class="mb-3">
                                    <label for="telepon" class="form-label">Telepon</label>
                                    <input type="text" class="form-control" readonly id="v-telepon" name="telepon">
                                </div>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    {{-- end of data awal pelanggan --}}

    {{-- data paket --}}
        <div class="card">
        </div>
    {{-- end of data paket --}}

    {{-- pembayaran --}}
        <div class="card">
        </div>
    {{-- end of pembayaran --}}

      </div>
</div>

