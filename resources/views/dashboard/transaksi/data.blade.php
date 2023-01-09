<div class="collapse" id="dataLaundry">
    <div class="card-body">

        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Data Transaksi</h3>
                    </div>
                    <div class="table-responsive">
                        <table id="tbl-laporan" class="table align-items-center table-borderless">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Invoice</th>
                                    <th scope="col">Nama Paket</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Pembayaran</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detail_transaksi as $dt)
                                    <tr>
                                        <td>{{ $i = isset($i) ? ++$i : ($i = 1) }}</td>
                                        <td>{{ $dt->transaksi->kode_invoice }}</td>
                                        <td>{{ $dt->paket->nama_paket }}</td>
                                        <td>{{ $dt->transaksi->status }}</td>
                                        <td>{{ $dt->transaksi->status_pembayaran }}</td>
                                        <td>
                                            <button type="submit" class="btn btn-outline-success  border-0"
                                                data-toggle="modal" data-target="#DetailModal{{ $dt->id_transaksi }}">
                                                Detail
                                            </button>
                                            {{-- <button type="submit" class="btn btn-outline-primary  border-0"
                                                data-toggle="modal" data-target="#Faktur{{ $dt->id_transaksi }}">
                                                Faktur
                                            </button> --}}
                                            <a href="{{ route('faktur', $dt->id) }}" target="_blank" class="btn btn-outline-primary  border-0">
                                                Faktur
                                            </a>
                                        </td>
                                    </tr>
                                    @include('dashboard.transaksi.detail')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @push('script')
            <script>
                $(function() {
                    $('#tbl-laporan').DataTable();
                });
            </script>
        @endpush

    </div>
</div>
