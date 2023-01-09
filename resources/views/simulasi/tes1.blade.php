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

                            <div class="card">
                                <div class="card-header">
                                    <h3>Form</h3>
                                </div>
                                <div class="card-body">
                                    <form id="formKaryawan">
                                        <div class="form-group row">
                                            <label for="id" class="col-sm-2 col-form-label">ID</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="id" id="id" placeholder="ID"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="nama" id="nama"
                                                    placeholder="Nama" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                            <div class="form-check col-sm-2">
                                                <input type="radio" class="form-check-input" name="jk" id="jk" value="L">
                                                <label class="form-check-label">Laki-laki</label>
                                            </div>
                                            <div class="form-check col-sm-2">
                                                <input type="radio" class="form-check-input" name="jk" id="jk" value="P">
                                                <label class="form-check-label">Perempuan</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama" class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <button class="btn btn-primary" id="btnSimpan" type="submit">Simpan</button>
                                                <button class="btn btn-danger" id="btnReset" type="reset">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3>Data</h3>
                                </div>
                                <div class="card-body">
                                    <table id="tblKaryawan" class="table table-striped table-bordered table-compact">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="3" align="center">Belum ada data</td>
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
    @push('script')
        <script>
            function insert() {
                const data = $('#formKaryawan').serializeArray()
                let newData = {}
                data.forEach(function(item, index) {
                    let name = item['name']
                    let value = (name === 'id' ? Number(item['value']) : item['value'])
                    newData[name] = value
                })
                return newData
            }
            $(function() {
                //property
                let dataKaryawan = []

                //events
                $('#formKaryawan').on('submit', function(e) {
                    e.preventDefault()
                    dataKaryawan.push(insert())
                    console.log(dataKaryawan)
                })
                //end of events
            })
        </script>
    @endpush
@endsection
