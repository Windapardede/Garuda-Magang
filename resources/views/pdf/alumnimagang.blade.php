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
        table, th, td {
            border: 1px solid black;
            padding: 6px;
        }
        h3 {
            text-align: center;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h3>Daftar Alumni Magang</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Instansi</th>
                <th>Posisi</th>
                <th>Periode</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alumnimagang as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->nama->name }}</td>
                <td>{{ $item->nama->instansi->nama }}</td>
                <td>{{ $item->nama->posisi->nama }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($item->nama->mulai_magang)->format('d/m/Y') }}
                    -
                    {{ \Carbon\Carbon::parse($item->nama->selesai_magang)->format('d/m/Y') }}
                </td>
            </tr>
            @empty
            <tr>
                <td class="text-center" colspan="5">Tidak ada data alumni magang.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
