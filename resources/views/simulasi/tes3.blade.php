@extends('layouts.main')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Simulasi</h3>
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

                            <form id="formKaryawan">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Form</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row col-12">
                                            <div class="form-group row col-6">
                                                <label for="id" class="col-sm-4 col-form-label">ID Karyawan</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="id" id="id"
                                                        placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row col-6">
                                                <label for="nama" class="col-4 col-form-label">Nama Karyawan</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" name="nama" id="nama"
                                                        placeholder="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row col-12">
                                            <div class="form-group row col-6">
                                                <label for="jk" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                                <div class="form-check col-sm-4">
                                                    <input type="radio" class="form-check-input" name="jk" id="jk" value="L"
                                                        required>
                                                    <label class="form-check-label">Laki-laki</label>
                                                </div>
                                                <div class="form-check col-sm-4">
                                                    <input type="radio" class="form-check-input" name="jk" id="jk" value="P"
                                                        required>
                                                    <label class="form-check-label">Perempuan</label>
                                                </div>
                                            </div>
                                            <div class="form-group row col-6">
                                                <label for="status" class="col-4 col-form-label">Status Menikah</label>
                                                <select class="form-select form-control col-sm-3 form-select"
                                                    aria-label=".form-select example" id="status" name="status" required>
                                                    <option name="status" value="single">Single</option>
                                                    <option name="status" value="couple">Couple</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row col-12">
                                            <div class="form-group row col-6">
                                                <label for="jml" class="col-sm-4 col-form-label">Jumlah Anak</label>
                                                <div class="col-sm-4">
                                                    <input type="number" class="form-control" value="0" name="jml"
                                                        id="jml" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row col-6">
                                                <label for="mulai" class="col-4 col-form-label">Mulai Bekerja</label>
                                                <div class="col-sm-6">
                                                    <input type="date" class="form-control" id="mulai" required="required"
                                                        name="mulai">
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
                                    <table id="tblKaryawan" class="table table-striped table-bordered table-compact">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>JK</th>
                                                <th>Status</th>
                                                <th>Jml anak</th>
                                                <th>Mulai Bekerja</th>
                                                <th>Gaji Awal</th>
                                                <th>Tunjangan</th>
                                                <th>Gaji Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="9" align="center">Belum ada data</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td width="" colspan="6" align="center">Total</td>
                                                <td id="total1"></td>
                                                <td id="total2"></td>
                                                <td id="total3"></td>
                                            </tr>
                                        </tfoot>
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
            const form = $('#formKaryawan').serializeArray()
            let dataKaryawan = JSON.parse(localStorage.getItem('dataKaryawan')) || []
            let newData = {}
            form.forEach(function(item, index) {
                let name = item['name']
                let value = (name === 'id' ||
                    name === 'jml' ?
                    Number(item['value']) : item['value'])
                newData[name] = value
            })
            // console.log(newData)

            localStorage.setItem('dataKaryawan', JSON.stringify([...dataKaryawan,
                newData
            ]))
            return newData
        }

        $('#status').on('change', function() {
            let value = $('#status').val()
            console.log(value)
            if (value == 'single') {
                $('#jml').val(0)
                $('#jml').attr('readonly', true)
            } else {
                $('#jml').attr('readonly', false)

            }
        })
        //end of events

        // function calculateAge(birthday) {
        //     birthday = new Date(birthday)
        //     var ageDifms = Date.now() - birthday.getTime();
        //     var ageDate = new Date(ageDifms);
        //     return Math.abs(ageDate.getUTCFullYear - 1970);
        // }

        function showData(dataKaryawan) {
            let row = ''
            // let arr = JSON.parse(localStorage.getItem('dataKaryawan')) || []
            if (dataKaryawan.length == 0) {
                return row = `<tr><td colspan="9" align="center">Belum ada data</td></tr>`
            }
            dataKaryawan.forEach(function(item, index, birthday) {

                const awal = 2000000
                const bonusTahun = 150000
                const bonusAnak = 150000
                const bonusCouple = 250000

                dan = new Date(item['mulai'])
                var ageDifMs = Date.now() - dan.getTime();
                var ageDate = new Date(ageDifMs)
                var newAge = Math.abs(ageDate.getUTCFullYear() - 1970)
                var tahun = newAge * bonusTahun



                if (item['jml'] >= 2) {
                    var child = 2
                } else if (item['jml'] != 1) {
                    var child = 0
                } else {
                    var child = 1
                }

                let anak = bonusAnak * child



                let status = (item['status'] === 'couple' ? bonusCouple : 0)
                let tunjangan = anak + status + tahun

                let total = tunjangan + awal

                row += `<tr>`
                row += `<td>${item['id']}</td>`
                row += `<td>${item['nama']}</td>`
                row += `<td>${item['jk']}</td>`
                row += `<td>${item['status']}</td>`
                row += `<td>${item['jml']}</td>`
                row += `<td>${item['mulai']}</td>`
                row += `<td>2000000</td>`
                row += `<td>${tunjangan}</td>`
                row += `<td>${total}</td>`
                row += `</tr>`
            })
            return row
        }


        function total() {
            let table = document.getElementById('tblKaryawan').getElementsByTagName('tbody')[0]
            let total1 = 0
            let total2 = 0
            let total3 = 0

            for (let i = 0; i < table.children.length; i++) {
                total1 += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[6].innerText)
                total2 += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[7].innerText)
                total3 += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[8].innerText)
            }

            document.getElementById('total1').innerText = total1
            document.getElementById('total2').innerText = total2
            document.getElementById('total3').innerText = total3
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
            let dataKaryawan = JSON.parse(localStorage.getItem('dataKaryawan')) || []
            // console.log(dataKaryawan)
            $('#tblKaryawan tbody').html(showData(dataKaryawan))
            // total()


            //events
            $('#formKaryawan').on('submit', function(e) {
                // console.log(e)
                e.preventDefault();
                insert()
                dataKaryawan = JSON.parse(localStorage.getItem('dataKaryawan')) || []
                $('#tblKaryawan tbody').html(showData(dataKaryawan))
                // total()
            })

            $('#sorting').on('click', function() {
                data = insertionSort(dataKaryawan, 'id', 'asc')
                // console.log(data)

                data && $('#tblKaryawan tbody').html(showData(dataKaryawan))
                // console.log(dataKaryawan)
            })

            $('#btnSearch').on('click', function(e) {
                let teksSearch = $('#search').val()
                let id = searching(dataKaryawan, 'id', teksSearch)
                let data = []
                if (id >= 0)
                    data.push(dataKaryawan[id])

                $('#tblKaryawan tbody').html(showData(data))
                // console.log(dataKaryawan)
            })
        })
    </script>
@endpush
