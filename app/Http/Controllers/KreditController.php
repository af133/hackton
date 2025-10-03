<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class KreditController extends Controller
{
    public function index()
    {
        return view('kredit.index');
    }
    public function history(Request $request)
    {
         $dummyData = [];
        $descriptions = [
            'in' => ['Top Up Saldo', 'Bonus Pendaftaran', 'Cashback Pembelian Kelas', 'Pencairan Dibatalkan'],
            'out' => ['Pembelian Kelas "Laravel Dasar"', 'Pencairan Dana ke Rekening', 'Biaya Layanan Bulanan', 'Pembelian Materi "UI/UX Figma"']
        ];
        $statuses = ['Berhasil', 'Berhasil', 'Berhasil', 'Pending', 'Gagal']; // Memberi bobot lebih banyak pada 'Berhasil'

        // Buat 50 data transaksi acak
        for ($i = 50; $i >= 1; $i--) {
            $type = rand(0, 1) ? 'in' : 'out'; // Tipe transaksi acak (masuk/keluar)

            if ($type === 'in') {
                $description = $descriptions['in'][array_rand($descriptions['in'])];
                $amount = rand(10, 200);
            } else {
                $description = $descriptions['out'][array_rand($descriptions['out'])];
                $amount = -abs(rand(5, 50)); // Jumlah keluar selalu negatif
            }

            $dummyData[] = (object) [
                'id'           => 'TRX' . (18500 + $i),
                'description'  => $description,
                'amount'       => $amount,
                'status'       => $statuses[array_rand($statuses)],
                'created_at'   => Carbon::now()->subDays(rand(0, 90))->subHours(rand(0,23))->subMinutes(rand(0,59)), // Tanggal acak dalam 90 hari terakhir
            ];
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $transactionCollection = new Collection($dummyData);

        $perPage = 15;

        $currentPageItems = $transactionCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $paginatedTransactions = new LengthAwarePaginator($currentPageItems, count($transactionCollection), $perPage);

        $paginatedTransactions->setPath($request->url());

        return view('kredit.history', ['transactions' => $paginatedTransactions]);
    }
}
