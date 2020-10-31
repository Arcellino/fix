<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>


</head>

<style>
    #table-data {
        border-collapse: collapse;
        padding: 3px;
    }

    #table-data td, #table-data th {
        border: 1px solid black;
    }
</style>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/20/Logo_PLN.svg" style="width:100%; max-width:300px;">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <p>Category : {{ $laporan->category->name}}</p>
    <p></p>
    <table border="0" id="table-data" width="100%" align="center">
    <thead>
    <tr>
            <td><b>Material</b></td>
            <td><b>Satuan</b></td>
            <td><b>Tanggal</b></td>
            <td><b>Volume per Bulan</b></td>
            <td><b>Harga Satuan</b></td>
            <td><b>Transportasi dan Asuransi</b></td>
            <td><b>No.SPB</b></td>
            <td><b>Pabrikan</b></td>
            <td><b>PRK</b></td>
            <td><b>Jenis Material</b></td>
            <td><b>Total Vol. Material</b></td>
            <td><b>Total Mat. Datang</b></td>
    </tr>
    </thead>

    @foreach ($data as $p)
    <tbody>
    <tr>
        <td>{{ $p->nama_material}}</td>
        <td>{{ $p->satuan}}</td>
        <td>{{ $p->tanggal}}</td>
        <td>{{ $p->volume_per_bulan}}</td>
        <td>{{ $p->harga_satuan}}</td>
        <td>{{ $p->transportasi_dan_asuransi}}</td>
        <td>{{ $p->no_spb}}</td>
        <td>{{ $p->pabrikan}}</td>
        <td>{{ $p->prk}}</td>
        <td>{{ $p->jenis_material}}</td>
        <td>{{ $p->total_vol_material}}</td>
        <td>{{ $p->total_mat_datang}}</td>
    </tr>
    </tbody>
    @endforeach
 
        
    </table>

    {{--<hr  size="2px" color="black" align="left" width="65%">--}}


    <table border="0" width="90%">
        <tr align="right">
            <td>Hormat Kami</td>
        </tr>
    </table>

    <table border="0" width="90%">
        <tr align="right">
            <td><img src="https://upload.wikimedia.org/wikipedia/en/f/f4/Timothy_Spall_Signature.png" width="100px" height="100px"></td>
        </tr>

    </table>
    <table border="0" width="90%">
        <tr align="right">
            <td>Sir Bram Novaldi Saputra</td>
        </tr>
    </table>
</div>
