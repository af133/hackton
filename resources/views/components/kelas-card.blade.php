@props([
    'kelas',
    'tipe' => 'jelajah'
])

<div class="bg-white rounded-2xl shadow-md overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
    {{-- Gambar Thumbnail --}}
    <a href="{{ route('kelas.detail', $kelas) }}" class="block">
        <div class="h-40 bg-cover bg-center" style="background-image: url('{{ $kelas->kelas_thumbnail_url }}');"></div>
    </a>

    <div class="p-5">
        {{-- Header Card --}}
        <div class="flex justify-between items-start">
            <a href="{{ route('kelas.detail', $kelas) }}" class="block">
                <h3 class="text-lg font-bold text-gray-900 truncate pr-2">{{ $kelas->judul_kelas }}</h3>
            </a>
            @if($tipe == 'dimiliki')
                <span class="text-xs font-semibold px-2 py-1 rounded-full flex-shrink-0 {{ $kelas->is_draft ? 'bg-gray-200 text-gray-800' : 'bg-green-100 text-green-800' }}">
                    {{ $kelas->is_draft ? 'Draft' : 'Publish' }}
                </span>
            @else
                <span class="text-xs font-semibold px-2 py-1 rounded-full flex-shrink-0 bg-blue-100 text-blue-800">
                    {{ $kelas->level_kelas }}
                </span>
            @endif
        </div>

        {{-- Info Tambahan --}}
        <div class="mt-3 flex justify-between text-sm text-gray-600">
            <div class="flex items-center gap-2">
                <i class="ri-group-line text-indigo-500"></i>
                <span>{{ $kelas->detailPembelians->count() }} Murid</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="ri-star-s-fill text-yellow-400"></i>
                <span>{{ number_format($kelas->rating, 1) }} ({{ $kelas->detailPembelians->where('rating', '>', 0)->count() }} review)</span>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="mt-4 pt-4 border-t">
            @if ($tipe == 'dimiliki')
                <a href="{{ route('kelas.detail', $kelas) }}"
                   class="block w-full px-5 py-2.5 text-sm font-semibold text-primary-dark bg-indigo-100 hover:bg-indigo-200 rounded-lg text-center">
                    Kelola Kelas
                </a>
            @elseif ($tipe == 'diikuti')
                <a href="{{ route('kelas.detail', $kelas) }}"
                   class="block w-full px-5 py-2.5 text-sm font-semibold text-white bg-primary hover:bg-primary/90 rounded-lg text-center">
                    Lanjutkan Belajar
                </a>
            @else {{-- Tipe 'jelajah' atau default --}}
                <a href="{{ route('kelas.detail', $kelas) }}"
                   class="block w-full px-5 py-2.5 text-sm font-semibold text-primary-dark bg-indigo-100 hover:bg-indigo-200 rounded-lg text-center">
                    Lihat Kelas
                </a>
            @endif
        </div>
    </div>
</div>
