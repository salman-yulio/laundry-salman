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
                  <h2>Tabel Barang Inventaris</h2>
                  <ul class="nav navbar-right panel_toolbox">
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  @if (session()->has('success'))
                  <div class="alert alert-success text-center" role="alert" id="success-alert">
                      {{ session('success') }}
                      <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" >&times;</span>
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

                        @include('dashboard.inventaris.create')

                            <div>
                                <table id="tb-inventaris" class="table table-striped table-md">
                                    <thead>
                                      <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Merk Barang</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Kondisi</th>
                                        <th scope="col">Tgl Pengadaan</th>
                                        <th scope="col">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($barang_inventaris as $barang_inventaris)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $barang_inventaris->nama_barang }}</td>
                                            <td>{{ $barang_inventaris->merk_barang }}</td>
                                            <td>{{ $barang_inventaris->qty }}</td>
                                            <td>{{ $barang_inventaris->kondisi }}</td>
                                            <td>{{ $barang_inventaris->tanggal_pengadaan }}</td>
                                            <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#staticBackdrop{{ $barang_inventaris->id }}">
                                                Edit
                                            </button>

                                            @include('dashboard.inventaris.edit')

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
        $(function(){
        //Data Table
            $('#tb-inventaris').DataTable();

        // Alert
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("success-alert").slideUp(500);
        });
        $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("error-alert").slideUp(500);
        });

        // Delete Alert
        $('.delete-inventaris').click(function(e){
            e.preventDefault()
            let data = $(this).closest('tr').find('td:eq(1)').text()
            swal({
                title: "Apakah Kamu Yakin?",
                text: "Yakin Ingin Menghapus Data yang anda pilih?",
                icon: "warning",
                buttons:true,
                dangerMode: true,
            })
            .then((req) => {
                if(req) $(e.target).closest('form').submit()
                else swal.close()
            })
        })
        });
    </script>

      @endpush

@endsection

