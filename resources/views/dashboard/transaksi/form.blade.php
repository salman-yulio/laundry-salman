<div class="collapse" id="formTransaksi">
    <div class="card-body">
    {{-- data awal pelanggan --}}
        <div class="card">
            <div class="card-body">
            @csrf
            <div class="row" class="col-12">
                <div class="row col-6 form-group">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Tanggal Transaksi</label>
                    <div class="col-sm-6">
                        <input type="date" class="form-control" id="cash_tgl" required="required" name="tgl">
                    </div>
                </div>
                <div class="row form-group col-6">
                    <label for="inputPassword" class="col-4 col-form-label">Estimasi Selesai</label>
                    <div>
                        <input type="date" class="form-control ml-auto" id="cash_tgl2" value="{{ date('Y-m-d', strtotime(date('Y-m-d') . '+3 day'))}}" name="deadline">
                    </div>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <button type="button" class="btn btn-primary" id="tambahMemberBtn" data-toggle="modal" data-target="#tblMemberModal">
                   Pilih Member
                </button>

                <div class="row" class="col-12">
                    <div class="form-group row col-6">
                        <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                        <label for="" class="col-sm-6 col-form-label" id="nama-pelanggan"
                            style="font-weight:normal">
                            -
                        </label>
                    </div>
                    <div class="form-group row col-6">
                        <label for="biodata" class="col-4 col-form-label">Biodata</label>
                        <label for="" class="col-8 ml-auto col-form-label" id="biodata-pelanggan"
                            style="font-weight:normal">
                            -
                        </label>
                    </div>
                </div>
            </div>
            </div>
        </div>
{{-- end of data awal pelanggan --}}

{{-- data paket --}}
<div class="card">
    <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <div class="col-md-9">
                        <button type="button" class="btn btn-primary" id="tambahPaketBtn" data-toggle="modal" data-target="#tblPaketModal">
                            Tambah Cucian
                        </button>
                    </div>
                </div>
            </div>
            <div class="clearfix">&nbsp;</div>
            <div class="row">
                <table id="tblTransaksi" class="table">
                    <thead>
                        <tr>
                            {{-- <th scope="col">#</th> --}}
                            {{-- <th scope="col">Jenis Paket</th> --}}
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
                    <tfoot>
                        <tr valign="bottom">
                            <td width="" colspan="3" align="right">Jumlah Bayar</td>
                            <td><span id="subtotal">0</span></td>
                            <td rowspan="4">
                                <label for="">Pembayaran</label>
                                <input type="text" class="form-control" name="bayar" id="bayar" style="width:170px" value="0">
                                <div>
                                    <button class="btn btn-primary" style="margin-top:10px;width:170px" type="submit">Bayar</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right">Diskon</td>
                            <td><input type="number" value="0" id="diskon" name="diskon" class="diskon" style="width:140px"></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right">Pajak <input type="number" value="0" min="0" class="qty" name="pajak" id="pajak-persen" size="2" style="width:40px"> %</td>
                            <td><span id="pajak-harga">0</span></td>
                        </tr>
                        <tr style="background:RoyalBlue;color:whitesmoke;font-weight:bold;font-size:1em">
                            <td colspan="3" align="right">Total Bayar Akhir</td>
                            <td><span id="total">0</span></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right">Biaya Tambahan</td>
                            <td><input type="number" name="biaya_tambahan" id="biaya_tambahan" style="width:140px" value="0"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
    </div>
</div>
{{-- end of data paket --}}

{{-- pembayaran --}}
<div class="card">
</div>
{{-- end of pembayaran --}}

{{-- modal member --}}
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
                        <td>{{ $i = (isset($i)?++$i:$i=1) }}
                            <input type="hidden" class="idMember" name="id_member" value="{{ $member->id }}">
                        </td>
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
{{-- end of modal member --}}

{{-- modal paket --}}
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
          <table id="tbl-paket" class="table">
              <thead>
                  <tr>
                    <th scope="col">No</th>
                    {{-- <th scope="col">Outlet</th> --}}
                    {{-- <th scope="col">Jenis Paket</th> --}}
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
                    {{-- <td>{{ $paket->jenis }}</td> --}}
                    <td>{{ $paket->nama_paket }}</td>
                    <td>{{ $paket->harga }}</td>
                    <td><button class="pilih-paket btn btn-info" type="button">Pilih</button></td>
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
{{-- end of modal paket --}}

</div>
</div>
