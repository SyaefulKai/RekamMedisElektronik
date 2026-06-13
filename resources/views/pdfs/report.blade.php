<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Kunjungan Pasien</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            line-height: 1.4;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #333;
        }
        .header h1 {
            font-size: 18px;
            margin: 0 0 5px 0;
            text-transform: uppercase;
        }
        .header p {
            margin: 3px 0;
            font-size: 11px;
        }
        .info-section {
            margin-bottom: 15px;
        }
        .info-section table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-section td {
            padding: 2px 5px;
            font-size: 10px;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table.data-table th {
            background-color: #4a90d9;
            color: white;
            padding: 6px 4px;
            text-align: left;
            font-size: 9px;
            font-weight: bold;
        }
        table.data-table td {
            padding: 4px;
            border: 1px solid #ddd;
            font-size: 9px;
            vertical-align: top;
        }
        table.data-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .diagnosis-item {
            margin: 1px 0;
        }
        .footer {
            margin-top: 25px;
            text-align: right;
            font-size: 9px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 8px;
        }
        .summary-box {
            margin-bottom: 15px;
            padding: 8px;
            background-color: #f0f8ff;
            border: 1px solid #b8d4f0;
            border-radius: 3px;
        }
        .summary-box table {
            width: 100%;
        }
        .summary-box td {
            padding: 2px 8px;
            font-size: 10px;
        }
        .page-break {
            page-break-after: always;
        }
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN KUNJUNGAN PASIEN</h1>
        <p>Periode: {{ $startDate }} - {{ $endDate }}</p>
        <p>Dicetak: {{ $generatedAt }}</p>
    </div>

    <div class="summary-box">
        <table>
            <tr>
                <td class="text-bold">Total Kunjungan:</td>
                <td>{{ $encounters->count() }} kunjungan</td>
                <td class="text-bold">Total Pasien:</td>
                <td>{{ $totalPatients }} pasien</td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="10%">Tanggal</th>
                <th width="8%">No. RM</th>
                <th width="18%">Nama Pasien</th>
                <th width="26%">Keluhan</th>
                <th width="23%">Diagnosa</th>
                <th width="10%">Praktisi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($encounters as $index => $encounter)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($encounter->date)->format('d/m/Y') }}</td>
                <td>{{ $encounter->patient?->medical_record_number ?? '-' }}</td>
                <td>{{ $encounter->patient?->name ?? '-' }}</td>
                <td>{{ $encounter->subjective?->chief_complaint ?? '-' }}</td>
                <td>
                    @if($encounter->assessment && $encounter->assessment->assessmentDiagnoses->count() > 0)
                        @foreach($encounter->assessment->assessmentDiagnoses as $diagnosis)
                            <div class="diagnosis-item">
                                <strong>{{ $diagnosis->code }}</strong>: {{ $diagnosis->display }}
                            </div>
                        @endforeach
                    @else
                        -
                    @endif
                </td>
                <td>{{ $encounter->practitioner?->user?->name ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center" style="padding: 15px;">
                    Tidak ada data kunjungan pada periode ini.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak melalui Sistem Rekam Medis Elektronik</p>
        <p>Halaman ini dicetak secara otomatis pada {{ $generatedAt }}</p>
    </div>
</body>
</html>
