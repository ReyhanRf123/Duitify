<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function exportPdf(Request $request)
    {
        $user = Auth::user();
        $month = $request->get('month', Carbon::now()->month);
        $year = $request->get('year', Carbon::now()->year);

        $transactions = $user->transactions()
            ->with(['account', 'category'])
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->orderBy('date', 'asc')
            ->get();

        $summary = [
            'total_income' => $transactions->where('type', 'income')->sum('amount'),
            'total_expense' => $transactions->where('type', 'expense')->sum('amount'),
            'period' => Carbon::create()->month($month)->translatedFormat('F') . ' ' . $year,
            'user_name' => $user->name
        ];

        // Load view khusus PDF
        $pdf = Pdf::loadView('reports.monthly_pdf', compact('transactions', 'summary'));

        // Download file dengan nama yang rapi
        return $pdf->download("Laporan_Duitify_{$summary['period']}.pdf");
    }
}
