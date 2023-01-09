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

                            <form id="formBuku">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Form</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="id" class="col-sm-2 col-form-label">ID Buku</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="id" id="id" placeholder=""
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="judul" id="judul"
                                                    placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="pengarang" id="pengarang"
                                                    placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tahun" class="col-sm-2 col-form-label">Tahun terbit</label>
                                            <div class="col-sm-4">
                                                <select name="tahun" id="tahun" class="form-control">
                                                    @for ($i = date('Y'); $i > 1900; $i--)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="harga" class="col-sm-2 col-form-label">Harga Buku</label>
                                            <div class="col-sm-4">
                                                <input type="number" class="form-control" name="harga" id="harga"
                                                    placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="qty" class="col-sm-2 col-form-label">Qty</label>
                                            <div class="col-sm-4">
                                                <input type="number" class="form-control" value="0" name="qty" id="qty"
                                                    placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <button class="btn btn-primary" id="btnSimpan" type="submit">Simpan</button>
                                                <button class="btn btn-danger" id="btnReset" type="reset">Reset</button>
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
                                            <button class="btn btn-success" type="button" id="sorting">Sorting</button>
                                        </div>
                                        <input type="search" class="form-control col-sm-2" name="search" id="search">
                                        <button class="btn btn-success" type="button" id="btnSearch">Cari</button>
                                    </div>
                                    <table id="tblBuku" class="table table-striped table-bordered table-compact">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Judul Buku</th>
                                                <th>Pengarang</th>
                                                <th>Tahun terbit</th>
                                                <th>Harga buku</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="6" align="center">Belum ada data</td>
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
            const form = $('#formBuku').serializeArray()
            let dataBuku = JSON.parse(localStorage.getItem('dataBuku')) || []
            let newData = {}
            form.forEach(function(item, index) {
                let name = item['name']
                let value = (name === 'id' ||
                    name === 'qty' ||
                    name === 'harga' ?
                    Number(item['value']) : item['value'])
                newData[name] = value
            })
            // console.log(newData)

            localStorage.setItem('dataBuku', JSON.stringify([...dataBuku,
                newData
            ]))
            return newData
        }

        function showData(dataBuku) {
            let row = ''
            // let arr = JSON.parse(localStorage.getItem('dataBuku')) || []
            if (dataBuku.length == 0) {
                return row = `<tr><td colspan="6" align="center">Belum ada data</td></tr>`
            }
            dataBuku.forEach(function(item, index) {
                row += `<tr>`
                row += `<td>${item['id']}</td>`
                row += `<td>${item['judul']}</td>`
                row += `<td>${item['pengarang']}</td>`
                row += `<td>${item['tahun']}</td>`
                row += `<td>${item['harga']}</td>`
                row += `<td>${item['qty']}</td>`
                row += `</tr>`
            })
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
            let dataBuku = JSON.parse(localStorage.getItem('dataBuku')) || []
            // console.log(dataBuku)
            $('#tblBuku tbody').html(showData(dataBuku))


            //events
            $('#formBuku').on('submit', function(e) {
                // console.log(e)
                e.preventDefault();
                insert()
                dataBuku = JSON.parse(localStorage.getItem('dataBuku')) || []
                $('#tblBuku tbody').html(showData(dataBuku))
            })

            $('#sorting').on('click', function() {
                data = insertionSort(dataBuku, 'id', 'asc')
                // console.log(data)

                data && $('#tblBuku tbody').html(showData(dataBuku))
                // console.log(dataBuku)
            })

            $('#btnSearch').on('click', function(e) {
                let teksSearch = $('#search').val()
                let id = searching(dataBuku, 'id', teksSearch)
                let data = []
                if (id >= 0)
                    data.push(dataBuku[id])

                $('#tblBuku tbody').html(showData(data))
                // console.log(dataBuku)
            })
        })
    </script>
@endpush
