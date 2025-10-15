<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Auth;

class MidtransController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function create(Request $request)
    {
        $amount = $request->input('amount'); // misal Rp1, 10000, dst
        $coin = $request->input('coin');

        // Data transaksi untuk Snap
        $transaction_details = [
            'order_id' => 'TOPUP-' . time(),
            'gross_amount' => $amount,
        ];

        $customer_details = [
            'first_name' => $request->user()->name,
            'email' => $request->user()->email,
        ];

        $params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snap_token' => $snapToken
        ]);
    }
     public function addCoin(Request $request) {
    $user = auth()->user();
    $coin = $request->input('coin', 0);
    $user->koin += $coin;
    $user->save();

    return response()->json(['success' => true, 'new_koin' => $user->koin]);
}
}
