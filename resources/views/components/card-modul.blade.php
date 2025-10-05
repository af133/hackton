<div class="bg-white dark:bg-gray-800/50 rounded-xl shadow-sm overflow-hidden border border-gray-200 dark:border-gray-700 transform hover:-translate-y-1 transition-all duration-300 hover:shadow-lg">
    @php
        $gambarPath = $kelas->path_gambar ? asset('storage/kelas/' . $kelas->path_gambar) : asset('images/default-thumbnail.jpg');
    @endphp
    <div class="h-48 bg-cover bg-center" style="background-image: url('{{ asset($gambarPath) }}')"></div>
    <div class="p-5">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{$kelas->judul_kelas}}</h3>
        <p class="text-sm text-gray-500 ">{{ $nama }}</p>
       
        <p class="text-2xl font-extrabold text-gray-800 dark:text-white">
                                {{$rating==0?0: number_format($rating , 1) }}
        </p>

                            {{-- Bintang --}}
        <div class="flex text-yellow-400">
            @php
                if($rating == 0){

                    $fullStars = 0;
                    $halfStar = 0;
                    $emptyStars = 5;
                } else {
                $fullStars = floor($rating);   // bintang penuh
                $halfStar = ($rating - $fullStars >= 0.5) ? 1 : 0; // bintang setengah
                $emptyStars = 5 - ($fullStars + $halfStar); // sisanya kosong
                }
                @endphp

            {{-- Bintang penuh --}}
            @for ($i = 0; $i < $fullStars; $i++)
                <i class="ri-star-s-fill"></i>
            @endfor

            {{-- Bintang setengah --}}
            @if ($halfStar)
                <i class="ri-star-half-s-line"></i>
            @endif

            {{-- Bintang kosong --}}
            @for ($i = 0; $i < $emptyStars; $i++)
                <i class="ri-star-line"></i>
            @endfor
        </div>
        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('kelas.detail',['kelasId'=>$kelas->id]) }}">

                <button class="px-6 py-2.5 font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors">Lanjutkan Sesi</button>
            </a>
                <div class="flex items-center gap-x-2 text-gray-400">
                <button class="w-10 h-10 hover:text-pink-500 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"><i class="ri-heart-line"></i></button>
                <button 
                    onclick="shareToWhatsApp()" 
                    class="w-10 h-10 hover:text-indigo-500 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <i class="ri-share-line"></i>
                </button>
            </div>
        </div>
    </div>
</div>


<script>
function shareToWhatsApp() {
    // Ubah pesan dan link sesuai kebutuhanmu
    const message = encodeURIComponent("Hai! Cek link keren ini:");
    const url = encodeURIComponent(window.location.href); // ambil link halaman saat ini
    const waLink = `https://wa.me/?text=${message}%20${url}`;
    
    // buka WhatsApp
    window.open(waLink, '_blank');
}
</script>