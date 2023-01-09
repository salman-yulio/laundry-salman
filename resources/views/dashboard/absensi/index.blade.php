@extends('layouts.main')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Master Data</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Absensi Kerja Karyawan</h2>
                            <ul class="nav navbar-right panel_toolbox">
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            @if (session()->has('success'))
                                <div class="alert alert-success text-center" role="alert" id="success-alert">
                                    {{ session('success') }}
                                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger text-center" role="alert" id="error-alert">
                                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Tambah Data
                            </button>

                            <a href="{{ route('export-absensi') }}" class="btn btn-success mb-2">
                                <i class="ni ni-bold-right"></i> Export
                            </a>

                            {{-- button modal --}}
                            <button type="button" class="btn btn-warning mb-2 " data-toggle="modal"
                                data-target="#importModal"><i class="ni ni-bold-left"></i> Import</button>

                            <!-- Modal -->
                            <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="importModalLabel">Import Data absensi</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('import-absensi') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input type="file" name="file2" class="form-control border"
                                                                placeholder="Pilih file excel(.xlsx)">
                                                        </div>
                                                        @error('file2')
                                                            <div class="'alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-warning" id="submit">
                                                            Import</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal -->

                            @include('dashboard.absensi.create')
                            <div>
                                <table id="tb-absensi" class="table table-striped table-md">
                                    <thead>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Karyawan</th>
                                        <th scope="col">Tanggal Masuk</th>
                                        <th scope="col">Waktu Masuk</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Waktu Selesai Kerja</th>
                                        <th scope="col">Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($absensi as $a)
                                            <tr>
                                                <td>{{ $loop->iteration }} <input type="text" hidden
                                                        class="id" value="{{ $a->id }}"></td>
                                                <td>{{ $a->nama }}</td>
                                                <td>{{ $a->tanggal_masuk }}</td>
                                                <td>{{ $a->waktu_masuk }}</td>
                                                <div class="col-12">
                                                    <td class="col-2"> <select name="status"
                                                            class="status form-control">
                                                            <option value="masuk"
                                                                {{ $a->status == 'masuk' ? 'selected' : '' }}>
                                                                Masuk</option>
                                                            <option value="sakit"
                                                                {{ $a->status == 'sakit' ? 'selected' : '' }}>
                                                                Sakit</option>
                                                            <option value="cuti"
                                                                {{ $a->status == 'cuti' ? 'selected' : '' }}>
                                                                Cuti</option>
                                                        </select>
                                                    </td>
                                                </div>
                                                <td>
                                                    {{-- {{ date_default_timezone_set('Asia/Jakarta') }} --}}
                                                    {{ $a->waktu_selesai }}</td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#staticBackdrop{{ $a->id }}">
                                                        Edit
                                                    </button>
                                                    @include('dashboard.absensi.edit')
                                                    <form
                                                        action="/{{ request()->segment(1) }}/absensi/{{ $a->id }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button
                                                            class="btn btn-danger delete-absensi border-0">Delete</button>
                                                        &nbsp;
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- /page content -->

    @push('script')
        <script>
            $(function() {
                //Data Tables
                $('#tb-absensi').DataTable();

                // Alert
                $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                    $("success-alert").slideUp(500);
                });
                $("#error-alert").fadeTo(2000, 500).slideUp(500, function() {
                    $("error-alert").slideUp(500);
                });

                $('#tb-absensi').on('change', '.status', function() {
                    let status = $(this).closest('tr').find('.status').val()
                    let id = $(this).closest('tr').find('.id').val()
                    let data = {
                        id: id,
                        status: status,
                        _token: "{{ csrf_token() }}"
                    };
                    let row = $(this).closest('tr')
                    $.post('{{ route('status') }}', data, function(res) {
                        swal("Sukses", "Data Berhasil Diubah", "success", {
                            buttons: false,
                            timer: 1000,
                        })
                        row.find('td:eq(5)').html(res.waktu_selesai)
                    })
                    console.log(id);
                    console.log(status);
                })

                // Delete Alert
                $('.delete-absensi').click(function(e) {
                    e.preventDefault()
                    let data = $(this).closest('tr').find('td:eq(1)').text()
                    swal({
                            title: "Apakah Kamu Yakin?",
                            text: "Yakin Ingin Menghapus Data yang anda pilih?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((req) => {
                            if (req) $(e.target).closest('form').submit()
                            else swal.close()
                        })
                })

                // $('.status').change(function(e) {
                //     e.preventDefault()
                //     let data = $(this).closest('tr').find('td:eq(1)').text()
                //     swal({
                //             title: "Status Berhasil Diubah",
                //             icon: "warning",
                //         })
                //         .then((req) => {
                //             if (req) $(e.target).closest('form').submit()
                //             else swal.close()
                //         })
                // })
            });
        </script>
    @endpush

@endsection
