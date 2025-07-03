<!DOCTYPE html>
<html>
<head>
    <title>Alumni magang</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        .border {
            border: 1px solid black;
            padding: 6px;
        }
        h3 {
            text-align: center;
        }
        .text-center {
            text-align: center;
        }

        no-border, no-border td {
            border: none !important;
        }
    </style>
</head>
<body>
    <p align="center">
        <img src="{{ public_path('img/logo.png') }}" alt="">
    </p>
    <h3>PENILAIAN PRAKTEK KERJA LAPANGAN</h3>
    <h3>PT GARUDA CYBER INDONESIA</h3>

    <table width="100%" class="no-border" style="font-size:14px;">
        <tr style="border:none !important;">
            <td style="border:none !important;">
                <table class="border" style="font-size:14px;">
                    <tr class="border">
                        <td class="border" align="center">No</td>
                        <td class="border" align="center">Komponen Penilain</td>
                        <td class="border" align="center">Nilai</td>
                    </tr>
                    @php
                        $no = 1;
                    @endphp
                    @foreach($personalComponents as $item)
                        <tr>
                            <td class="border" align="center">{{ $no }}</td>
                            <td class="border">{{ $item['komponen'] }}</td>
                            <td class="border" align="center">{{ $item['nilai'] }}</td>
                        </tr>
                        @php
                            $no++;
                        @endphp
                    @endforeach
                </table>
            </td>

            <td>
                <table class="border" style="font-size:14px;">
                    <tr class="border">
                        <td class="border" align="center">No</td>
                        <td class="border" align="center">Komponen Penilain</td>
                        <td class="border" align="center">Nilai</td>
                    </tr>

                    @foreach($kompetensiComponents as $item)
                        <tr>
                            <td class="border"align="center">{{ $no }}</td>
                            <td class="border">{{ $item['komponen'] }}</td>
                            <td class="border" align="center">{{ $item['nilai'] }}</td>
                        </tr>
                        @php
                            $no++;
                        @endphp
                    @endforeach
                </table>
            </td>
        </tr>
    </table>

    <br>
    <br>
    <br>
    <table style="font-size:14px;">
        <tr>
            <td width="60%"></td>
            <td>
                Mengetahui,
                <br>
                <br>
                <br>
                <br>
                <br>
                <u>Kemal Aldian Faldano, S.AB</u>
                <br>Kordinator Magang
            </td>
        </tr>

    </table>
</body>
</html>
