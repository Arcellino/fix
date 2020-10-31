<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan</title>


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


        <table border="0" id="table-data" width="100%" align="center">
            <tr>
                <td width="70px">Invoice ID</td>
                <td width="">: {{ $material_keluar->id }}</td>
                <td width="30px">Created</td>
                <td>: {{ $material_keluar->tanggal }}</td>
            </tr>

            <tr>
                <td>Telepon</td>
                <td>: {{ $material_keluar->customer->telepon }}</td>
                <td>Alamat</td>
                <td>: {{ $material_keluar->customer->alamat }}</td>
            </tr>

            <tr>
                <td>Nama</td>
                <td>: {{ $material_keluar->customer->nama }}</td>
                <td>Email</td>
                <td>: {{ $material_keluar->customer->email }}</td>
            </tr>

            <tr>
                <td>material</td>
                <td >: {{ $material_keluar->material->nama_material }}</td>
                <td>Total Material Datang</td>
                <td >: {{ $material_keluar->total_mat_datang }}</td>
            </tr>

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