<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $now = Carbon::now();

        // 1. Data Akun & Total Kekayaan
        $accounts = $user->accounts;
        $totalBalance = $accounts->sum('balance');

        // 2. Ringkasan Pemasukan & Pengeluaran Bulan Ini
        $monthlyIncome = $user->transactions()
            ->where('type', 'income')
            ->whereMonth('date', $now->month)
            ->whereYear('date', $now->year)
            ->sum('amount');

        $monthlyExpense = $user->transactions()
            ->where('type', 'expense')
            ->whereMonth('date', $now->month)
            ->whereYear('date', $now->year)
            ->sum('amount');

        // 3. Hitung Rasio Pengeluaran (Burn Rate)
        $expenseRatio = $monthlyIncome > 0 
            ? min(($monthlyExpense / $monthlyIncome) * 100, 100) 
            : ($monthlyExpense > 0 ? 100 : 0);

        // 4. Data Chart (7 Hari Terakhir)
        $last7Days = collect();
        $dailyExpenses = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $last7Days->push($date->translatedFormat('d M'));
            $dailyExpenses->push($user->transactions()->where('type', 'expense')->whereDate('date', $date)->sum('amount'));
        }

        // 5. Distribusi Pengeluaran per Kategori
        $categoryDistributions = $user->transactions()
            ->where('type', 'expense')
            ->whereMonth('date', $now->month)
            ->whereYear('date', $now->year)
            ->select('category_id', DB::raw('SUM(amount) as total'))
            ->groupBy('category_id')
            ->with('category')
            ->get()
            ->map(function ($item) use ($monthlyExpense) {
                $item->percentage = $monthlyExpense > 0 ? ($item->total / $monthlyExpense) * 100 : 0;
                return $item;
            })->sortByDesc('total');

        // 6. Saving Goals
        $savingGoals = $user->savingGoals;

        return view('dashboard', compact(
            'accounts', 'totalBalance', 'monthlyIncome', 'monthlyExpense', 
            'expenseRatio', 'last7Days', 'dailyExpenses', 'categoryDistributions', 'savingGoals'
        ));
    }
}
