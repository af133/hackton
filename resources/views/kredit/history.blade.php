{{-- File: resources/views/history.blade.php --}}

@extends('layouts.app')

@section('title', 'Riwayat Transaksi - SkillSwap')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100 dark:bg-gray-900">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="md:hidden sticky top-0 z-20 flex items-center justify-between h-20 px-6 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border-b border-gray-200 dark:border-gray-700">
            <button @click="sidebarOpen = true" class="text-gray-500 dark:text-gray-300">
                <i class="ri-menu-2-line text-2xl"></i>
            </button>
            <div class="flex items-center gap-x-3">
                <span class="font-semibold text-gray-700 dark:text-gray-200 text-sm">{{ auth()->user()->name ?? 'Pengguna' }}</span>
                <img class="h-9 w-9 rounded-full object-cover" src="{{ auth()->user()->avatar_url ?? 'https://i.pravatar.cc/150?u=aisyahfarah' }}" alt="User avatar">
            </div>
        </header>

        {{-- Konten Utama Halaman Riwayat --}}
        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8">

                {{-- JUDUL HALAMAN --}}
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">Riwayat Transaksi</h1>

                {{-- ======================================= --}}
                {{-- BAGIAN 1: FILTER & PENCARIAN --}}
                {{-- ======================================= --}}
                <div class="bg-white dark:bg-gray-800/50 p-5 rounded-2xl shadow-md borderborder-gray-200 dark:border-gray-700 mb-8">
                    <form action="{{-- route('history.index') --}}" method="GET">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            {{-- Filter Tanggal Mulai --}}
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dari Tanggal</label>
                                <input type="date" name="start_date" id="start_date" class="mt-1 px-4 py-2 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-primary focus:ring-primary dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                            {{-- Filter Tanggal Selesai --}}
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hingga Tanggal</label>
                                <input type="date" name="end_date" id="end_date" class="mt-1 px-4 py-2 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-primary focus:ring-primary dark:bg-gray-700 dark:text-white sm:text-sm">
                            </div>
                            {{-- Filter Tipe Transaksi --}}
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipe</o>
                                <select id="type" name="type" class="mt-1 px-4 py-2 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-primary focus:ring-primary dark:bg-gray-700 dark:text-white sm:text-sm">
                                    <option value="">Semua Tipe</option>
                                    <option value="in">Kredit Masuk</option>
                                    <option value="out">Kredit Keluar</option>
                                </select>
                            </div>
                            {{-- Tombol Aksi --}}
                            <div class="flex items-end space-x-2">
                                <button type="submit" class="w-full bg-primary text-white font-semibold py-2 px-4 rounded-lg hover:bg-primary-dark transition-colors">Filter</button>
                                <a href="{{-- route('history.index') --}}" class="w-full text-center bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 transition-colors">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- ======================================= --}}
                {{-- BAGIAN 2: TABEL RIWAYAT --}}
                {{-- ======================================= --}}
                <div class="bg-white dark:bg-gray-800/50 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700 overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700/50 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID Transaksi</th>
                                <th scope="col" class="px-6 py-3">Deskripsi</th>
                                <th scope="col" class="px-6 py-3">Jumlah</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop data transaksi dari controller. Gunakan @forelse untuk handle empty state --}}
                            @forelse ($transactions as $transaction)
                            <tr class="bg-white dark:bg-transparent border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                                <td class="px-6 py-4 font-mono text-gray-600 dark:text-gray-300">
                                    #{{ $transaction->id }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{ $transaction->description }}
                                </td>
                                <td @class([
                                    'px-6 py-4 font-bold',
                                    'text-green-500' => $transaction->amount > 0,
                                    'text-red-500' => $transaction->amount < 0,
                                ])>
                                    {{ $transaction->amount > 0 ? '+' : '' }}{{ number_format($transaction->amount, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span @class([
                                        'px-2 py-1 text-xs font-semibold rounded-full',
                                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' => $transaction->status === 'Berhasil',
                                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' => $transaction->status === 'Pending',
                                        'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' => $transaction->status === 'Gagal',
                                    ])>
                                        {{ $transaction->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->created_at->format('d M Y, H:i') }}
                                </td>
                            </tr>
                            @empty
                            {{-- Tampilan jika tidak ada data transaksi --}}
                            <tr>
                                <td colspan="5" class="text-center py-12 px-6">
                                    <i class="ri-file-text-line text-4xl text-gray-400"></i>
                                    <p class="mt-2 font-semibold text-gray-700 dark:text-gray-200">Tidak Ada Riwayat Transaksi</p>
                                    <p class="text-gray-500 dark:text-gray-400">Semua aktivitas kredit Anda akan muncul di sini.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- ======================================= --}}
                {{-- BAGIAN 3: PAGINATION LINKS --}}
                {{-- ======================================= --}}
                <div class="mt-6">
                    {{-- $transactions->links() --}}
                </div>

            </main>
        </div>
    </div>
</div>
@endsection
