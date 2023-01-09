@extends('layouts.main')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Simulasi Transaksi Barang</h3>
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

                            <form id="formBarang">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Form</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row col-12">
                                            <div class="form-group row col-6">
                                                <label for="id" class="col-sm-4 col-form-label">ID Barang</label>
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
                                                <label for="nama" class="col-sm-4 col-form-label">Nama Barang</label>
                                                <select class="form-select form-control col-sm-5 form-select"
                                                    aria-label=".form-select example" id="nama" name="nama" required>
                                                    <option name="nama" value="detergen">Detergen</option>
                                                    <option name="nama" value="pewangi">Pewangi</option>
                                                    <option name="nama" value="detergen-sepatu">Detergen Sepatu</option>
                                                </select>
                                            </div>
                                            <div class="form-group row col-6">
                                                <label for="harga" class="col-4 col-form-label">Harga Barang</label>
                                                <div class="col-sm-4">
                                                    <input hidden type="number" class="form-control" value="15000" name="harga"
                                                        id="harga" placeholder="" required>
                                                        <span id="harga-span">Rp. 15000</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row col-12">
                                            <div class="form-group row col-6">
                                                <label for="jml" class="col-sm-4 col-form-label">Jumlah</label>
                                                <div class="col-sm-4">
                                                    <input min="1" type="number" class="form-control" value="1" name="jml"
                                                        id="jml" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row col-6">
                                                <label for="jenis" class="col-5 col-form-label">Jenis pembayaran</label>
                                                <div class="form-check col-sm-2">
                                                    <input type="radio" class="form-check-input" name="jenis" id="jenis" value="Cash"
                                                        required>
                                                    <label class="form-check-label">Cash</label>
                                                </div>
                                                <div class="form-check col-sm-4">
                                                    <input type="radio" class="form-check-input" name="jenis" id="jenis" value="e-money"
                                                        required>
                                                    <label class="form-check-label">e-money/transfer</label>
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
                                        <div class="col-sm-2">
                                            <input type="checkbox" id="cCash" value="Cash" checked>
                                            <label class="form-check-label">Cash</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="checkbox" id="cEmoney" value="e-money" checked>
                                            <label class="form-check-label">e-money</label>
                                        </div>
                                        <input type="search" class="form-control col-sm-2" name="search" id="search">
                                        <button class="btn btn-success" type="button" id="btnSearch">Cari</button>
                                    </div>
                                    <table id="tblBarang" class="table table-striped table-bordered table-compact">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tanggal Beli</th>
                                                <th>Nama Barang</th>
                                                <th>Harga</th>
                                                <th>Qty</th>
                                                <th>Diskon</th>
                                                <th>Total Harga</th>
                                                <th>Jenis Bayar</th>
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
            const form = $('#formBarang').serializeArray()
            let dataBarang = JSON.parse(localStorage.getItem('dataBarang')) || []
            let newData = {}
            form.forEach(function(item, index) {
                let name = item['name']
                let value = (name === 'id' ||
                name === 'jml' ||
                name === 'harga' ?
                Number(item['value']) : item['value'])
                newData[name] = value
            })
            // console.log(newData)
            
            localStorage.setItem('dataBarang', JSON.stringify([...dataBarang,
            newData
        ]))
        return newData
    }
    const det = 15000
    const pew = 10000
    const dets = 25000
    
    $('#nama').on('change', function() {
        let value = $('#nama').val()
            console.log(value)
            if (value == 'detergen') {
                $('#harga').val(det)
                $('#harga-span').text('Rp. 15000')
            } else if (value == 'pewangi') {
                $('#harga').val(pew)
                $('#harga-span').text('Rp. 10000')
            }else if (value == 'detergen-sepatu') {
                $('#harga').val(dets)
                $('#harga-span').text('Rp. 25000')
            }
        })
        // end of events

        // function calculateAge(birthday) {
        //     birthday = new Date(birthday)
        //     var ageDifms = Date.now() - birthday.getTime();
        //     var ageDate = new Date(ageDifms);
        //     return Math.abs(ageDate.getUTCFullYear - 1970);
        // }

        function showData(dataBarang) {
            let row = ''
            const dc = 0.15
            var jumlah = 0
            var diskon = 0

            var total1 = 0
            var total2 = 0
            var total3 = 0
            var total4 = 0
            // let arr = JSON.parse(localStorage.getItem('dataBarang')) || []
            if (dataBarang.length == 0) {
                return row = `<tr><td colspan="8" align="center">Belum ada data</td></tr>`
            }
            dataBarang.forEach(function(item, index) {


                jumlah = (item['harga'] * item['jml'])
                if (jumlah >= 50000) {
                    diskon = jumlah * dc
                    jumlah = jumlah - diskon
                }

                total1 += Number(item['harga'])
                total2 += Number(item['jml'])
                total3 += diskon
                total4 += jumlah

                row += `<tr>`
                row += `<td>${item['id']}</td>`
                row += `<td>${item['tgl']}</td>`
                row += `<td>${item['nama']}</td>`
                row += `<td>${item['harga']}</td>`
                row += `<td>${item['jml']}</td>`
                row += `<td>${diskon}</td>`
                row += `<td>${jumlah}</td>`
                row += `<td>${item['jenis']}</td>`
                row += `</tr>`
            })
                row += `<tr>`
                row += `<td colspan="3" align="center">Total</td>`
                row += `<td>${total1}</td>`
                row += `<td>${total2}</td>`
                row += `<td>${total3}</td>`
                row += `<td colspan="2">${total4}</td>`
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
                while (j >= 0 && eval(arr[j][key] > id)) {
                    arr[j + 1] = arr[j];
                    j = j - 1;
                }
                arr[j + 1] = value;
            }
            return arr
        }

        function searching(arr, key, teks) {
            for (let i = 0; i < arr.length; i++) {
                if (arr[i][key] == teks)
                    return i
            }
            return -1
        }

        //after load

        $(function() {
            //initialize
            let dataBarang = JSON.parse(localStorage.getItem('dataBarang')) || []
            // console.log(dataBarang)
            $('#tblBarang tbody').html(showData(dataBarang))


            //events
            $('#formBarang').on('submit', function(e) {
                // console.log(e)
                e.preventDefault();
                insert()
                dataBarang = JSON.parse(localStorage.getItem('dataBarang')) || []
                $('#tblBarang tbody').html(showData(dataBarang))

            })

            $('#sorting').on('click', function() {
                data = insertionSort(dataBarang, 'id', 'asc')
                // console.log(data)

                data && $('#tblBarang tbody').html(showData(dataBarang))
                // console.log(dataBarang)
            })

            $('#btnSearch').on('click', function(e) {
                let teksSearch = $('#search').val()
                let id = searching(dataBarang, 'id', teksSearch)
                let data = []
                if (id >= 0)
                    data.push(dataBarang[id])

                $('#tblBarang tbody').html(showData(data))
                // console.log(dataBarang)
            })

            $('#cCash').on('click', function(e) {
                let filter = $('#cCash').val()
                let id = searching(dataBarang, 'jenis', filter)
                let data = []
                if (id >= 0)
                    data.push(dataBarang[id])

                $('#tblBarang tbody').html(showData(data))
                // console.log(dataBarang)
            })

            $('#cEmoney').on('click', function(e) {
                let filterE = $('#cEmoney').val()
                let id = searching(dataBarang, 'jenis', filterE)
                let data = []
                if (id >= 0)
                    data.push(dataBarang[id])

                $('#tblBarang tbody').html(showData(data))
                // console.log(dataBarang)
            })
        })
    </script>
@endpush
