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
                  <h2>Tabel Member</h2>
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
                            <form action="/dashboard/member" method="POST" class="mb-5 text-dark" enctype="multipart/form-data" style>
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required autofocus value="{{ old('alamat') }}">
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin </label>
                                <select class="form-select form-select mb-3" aria-label=".form-select example" id="jenis_kelamin" name="jenis_kelamin">
                                  <option selected>Pilih Jenis Kelamin</option>
                                  <option name="jenis_kelamin" value="L">Laki-Laki</option>
                                  <option name="jenis_kelamin" value="P">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                              </div>
                            <div class="mb-3">
                                <label for="telepon" class="form-label">telepon</label>
                                <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" required autofocus value="{{ old('telepon') }}">
                                @error('telepon')
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
                                <table id="tb-member" class="table table-striped table-md">
                                    <thead>
                                      <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Telepon</th>
                                        <th scope="col">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($member as $member)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $member->nama }}</td>
                                            <td>{{ $member->alamat }}</td>
                                            <td>{{ $member->jenis_kelamin }}</td>
                                            <td>{{ $member->telepon }}</td>
                                            <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#staticBackdrop{{ $member->nama }}">
                                                Edit
                                            </button>

                                              <!-- Modal -->
                                              <div class="modal fade" id="staticBackdrop{{ $member->nama }}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header text-dark">
                                                      <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="{{ url('dashboard/member/'.$member->id) }}" method="POST" class="mb-5" enctype="multipart/form-data">
                                              @method('PUT')
                                              @csrf
                                              <div class="mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus value="{{ old('nama', $member->nama) }}">
                                                @error('nama')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                              </div>
                                              <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required autofocus value="{{ old('alamat', $member->alamat) }}">
                                                @error('alamat')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                              </div>
                                              <div class="mb-3">
                                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin </label>
                                                <select class="form-select form-select mb-3" aria-label=".form-select example" id="jenis_kelamin" name="jenis_kelamin" required autofocus value="{{ old('jenis_kelamin', $member->jenis_kelamin) }}">
                                                  <option selected>Pilih Jenis Kelamin</option>
                                                  <option name="jenis_kelamin" value="L">Laki-Laki</option>
                                                  <option name="jenis_kelamin" value="P">Perempuan</option>
                                                </select>
                                                @error('jenis_kelamin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                              </div>
                                              <div class="mb-3">
                                                <label for="telepon" class="form-label">Telepon</label>
                                                <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" required autofocus value="{{ old('telepon', $member->telepon) }}">
                                                @error('telepon')
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
                                          <form action="{{ url('dashboard/member/'.$member->id) }}" method="post" class="d-inline">
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
            $('#tb-member').DataTable();
        });
    </script>

      @endpush

@endsection

