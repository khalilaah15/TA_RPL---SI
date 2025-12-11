<?php
namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        // Ambil data transaksi yang SUDAH completed
        $transactions = Transaction::where('status', 'completed')
                        ->get()
                        ->groupBy(function($val) {
                            return Carbon::parse($val->created_at)->format('F Y'); // Kelompokkan "December 2025"
                        });

        $labels = [];
        $totals = [];

        foreach ($transactions as $month => $data) {
            $labels[] = $month;
            $totals[] = $data->sum('total_amount');
        }

        return view('admin.report.index', [
            'labels' => $labels, 
            'totals' => $totals,
            'transactions' => Transaction::where('status', 'completed')->latest()->get()
        ]);
    }
}