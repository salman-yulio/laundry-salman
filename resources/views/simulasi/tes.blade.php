@extends('layouts.main')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Simulasi Penjualan Aksesoris</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <ul class="nav navbar-right panel_toolbox">
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <form id="formAksesoris">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Form</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row col-12">
                                            <div class="form-group row col-6">
                                                <label for="id" class="col-sm-4 col-form-label">No Transaksi</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="id" id="id"
                                                        placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row col-6">
                                                <label for="tgl" class="col-4 col-form-label">Tanggal Beli</label>
                                                <div class="col-sm-6">
                                                    <input type="date" class="form-control" id="tgl" required="required"
                                                        name="tgl">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row col-12">
                                            <div class="form-group row col-6">
                                                <label for="item" class="col-sm-4 col-form-label">Barang Dibeli</label>
                                                <select class="form-select form-control col-sm-5 form-select"
                                                    aria-label=".form-select example" id="item" name="item" required>
                                                    <option name="item" value="gantungan_kunci">Gantungan Kunci</option>
                                                    <option name="item" value="ikat_rambut">Ikat Rambut</option>
                                                </select>
                                            </div>
                                            <div class="form-group row col-6">
                                                <label for="warna" class="col-sm-4 col-form-label">Warna</label>
                                                <select class="form-select form-control col-sm-5 form-select"
                                                    aria-label=".form-select example" id="warna" name="warna" required>
                                                    <option name="warna" value="kuning">Kuning</option>
                                                    <option name="warna" value="merah">Merah</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row col-12">
                                            <div class="form-group row col-6">
                                                <label for="jml" class="col-sm-4 col-form-label">Jumlah</label>
                                                <div class="col-sm-2">
                                                    <input min="1" type="number" class="form-control" value="1" name="jml"
                                                        id="jml" placeholder="" required>
                                                </div>
                                                <div class="col-sm2">
                                                    <span>pcs</span>
                                                </div>
                                            </div>
                                            <div class="form-group row col-6">
                                                <label for="nama" class="col-4 col-form-label">Nama Pembeli</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" name="nama" id="nama"
                                                        placeholder="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <button class="btn btn-primary" id="btnSimpan" type="submit">Input</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="card">
                                <div class="card-header">
                                    <h3>Data</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            <button class="btn btn-success" type="button" id="sorting">Urutkan</button>
                                        </div>
                                        <input type="search" class="form-control col-sm-2" name="search" id="search">
                                        <button class="btn btn-success" type="button" id="btnSearch">Cari</button>
                                    </div>
                                    <table id="tblAksesoris" class="table table-striped table-bordered table-compact">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tanggal Beli</th>
                                                <th>Nama Barang</th>
                                                <th>Warna</th>
                                                <th>Harga</th>
                                                <th>Jumlah Beli</th>
                                                <th>Nama Pembeli</th>
                                                <th>Diskon</th>
                                                <th>Total Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="8" align="center">Belum ada data</td>
                                            </tr>
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
@endsection

@push('script')
    <script>
        //methhods
        function insert() {
            const form = $('#formAksesoris').serializeArray()
            let dataAksesoris = JSON.parse(localStorage.getItem('dataAksesoris')) || []
            let newData = {}
            form.forEach(function(item, index) {
                let name = item['name']
                let value = (name === 'id' ||
                    name === 'jml' ?
                    Number(item['value']) : item['value'])
                newData[name] = value
            })
            // console.log(newData)

            localStorage.setItem('dataAksesoris', JSON.stringify([...dataAksesoris,
                newData
            ]))
            return newData
        }

        // end of events

        function showData(dataAksesoris) {
            let row = ''
            var jumlah = 0
            var diskon = 0

            var total1 = 0
            var total2 = 0
            var total3 = 0
            var total4 = 0

            const dc = 0.20
            const gan = 5000
            const ikat = 2500
            // let arr = JSON.parse(localStorage.getItem('dataAksesoris')) || []
            if (dataAksesoris.length == 0) {
                return row = `<tr><td colspan="8" align="center">Belum ada data</td></tr>`
            }
            dataAksesoris.forEach(function(item, index) {


                if (item['item'] == 'gantungan_kunci') {
                    var harga = gan
                } else if (item['item'] == 'ikat_rambut') {
                    var harga = ikat
                }

                jumlah = (harga * item['jml'])
                if (jumlah >= 30000) {
                    diskon = jumlah * dc
                    jumlah = jumlah - diskon
                } else if (item['jml'] >= 10) {
                    diskon = jumlah * dc
                    jumlah = jumlah - diskon
                } else {
                    diskon = 0
                }

                total1 += harga
                total2 += Number(item['jml'])
                total3 += diskon
                total4 += jumlah

                row += `<tr>`
                row += `<td>${item['id']}</td>`
                row += `<td>${item['tgl']}</td>`
                row += `<td>${item['item']}</td>`
                row += `<td>${item['warna']}</td>`
                row += `<td>${harga}</td>`
                row += `<td>${item['jml']}</td>`
                row += `<td>${item['nama']}</td>`
                row += `<td>${diskon}</td>`
                row += `<td>${jumlah}</td>`
                row += `</tr>`
            })
            row += `<tr>`
            row += `<td colspan="4" align="center">Total</td>`
            row += `<td>${total1}</td>`
            row += `<td>${total2}</td>`
            row += `<td></td>`
            row += `<td>${total3}</td>`
            row += `<td>${total4}</td>`
            row += `</tr>`

            return row
        }

        function insertionSort(arr, key, type) {
            let i, j, id, value;
            type = type === 'asc' ? '>' : '<'

            if (arr[0].constructor !== Object || !key) return false
            for (i = 1; i < arr.length; i++) {
                value = arr[i];
                id = arr[i][key]
                j = i - 1;
                while (j >= 0 && eval(arr[j][key] < id)) {
                    arr[j + 1] = arr[j];
                    j = j - 1;
                }
                arr[j + 1] = value;
            }
            return arr
        }

        function searching(arr, key, teks) {
            for (let i = 0; i < arr.length; i++) {
                if (arr[i][key] = teks)
                    return i
            }
            return -1
        }

        //after load

        $(function() {
            //initialize
            let dataAksesoris = JSON.parse(localStorage.getItem('dataAksesoris')) || []
            // console.log(dataAksesoris)
            $('#tblAksesoris tbody').html(showData(dataAksesoris))


            //events
            $('#formAksesoris').on('submit', function(e) {
                // console.log(e)
                e.preventDefault();
                insert()
                dataAksesoris = JSON.parse(localStorage.getItem('dataAksesoris')) || []
                $('#tblAksesoris tbody').html(showData(dataAksesoris))

            })

            $('#sorting').on('click', function() {
                data = insertionSort(dataAksesoris, 'id', 'asc')
                // console.log(data)

                data && $('#tblAksesoris tbody').html(showData(dataAksesoris))
                // console.log(dataAksesoris)
            })

            $('#btnSearch').on('click', function(e) {
                let teksSearch = $('#search').val()
                let id = searching(dataAksesoris, 'item', teksSearch)
                let data = []
                if (id >= 0)
                    data.push(dataAksesoris[id])

                $('#tblAksesoris tbody').html(showData(data))
                // console.log(dataAksesoris)
            })
        })
    </script>
@endpush
