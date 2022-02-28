@extends('layouts.main')

@section('content')

       <!-- page content -->
       <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Transaksi</h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5   form-group pull-right top_search">
              </div>
            </div>
          </div>

          <div class="clearfix">

          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12  ">
              <div class="x_panel">

                  <div class="clearfix"></div>

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

                    <div>
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                  <a class="nav-link active" id="nav-data" data-toggle="collapse" href="#dataLaundry"
                                   role="button" aria-expanded="false" aria-controls="collapseExample">Data Laundry</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="nav-form" data-toggle="collapse" href="#formLaundry"
                                   role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-plus nav-icon"></i> Cucian Baru</a>
                                </li>
                              </ul>
                          <div>
                            @include('dashboard.transaksi2.form')
                            @include('dashboard.transaksi2.data')
                          </div>
                    </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

      @endsection

      @push('script')
      <script>
      // Script untuk #menu data dan form transaksi
      $('#dataLaundry').collapse('show')

      $('#dataLaundry').on('show.bs.collapse', function () {
        $('#formLaundry').collapse('hide');
        $('#nav-form').removeClass('active');
        $('#nav-data').addClass('active');
      })

      $('#formLaundry').on('show.bs.collapse', function () {
        $('#dataLaundry').collapse('hide');
        $('#nav-data').removeClass('active');
        $('#nav-form').addClass('active');
      })

      </script>

<script>
    $(function(){
      $('#tbl-member').DataTable();

      $('#tbl-member').on('click', '.pilih-member', function(){
          let ele = $(this).closest('tr');
          let nama = ele.find('td:eq(1)').text();
          let alamat = ele.find('td:eq(2)').text();
          let telp = ele.find('td:eq(3)').text();
          $('#v-nama').val(nama)
          $('#v-alamat').val(alamat)
          $('#v-telepon').val(telp)
          $('#tblMemberModal').modal('hide')
      });

  });
</script>
      @endpush


