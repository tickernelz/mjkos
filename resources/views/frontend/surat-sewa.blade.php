<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        * {
            line-height: 1.2em;
            font-size: 12pt;
            margin: 0 5px;

        }

        .font-arial {
            font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif
        }

        .font-cambria {
            font-family: Cambria, Georgia, serif
        }

        .text-center {
            text-align: center
        }

        .margin-bottom {
            margin-bottom: 1.2em
        }

        table {
            border-collapse: collapse;
            width: 100%
        }

        table.line-height-table {
            line-height: 2em
        }

        table .col-center {
            text-align: center
        }

        #header table td {
            padding: 5px
        }

        img.center {
            display: block;
            margin: 0 auto
        }

        img.logo {
            width: 93px;
            height: 123px
        }

        img.certificate {
            padding: 0 10px;
            width: 110px;
            height: 64px
        }

        .head-info td {
            vertical-align: top;
            font-size: 8pt
        }

        .yth {
            padding: 20px 0
        }

        .align-top {
            vertical-align: top
        }

        .lab td {
            text-align: center;
            padding: 15px 0
        }

    </style>
</head>

<body>
    <section id="header">
        <table collapse="collapse" class="font-arial">
            <tr>
                <td colspan="2" class="text-center">
                    <span style="font-size: 15pt; font-weight: bold">MJKOST</span><br>
                    <span style="font-size: 10pt; ">Jl. Prof. Sudharto, SH., Tembalang, Semarang, Kode Pos 50275<br>
                        Telp. (024) 7460053,7450055 - Fax. (024) 7460055<br>Site : http://www.ft.undip.ac.id - Email : teknik@undip.ac.id
                        </span><br>
                </td>
            </tr>
        </table>
        <hr widht="200px;">
    </section>
    <section class="font-cambria">
        <br>
        <div class="text-center" style="font-weight: bold; font-size:20px">BUKTI SEWA</div><br>
    </section>
    <section>
        <table class="line-height-table">
            <tr>
                <td style="width: 20%">Kode Booking</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 20%">Nama Penyewa</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 20%">Nomer Kamar</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 20%">Durasi</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 20%">Tanggal Masuk</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 20%">Tanggal Selesai</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 20%">Total Pembayaran</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
        </table>
    </section>
    <br>
    <br>
    <section id="ttd">
        <div style="font-weight: bold; color:red; font-size:30px; text-align:center">PEMBAYARAN LUNAS</div>

        {{-- <table>
            <tr>
                <td style="width: 70%;"></td>
                <td style="width: 30%;">Semarang, {{date('d-m-Y')}}</td>
            </tr>
            <tr>
                <td style="width: 70%;"></td>
                <td>Hormat saya,</td>
            </tr>
            <tr>
                <td colspan="2" style="height: 70px"></td>
            </tr>
            <tr>
                <td style="width: 70%;"></td>
                <td class="align-top">(
                    @hasanyrole('admin')
                    {{$surat->name}}
                    @else
                    {{$name}}
                    @endhasanyrole)
                    <br>
                    NIM.@hasanyrole('admin')
                    {{$surat->nim}}
                    @else
                    {{$nim}}
                    @endhasanyrole</td>
            </tr>
        </table> --}}
        <br>
    </section>
</body>

</html>
