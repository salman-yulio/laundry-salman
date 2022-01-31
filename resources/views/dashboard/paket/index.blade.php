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
                  <h2>Tabel paket</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    @if (session()->has('success'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger text-center" role="alert">
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

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-dark">
                            <h5 class="modal-title" id="exampleModalLabel">Input New Data</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                    
                            <form action="/dashboard/paket" method="POST" class="mb-5 text-dark" enctype="multipart/form-data" style>
                            @csrf    
                            <div class="mb-3">
                                    <label for="id_outlet" class="form-label">Outlet</label>
                                      <select class="form-select form-select mb-3" aria-label=".form-select example" id="outlet" name="id_outlet">
                                          <option selected>Pilih Outlet</option>
                                          @foreach ($outlet as $o )
                                          <option value="{{ $o->id }}">{{ $o->nama }}</option>
                                          @endforeach
                                        </select>
                                    @error('outlet')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                  </div>
                                  <div class="mb-3">
                                    <label for="jenis" class="form-label">Jenis </label>
                                    <select class="form-select form-select mb-3" aria-label=".form-select example" id="jenis" name="jenis" required autofocus value="{{ old('jenis') }}">
                                      <option selected>Pilih Jenis Paket</option>
                                      <option name="jenis" value="kiloan">Kiloan</option>
                                      <option name="jenis" value="selimut">Selimut</option>
                                      <option name="jenis" value="bed_cover">Bed Cover</option>
                                      <option name="jenis" value="kaos">Kaos</option>
                                      <option name="jenis" value="lainnya">lainnya</option>
                                    </select>
                                    @error('jenis')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                  </div>
                                  <div class="mb-3">
                                    <label for="nama_paket" class="form-label">Nama Paket</label>
                                    <input type="text" class="form-control @error('nama_paket') is-invalid @enderror" id="nama_paket" name="nama_paket" required autofocus value="{{ old('nama_paket') }}">
                                    @error('nama_paket')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                  </div>
                                  <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" required autofocus value="{{ old('harga') }}">
                                    @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                  </div>

                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary">Create Post</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                        </div>
                        </div>
                        </div>

                            <div>
                                <table id="tb-paket" class="table table-striped table-md">
                                    <thead>
                                        <th scope="col">No</th>
                                        <th scope="col">Outlet</th>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Nama Paket</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($paket as $p)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $p->id_outlet }}</td>
                                            <td>{{ $p->jenis }}</td>
                                            <td>{{ $p->nama_paket }}</td>
                                            <td>{{ $p->harga }}</td>
                                            <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#staticBackdrop{{ $p->id }}">
                                                Edit
                                            </button>

                                              <!-- Modal -->
                                              <div class="modal fade" id="staticBackdrop{{ $p->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header text-dark">
                                                      <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="{{ url('dashboard/paket/'.$p->id) }}" method="POST" class="mb-5" enctype="multipart/form-data">
                                              @method('PUT')
                                              @csrf
                                              <div class="mb-3">
                                                <label for="id_outlet" class="form-label">Outlet</label>
                                                  <select class="form-select form-select mb-3" aria-label=".form-select example" id="id_outlet" name="id_outlet">
                                                      <option selected>Pilih Outlet</option>
                                                        @foreach ($outlet as $o )
                                                            @if (old('id_outlet') == $o->id)
                                                            <option value="{{ $o->id }}" selected>{{ $o->nama_outlet }}</option>
                                                            @else
                                                            <option value="{{ $o->id }}">{{ $o->nama_outlet }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                @error('nama')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                              </div>
                                              <div class="mb-3">
                                                <label for="jenis" class="form-label">Jenis</label>
                                                <select class="form-select form-select mb-3" aria-label=".form-select example" id="jenis" name="jenis" required autofocus value="{{ old('jenis', $p->jenis) }}">
                                                    <option selected>Pilih Jenis Paket</option>
                                                    <option name="jenis" value="kiloan">Kiloan</option>
                                                    <option name="jenis" value="selimut">Selimut</option>
                                                    <option name="jenis" value="bed_cover">Bed Cover</option>
                                                    <option name="jenis" value="kaos">Kaos</option>
                                                    <option name="jenis" value="lainnya">lainnya</option>
                                                  </select>
                                                @error('jenis')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama_paket" class="form-label">Nama Paket</label>
                                                <input type="text" class="form-control @error('nama_paket') is-invalid @enderror" id="nama_paket" name="nama_paket" required autofocus value="{{ old('nama_paket', $p->nama_paket) }}">
                                                @error('nama_paket')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="harga" class="form-label">Harga</label>
                                                <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" required autofocus value="{{ old('harga', $p->harga) }}">
                                                @error('harga')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                      <button type="submit" class="btn btn-dark border-0">Edit Post</button>
                                                    </div>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                          <form action="{{ url('dashboard/paket/'.$p->id) }}" method="post" class="d-inline">
                                              @csrf
                                              <input type="hidden" name="_method" value="DELETE">
                                              <button class="btn btn-danger border-0" onclick="return confirm('Anda Yakin?')">Delete</button>
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
          $(function(){
              $('#tb-paket').DataTable();
          });
      </script>

        @endpush

@endsection

