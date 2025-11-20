<?php
// Set the timezone to 'Asia/Jakarta'
date_default_timezone_set('Asia/Jakarta');

// Set the default locale to Indonesian
$bulan = [
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
];

// Define the days of the week in Indonesian
$hari = [
    'Sunday' => 'Minggu',
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu',
];

// Get the current date and time
$hariIni = date('l');
$tanggal = date('d') . ' ' . $bulan[date('m')] . ' ' . date('Y');
$waktu = date('H:i');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>BERITA ACARA
        PEMERIKSAAN INSTRUMEN PERKULIAHAN KE-1
    </title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 16px;
            line-height: 1.5;
        }

        h2,
        h3 {
            text-align: center;
            margin: 0;
        }

        .header,
        .footer {
            text-align: center;
        }

        .section {
            margin-top: 20px;
            margin: 0mm 5mm 0mm 5mm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        td,
        th {
            border: 1px solid black;
            padding: 5px;
            vertical-align: top;
        }

        .no-border td {
            border: none;
        }

        .signature-1 {
            text-align: left;
            margin: 40mm 20mm 0mm 20mm;
        }

        .signature-2 {
            text-align: center;
            margin: 0mm 20mm 0mm 20mm;
        }

        .center {
            text-align: center;
        }

        .alat-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .alat-table th,
        .alat-table td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
            vertical-align: middle;
        }

        .alat-table th {
            background-color: #f9f9f9;
        }

        .footer {
            width: 60%;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 12px;
            padding-top: 5px;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ public_path('assets/kop-surat.png') }}" alt="" width="100%">
        <hr>
        <h4>BERITA ACARA <br>
            PEMERIKSAAN INSTRUMEN PERKULIAHAN KE-{{ $sesi ?? '-' }}
        </h4>
    </div>

    <div class="section">
        @php
            $counter = 1;
        @endphp
        <p align="justify">Berdasarkan Standar Proses Pembelajaran ITERA nomor ST/ITERA/SPMI-3.0 poin standar 2 dan 3
            serta Standar Penilaian Pembelajaran Nomor ST/ITERA/SPMI-4.0 poin standar 2, 3, 4, 5, dan 6 maka dilakukan
            proses pemeriksaan instrumen perkuliahan berupa:
            @foreach ($namaDokumenList as $nama)
                {{ $counter++ }}) {{ $nama }}{{ !$loop->last ? ',' : '' }}
            @endforeach
            pada;
        </p>
        <table class="no-border" style="width: 100%; margin: 0mm 10mm 0mm 10mm;">
            <tr>
                <td style="width: 25%;">Hari, Tanggal</td>
                <td style="width: 75%;">: {{ $hari[$hariIni] ?? '-' }}, {{ $tanggal ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 25%;">Waktu</td>
                <td style="width: 75%;">: {{ $waktu ?? '-' }} WIB</td>
            </tr>
            <tr>
                <td style="width: 25%;">Tempat</td>
                <td style="width: 75%;">: {{ $tempat ?? '-' }}</td>
            </tr>
        </table>

        <p align="justify">yang dilaksanakan oleh Gugus Kendali Mutu Prodi {{ $prodi }} dengan hasil pemeriksaan
            diketahui bahwa:</p>
    </div>


    <div class="footer">
        <img width="100%" src="{{ public_path('assets/kop-surat-footer.png') }}" alt="">
    </div>


    {{-- <div style="page-break-before: always;"></div> --}}

    <div class="section">
        <table class="alat-table" border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen<br>Penanggung<br>Jawab</th>
                    @foreach ($dokumenSesi as $namaDokumen)
                        <th>{{ $namaDokumen }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($groupedProgres as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data['matkul'] }}</td>
                        <td>{{ $data['dosen'] }}</td>
                        @foreach ($dokumenSesi as $namaDokumen)
                            <td>{{ $data['dokumens'][$namaDokumen] ? 'Ada' : 'Tidak Ada' }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="page-break-before: always;"></div>

    <div class="section">
        <p align="justify">Demikian berita acara pemeriksaan ini dibuat untuk dapat digunakan sebagaimana peruntukannya
        </p>
        <div class="signature-2">
            <table class="no-border" style="width: 100%; margin-top: 20px;">
                <tr>
                    <td width="50%"><br><br>Mengetahui, <br>Prodi {{ $prodi }}<br><br><br><br><br>{{ $kaprodi }}<br>NIP. {{ $nip_kaprodi }}</td>
                    <td width="50%"><br><br>Lampung Selatan, {{ $tanggal ?? '-' }}<br>GKMP {{ $prodi }}<br>
                        <br><br><br><br>{{ $gkmp }}<br>NIP. {{ $nip_gkmp }}
                    </td>
                </tr>
            </table>
            <br><br>
        </div>

</body>

</html>
