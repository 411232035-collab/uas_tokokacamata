<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $transactions = Transaction::with('product')->latest('transaction_date')->paginate(10);
        $summary = [
            'total_transactions' => Transaction::count(),
            'total_qty' => (int) Transaction::sum('qty'),
            'total_revenue' => (float) Transaction::sum('subtotal'),
            'latest_transaction_date' => Transaction::max('transaction_date'),
        ];

        return view('reports.index', compact('transactions', 'summary'));
    }

    public function exportExcel(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $transactions = Transaction::with('product')->orderByDesc('transaction_date')->get();

        return Excel::download(new class($transactions) implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings {
            public function __construct(private $transactions) {}

            public function headings(): array
            {
                return [
                    'Nomor Transaksi',
                    'Tanggal Transaksi',
                    'Merchant',
                    'Kode Produk',
                    'Produk',
                    'Qty',
                    'Harga Satuan',
                    'Subtotal',
                ];
            }

            public function collection()
            {
                return $this->transactions->map(fn ($t) => [
                    $t->transaction_number,
                    $t->transaction_date,
                    $t->merchant_code,
                    $t->product?->product_code ?? '-',
                    $t->product?->product_name ?? '-',
                    $t->qty,
                    $t->price,
                    $t->subtotal,
                ]);
            }
        }, 'report-transactions.xlsx');
    }

    public function exportPdf(): \Symfony\Component\HttpFoundation\Response
    {
        $transactions = Transaction::with('product')->orderByDesc('transaction_date')->get();
        $summary = [
            'total_transactions' => $transactions->count(),
            'total_qty' => (int) $transactions->sum('qty'),
            'total_revenue' => (float) $transactions->sum('subtotal'),
        ];
        $pdf = Pdf::loadView('reports.pdf', compact('transactions', 'summary'));

        return $pdf->download('report-transactions.pdf');
    }
}
