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
                  <h2>Tabel User</h2>
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
                        Register
                      </button>
                    @include('dashboard.user.create')
                            <div>
                                <table id="tb-user" class="table table-striped table-md">
                                    <thead>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Outlet</th>
                                        <th scope="col">Role</th>
                                        {{-- <th scope="col">Action</th> --}}
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $u)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $u->name }}</td>
                                            <td>{{ $u->username }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td>{{ $u->outlet->nama }}</td>
                                            <td>{{ $u->role }}</td>
                                            {{-- <td>
                                            <!-- Button trigger modal -->
                                            @include('dashboard.user.edit')
                                            <form action="{{ url('dashboard/user/'.$u->id) }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger delete-paket border-0">Delete</button> &nbsp;
                                                </form>
                                            </td> --}}
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
            //Data Tables
              $('#tb-paket').DataTable();

          // Alert
        // $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        //     $("success-alert").slideUp(500);
        // });
        // $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
        //     $("error-alert").slideUp(500);
        // });

        // Delete Alert
        $('.delete-user').click(function(e){
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

