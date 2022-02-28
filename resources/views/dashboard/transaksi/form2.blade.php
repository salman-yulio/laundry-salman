<div class="collapse" id="formTransaksi">
    <div class="card-body">
    {{-- data awal pelanggan --}}
        <div class="card">
        <div class="card-body">
        <form>
    @csrf
    <div class="row" class="col-12">
        <div class="row col-6 form-group">
            <label for="staticEmail" class="col-sm-4 col-form-label">Tanggal Transaksi</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" id="cash_tgl" required="required" name="tgl_masuk">
            </div>
        </div>
        <div class="row form-group col-6">
            <label for="inputPassword" class="col-4 col-form-label">Estimasi Selesai</label>
            <div>
                <input type="date" class="form-control ml-auto" id="cash_tgl2" value="{{ date('Y-m-d', strtotime(date('Y-m-d') . '+3 day'))}}">
            </div>
        </div>
    </div>
    <div class="row" class="col-12">
        <div class="col-md-6 form-group">
            <label for="" class="col-md-4 col-form-label">Outlet</label>
            <div class="col-md-8">
                <select class="form-control" required="required" name="outlet_id">
                    <option value="{{ Auth::user()->outlet_id }}">{{ Auth::user()->outlet->nama }}</option>
                </select>
            </div>
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

    <div class="col-md-6 form-group">
        <div class="col-md-9">
            <button type="button" class="btn btn-primary" id="tambahPaketBtn" data-toggle="modal" data-target="#tblPaketModal">
                Tambah Paket
                </button>
        </div>
    </div>
</div>
{{-- end of data awal pelanggan --}}

{{-- tabel sementara --}}
<div>
    <h3>Paket</h3>
    <table id="tblTransaksi" class="table">
        <thead>
            <tr>
                {{-- <th scope="col">#</th> --}}
                <th scope="col">Jenis Paket</th>
                <th scope="col">Nama Paket</th>
                <th scope="col">Harga</th>
                <th scope="col">Qty</th>
                <th scope="col">Total</th>
                <th scope="col">Action</th>
              </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6" style="text-align: center"><i>Belum ada data</i></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-md-6 form-group">
        <label for="" class="col-md-4 col-form-label">Total Harga</label>
        <div class="col-md-8">
            <input type="text" class="form-control" required="required" id="totalHarga" name="total">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 form-group">
        <div class="col-md-12">
            <button type="submit" class="btn btn-success">Simpan Transaksi</button>
        </div>
    </div>
</div>

<div class="modal fade" id="tblPaketModal" tabindex="-1" role="dialog" aria-labelledby="tblPaketModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tblPaketModalLabel">Tambah Paket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table id="tblPaket2" class="table">
              <thead>
                  <tr>
                    <th scope="col">No</th>
                    {{-- <th scope="col">Outlet</th> --}}
                    <th scope="col">Jenis Paket</th>
                    <th scope="col">Nama Paket</th>
                    <th scope="col">Harga Paket</th>
                    <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($paket as $paket)
                  <tr>
                    <td>{{ $i = (isset($i)?++$i:$i=1) }}
                        <input type="hidden" class="idPaket" name="idPaket" value="{{ $paket->id }}">
                    </td>
                    {{-- <td>{{ $paket->outlet->nama }}</td> --}}
                    <td>{{ $paket->jenis }}</td>
                    <td>{{ $paket->nama_paket }}</td>
                    <td>{{ $paket->harga }}</td>
                    <td><button class="pilihPaket btn btn-info" type="button">Pilih</button></td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="tblMemberModal" tabindex="-1" role="dialog" aria-labelledby="tblMemberModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tblMemberModal">Plih Member</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table id="tbl-member" class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. Hp</th>
                        <th>Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($member as $member)
                    <tr>
                        <td>{{ $i = (isset($i)?++$i:$i=1) }}</td>
                        <td>{{ $member->nama }}</td>
                        <td>{{ $member->alamat }}</td>
                        <td>{{ $member->telepon }}</td>
                        <td><button class="pilih-member btn btn-info" type="button">Pilih</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>

</div>
</div>
{{-- end of tabel sementara --}}


