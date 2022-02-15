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

          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12  ">
              <div class="x_panel">
                <div class="x_title">
                    <h2>Form Pembelian</h2>
                  <ul class="nav navbar-right panel_toolbox">
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

                    <div>
                        @include('dashboard.transaksi.form')
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
              let totalHarga = 0;
              function tambahPaket(a){
                  let d = $(a).closest('tr');
                  let jenisPaket = d.find('td:eq(1)').text();
                  let namaPaket = d.find('td:eq(2)').text();
                  let hargaPaket = d.find('td:eq(3)').text();
                  let idPaket = d.find('.idPaket').val();
                  let data = '';
                  let tbody = $('#tblTransaksi tbody tr td').text();
                  data += '<tr>';
                  data += '<td>'+jenisPaket+'</td>';
                  data += '<td>'+namaPaket+'</td>';
                  data += '<td>'+hargaPaket+'</td>';
                  data += '<input type="hidden" name="paket_id[]" value="'+idPaket+'">'
                  data += '<input type="hidden" name="harga_beli[]" value="'+hargaPaket+'">'
                  data += '<input type="hidden" value="'+hargaPaket*parseInt($('#qty').val())+'">'
                  data += '<td><input type="number" value="1" min="1" class="qty" name="jumlah[]"></td>';
                  data += '<td><input type="text" readonly name="sub_total[]" class="subTotal" value="'+hargaPaket+'"></td>';
                  data += '<td><button type="button" class="btnRemovePaket btn btn-outline-danger"><span class="fa fa-remove"></span></button></td>';
                  data += '</tr>';
                  if(tbody == 'Belum ada data') $('#tblTransaksi tbody tr').remove();

                  $('#tblTransaksi tbody').append(data);
                  totalHarga += parseFloat(hargaPaket);
                  $('#totalHarga').val(totalHarga);
                  $('#tblPaketModal').modal('hide');
              }

              function calcSubTotal(a){
                  let qty = parseInt($(a).closest('tr').find('.qty').val());
                  let hargaPaket = parseFloat($(a).closest('tr').find('td:eq(2)').text());
                  let subTotalAwal = parseFloat($(a).closest('tr').find('.subTotal').val());
                  let subTotal = qty * hargaPaket;
                  totalHarga += subTotal - subTotalAwal;
                  $(a).closest('tr').find('.subTotal').val(subTotal);
                  $('#totalHarga').val(totalHarga);
              }

              //event
              $(function(){
                  $('#tblPaket2').DataTable();

                  //pemilihan barang
                  $('#tblPaketModal').on('click', '.pilihPaket', function(){
                      tambahPaket(this);
                  });

                  //change qty event
                  $('#formTransaksi').on('change','.qty', function(){
                      calcSubTotal(this);
                  });

                  //remove barang
                  $('#formTransaksi').on('click','.btnRemovePaket', function(){
                      let subTotalAwal = parseFloat($(this).closest('tr').find('.subTotal').val());
                    //   alert(totalHarga);
                      totalHarga -= subTotalAwal;

                      $currentRow = $(this).closest('tr').remove();
                      $('#totalHarga').val(totalHarga);
                  });
              });

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
            Date.prototype.toDateInputValue = (function() {
                var local = new Date(this);
                local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
                return local.toJSON().slice(0,10);
                });

                $('#cash_tgl').val(new Date().toDateInputValue());

                // $('#f-cash').submit(function(e){
                //     e.preventDefault();
                //     if($('v-ktp').val() == ""){
                //         alert('data pelanggan belum dipilih')

                //     }else if($('#v-kode_mobil').val() == ""){
                //         alert('data mobil belum dipilih')

                //     }else{
                //         e.currentTarget.submit()
                //     }
                // })
          </script>
      @endpush
