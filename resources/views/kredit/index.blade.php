{{-- File: resources/views/credit.blade.php --}}

@extends('layouts.app')

@section('title', 'Skill Credit - SkillSwap')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100 dark:bg-gray-900">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
            @include('components.header-mobile')


        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">Skill Credit</h1>

                <div class="space-y-8">
                    {{-- Saldo --}}
                    <div class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700 flex flex-col md:flex-row items-center justify-between">
                        <div>
                            <h2 class="text-lg font-medium text-gray-500 dark:text-gray-400">Saldo Kredit Anda</h2>
                            <div class="flex items-center space-x-3 mt-2">
                                <i class="ri-money-dollar-circle-fill text-5xl text-yellow-400"></i>
                                <span id="user-coin" class="text-5xl font-bold text-gray-800 dark:text-white">{{ number_format(auth()->user()->koin, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <a href="{{ route('skill-credit.history') }}" class="text-sm font-medium text-primary hover:underline">Lihat Riwayat →</a>
                        </div>
                    </div>

                    {{-- Paket Top Up --}}
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-5">Pilih Paket Top Up</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                            {{-- Paket 100 --}}
                            <div class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700 text-center flex flex-col transition-transform transform hover:-translate-y-1">
                                <div class="flex-grow">
                                    <i class="ri-copper-coin-line text-6xl text-yellow-500 mx-auto"></i>
                                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mt-4">100 Credit</h3>
                                    <p class="text-3xl font-bold text-primary mt-4">Rp 10.000</p>
                                </div>
                                <button onclick="buyCredit(100)" class="w-full mt-6 bg-primary text-white font-semibold py-3 rounded-lg hover:bg-primary-dark transition-colors">
                                    Beli Sekarang
                                </button>
                            </div>

                            {{-- Paket 200 --}}
                            <div class="relative bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-lg border-2 border-primary text-center flex flex-col transition-transform transform hover:-translate-y-1">
                                <span class="absolute top-0 -translate-y-1/2 left-1/2 -translate-x-1/2 bg-primary text-white text-xs font-semibold px-3 py-1 rounded-full">Populer</span>
                                <div class="flex-grow">
                                    <i class="ri-coin-line text-6xl text-yellow-500 mx-auto"></i>
                                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mt-4">200 Credit</h3>
                                    <p class="text-3xl font-bold text-primary mt-4">Rp 20.000</p>
                                </div>
                                <button onclick="buyCredit(200)" class="w-full mt-6 bg-primary text-white font-semibold py-3 rounded-lg hover:bg-primary-dark transition-colors">
                                    Beli Sekarang
                                </button>
                            </div>

                            {{-- Paket 500 --}}
                            <div class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700 text-center flex flex-col transition-transform transform hover:-translate-y-1">
                                <div class="flex-grow">
                                    <i class="ri-medal-line text-6xl text-yellow-500 mx-auto"></i>
                                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mt-4">500 Credit</h3>
                                    <p class="text-3xl font-bold text-primary mt-4">Rp 50.000</p>
                                    <p class="text-sm text-green-500 font-medium mt-1">Paling Hemat!</p>
                                </div>
                                <button onclick="buyCredit(500)" class="w-full mt-6 bg-primary text-white font-semibold py-3 rounded-lg hover:bg-primary-dark transition-colors">
                                    Beli Sekarang
                                </button>
                            </div>

                        </div>
                    </div>

                    {{-- Cairkan Kredit --}}
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-5">Punya Banyak Kredit?</h2>
                        <div class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700 flex flex-col md:flex-row items-center justify-between">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Cairkan Saldo Anda</h3>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Tarik saldo kredit ke rekening bank atau e-wallet pilihan Anda.</p>
                            </div>
                            <div class="w-full md:w-auto mt-4 md:mt-0">
                                <button class="w-full md:w-auto bg-green-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-green-700 transition-colors flex items-center justify-center space-x-2">
                                    <i class="ri-wallet-3-line"></i>
                                    <span>Mulai Proses Pencairan</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    @include('components.navbar-mobile')
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
function buyCredit(coin) {
    // 1. Ambil Snap Token dari server
    fetch("{{ route('midtrans.create') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        // Sesuaikan 'amount' dengan harga paket yang sebenarnya
        // Contoh: jika 100 koin = Rp 10.000
        body: JSON.stringify({
            coin: coin,
            amount: coin * 100 // Rp 10.000
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.snap_token) {
            // 2. Tampilkan popup Midtrans
            snap.pay(data.snap_token, {
                // 3. Callback yang dijalankan HANYA JIKA pembayaran SUKSES
                onSuccess: function(result) {
                    console.log('Payment successful!', result);

                    // 4. KIRIM PERMINTAAN UNTUK MENAMBAH KOIN SETELAH BERHASIL BAYAR
                    fetch("{{ route('user.add-coin') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            coin: coin,
                            // Anda bisa mengirim detail transaksi jika perlu
                            midtrans_order_id: result.order_id
                        })
                    })
                    .then(r => r.json())
                    .then(updated => {
                        // Perbarui tampilan saldo dan beri notifikasi sukses
                        document.getElementById('user-coin').innerText = updated.koin.toLocaleString();
                        alert("Top up berhasil!");
                        // location.reload(); // Opsional, jika ingin refresh halaman
                    })
                    .catch(error => {
                        console.error('Error updating coin:', error);
                        alert("Pembayaran berhasil, tetapi terjadi kesalahan saat memperbarui saldo. Hubungi support.");
                    });
                },
                onPending: function(result) {
                    // Opsional: Handle jika pembayaran pending (misal: transfer bank)
                    console.log('Payment pending.', result);
                    alert("Menunggu pembayaran Anda. Saldo akan diperbarui setelah pembayaran dikonfirmasi.");
                    location.reload();
                },
                onError: function(result) {
                    // Opsional: Handle jika pembayaran gagal
                    console.error('Payment error!', result);
                    alert("Pembayaran gagal.");
                },
                onClose: function() {
                    // Opsional: Handle jika popup ditutup sebelum pembayaran selesai
                    console.log('Popup closed without finishing payment.');
                }
            });
        } else {
            alert('Gagal membuat transaksi. Silakan coba lagi.');
        }
    })
    .catch(error => {
        console.error('Error fetching snap token:', error);
        alert('Terjadi kesalahan. Tidak dapat memulai pembayaran.');
    });
}
</script>

@endsection
