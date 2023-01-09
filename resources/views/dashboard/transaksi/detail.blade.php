<div class="row">
    <div class="col-md-6">
        <div class="card">
            <!-- Info header modal -->
            <div class="modal fade" id="DetailModal{{ $dt->id_transaksi }}" tabindex="-1"
                aria-labelledby="info-header-modalLabel" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title text-center" id="info-header-modalLabel">Detail Transaksi</h3>
                            <button type="button" class="btn-close" data-dismiss="modal"
                                aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="nav nav-tabs nav-justified nav-bordered mb-3">
                                <li class="nav-item">
                                    <a href="#transaksi" data-toggle="tab" aria-expanded="false" class="nav-link active"
                                        id="nav-data">
                                        <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">Data Transaksi</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#paket" data-toggle="tab" aria-expanded="true" class="nav-link"
                                        id="nav-form">
                                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">Paket</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#member" data-toggle="tab" aria-expanded="true" class="nav-link"
                                        id="nav-form">
                                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">Member</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="transaksi">
                                    <ul class="list-group">
                                        <li class="list-group-item font-weight-bold"><u>Keterangan</u></li>
                                        <li class="list-group-item">Status transaksi : {{ $dt->transaksi->status }}
                                        </li>
                                        <li class="list-group-item">Status pembayaran :
                                            {{ $dt->transaksi->status_pembayaran }}</li>
                                        <li class="list-group-item">Tanggal masuk : {{ $dt->transaksi->tgl }}</li>
                                        <li class="list-group-item">Estimasi : {{ $dt->transaksi->deadline }}</li>
                                        <li class="list-group-item">Nama member : {{ $dt->transaksi->member->nama }}
                                        </li>
                                        <li class="list-group-item">Nama paket : {{ $dt->paket->nama_paket }}</li>
                                        <li class="list-group-item">Harga paket : {{ $dt->paket->harga }}</li>
                                        <li class="list-group-item">Jumlah paket : {{ $dt->qty }}</li>
                                        <li class="list-group-item">Total awal : {{ $dt->transaksi->subtotal }}</li>
                                        <li class="list-group-item">Diskon : {{ $dt->transaksi->diskon }}</li>
                                        <li class="list-group-item">Pajak : {{ $dt->transaksi->pajak }}%</li>
                                        <li class="list-group-item">Biaya tambahan :
                                            {{ $dt->transaksi->biaya_tambahan }}</li>
                                        <li class="list-group-item font-weight-bold">Total akhir :
                                            {{ $dt->transaksi->total }}</li>
                                        <li class="list-group-item ">
                                            <h1 class="text-success text-center">
                                                <b><u>{{ $dt->transaksi->kode_invoice }}</u></b>
                                        </li>
                                        </h1>
                                    </ul>
                                </div>
                                <div class="tab-pane" id="paket">
                                    <ul class="list-group">
                                        <li class="list-group-item">Nama paket : {{ $dt->paket->nama_paket }}</li>
                                        <li class="list-group-item">Harga paket : {{ $dt->paket->harga }}</li>
                                        <li class="list-group-item">Jumlah paket : {{ $dt->qty }}</li>
                                        <li class="list-group-item">Jenis paket : {{ $dt->paket->jenis }}</li>
                                        <li class="list-group-item">Outlet : {{ $dt->paket->outlet->nama }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane" id="member">
                                    <ul class="list-group">
                                        <li class="list-group-item">Nama : {{ $dt->transaksi->member->nama }}</li>
                                        <li class="list-group-item">Alamat : {{ $dt->transaksi->member->alamat }}
                                        </li>
                                        <li class="list-group-item">Jenis Kelamin :
                                            {{ $dt->transaksi->member->jenis_kelamin }}</li>
                                        <li class="list-group-item">Telepon : {{ $dt->transaksi->member->telepon }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
