<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan Duitify</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.6; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #6750A4; pb: 10px; }
        .summary-box { background: #f8f9fa; padding: 15px; border-radius: 10px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px; }
        th { background: #6750A4; color: white; padding: 10px; text-align: left; }
        td { border-bottom: 1px solid #eee; padding: 10px; }
        .income { color: green; }
        .expense { color: red; }
        .total-row { font-weight: bold; background: #eee; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Keuangan Duitify</h2>
        <p>Periode: {{ $summary['period'] }} | Pemilik: {{ $summary['user_name'] }}</p>
    </div>

    <div class="summary-box">
        <table style="border: none; background: transparent; margin-top: 0;">
            <tr>
                <td>Total Pemasukan:</td>
                <td class="income">Rp{{ number_format($summary['total_income'], 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Pengeluaran:</td>
                <td class="expense">Rp{{ number_format($summary['total_expense'], 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td>Selisih (Net):</td>
                <td>Rp{{ number_format($summary['total_income'] - $summary['total_expense'], 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Kategori</th>
                <th>Keterangan</th>
                <th>Akun</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $t)
            <tr>
                <td>{{ \Carbon\Carbon::parse($t->date)->format('d/m/Y') }}</td>
                <td>{{ $t->type }}</td>
                <td>{{ $t->category->name }}</td>
                <td>{{ $t->description ?? '-' }}</td>
                <td>{{ $t->account->name }}</td>
                <td class="{{ $t->type == 'income' ? 'income' : 'expense' }}">
                    {{ $t->type == 'income' ? '+' : '-' }}Rp{{ number_format($t->amount, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>