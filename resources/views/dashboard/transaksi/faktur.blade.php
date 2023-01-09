<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{ asset('assets') }}/css/faktur.css"> --}}

    <title>Document</title>
</head>

<body>
    <div class="row"
        style="font-size:11;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
        <h3 class="my-auto"><b style="line-height: 0.5em">Laundry Salman</b><b
            style="float: right;line-height: 0.5em">Faktur</b></h3>
        <hr>
        @foreach ($detail_transaksi as $dt)
            <h4 class="my-auto"><b style="line-height: 0.5em">PT.{{ $dt->paket->outlet->nama }}</b><b
                    style="float: right;line-height: 0.5em" >{{ $dt->transaksi->kode_invoice }}</b></h4>
            <p class="my-auto">Alamat : {{ $dt->paket->outlet->alamat }}</p>
            <p class="my-auto">Phone : {{ $dt->paket->outlet->telepon }}</p>
            <table class="expandable-table w-100 table-sm" border="1" cellspacing="0" style="width:100%">
                <tbody style="text-align: center">
                    <tr>
                        <td colspan="4">
                            <p class="my-auto" style="text-align: left"><b> Nama Pembeli :</b>
                                {{ $dt->transaksi->member->nama }}</p>
                            <p class="my-auto" style="text-align: left"><b> Alamat Pembeli :</b>
                                {{ $dt->transaksi->member->alamat }}</p>
                            <p class="my-auto" style="text-align: left"><b> Telepon Pembeli :</b>
                                {{ $dt->transaksi->member->telepon }}</p>
                        </td>
                    </tr>
                    <tr style="background-color: skyblue">
                        <td>No</td>
                        <td>Nama Paket</td>
                        <td>Jumlah Paket</td>
                        <td>Harga Paket</td>
                    </tr>
                    <tr>
                        <td width="5%">{{ $i = isset($i) ? ++$i : ($i = 1) }}</td>
                        <td>{{ $dt->paket->nama_paket }}</td>
                        <td width="15%">{{ $dt->qty }}</td>
                        <td>{{ $dt->paket->harga }}</td>
                    </tr>
                    <tr>
                        <td rowspan="5" colspan="2"></td>
                        <td style="text-align: right"><b style="padding-right: 6">Total Awal</b></td>
                        {{-- <td  ></td> --}}
                        <td>{{ $dt->transaksi->subtotal }}</td>
                    </tr>
                    <tr>
                        <td  style="text-align: right;padding-right: 6">Diskon</td>
                        <td>{{ $dt->transaksi->diskon }}%</td>
                    </tr>
                    <tr>
                        <td  style="text-align: right;padding-right: 6">Pajak</td>
                        <td>{{ $dt->transaksi->pajak }}%</td>
                    </tr>
                    <tr>
                        <td  style="text-align: right;padding-right: 6">Biaya Tambahan</td>
                        <td>{{ $dt->transaksi->biaya_tambahan }}</td>
                    </tr>
                    <tr>
                        <td  style="text-align: right"><b style="padding-right: 6">Total Akhir</b></td>
                        <td>{{ $dt->transaksi->total }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: left">
                            <p class="mx-auto" style="text-align: left; line-height: 0.5em;font-size:9"><b>Perhatian</b></p>
                            <p style="text-align: left; line-height: 0.5em;font-size:9"> - Pengabilan cucian harus
                                disertai nota</p>
                            <p style="text-align: left; line-height: 0.5em;font-size:9"> - Klaim berlaku 24 jam setelah
                                barang di ambil
                            </p>
                            <p style="text-align: left; line-height: 0.5em;font-size:9">- Cucian luntur bukan tanggung jawab kami</p>
                            <p style="text-align: left; line-height: 0.5em;font-size:9">- Hitung dan periksa sebelum pergi</p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p style="text-align: right; line-height: 0.5em"><b>Hormat kami,</b></p>
            <br><br>
            <p style="text-align: right; line-height: 0.5em"><b>(.....................)</b></p>
        @endforeach
    </div>


</body>

</html>
