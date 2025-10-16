@extends('layouts.app')

@section('title', 'Detail Diskusi - SkillSwap')
@section('body_class', 'bg-background')

@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-background">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8 max-w-4xl mx-auto">

                {{-- Navigasi Kembali --}}
                <a href="{{ url()->previous() }}" class="text-sm font-medium text-primary hover:underline flex items-center gap-1 mb-4">
                    <i class="ri-arrow-left-s-line"></i>
                    Kembali ke {{ $post->community->name ?? 'Komunitas' }}
                </a>

                {{-- Postingan Utama --}}
                <div class="bg-white p-6 rounded-2xl shadow-md">
                    <div class="flex items-start gap-4">
                        <img class="h-10 w-10 rounded-full object-cover"
                            src="{{ $post->user->profile_photo_path
                                ? (Str::startsWith($post->user->profile_photo_path, 'http')
                                    ? $post->user->profile_photo_path
                                    : asset('storage/' . $post->user->profile_photo_path))
                                : 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) }}"
                            alt="{{ $post->user->name }}">

                        <div class="w-full">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $post->user->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                                <button class="text-gray-400 hover:text-primary"><i class="ri-more-2-fill"></i></button>
                            </div>

                            <div class="prose prose-sm max-w-none mt-3">
                                <p>{{ $post->content }}</p>
                            </div>

                            <div class="flex items-center gap-4 text-gray-500 mt-4 border-t pt-3">
                                <button class="flex items-center gap-1 hover:text-primary">
                                    <i class="ri-heart-3-line"></i> {{ $post->likes_count ?? 0 }} Suka
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Form Tulis Balasan --}}
                <div class="mt-6 flex items-start gap-4">
                    <img class="h-10 w-10 rounded-full object-cover"
                        src="{{ Auth::user()->profile_photo_path
                            ? (Str::startsWith(Auth::user()->profile_photo_path, 'http')
                                ? Auth::user()->profile_photo_path
                                : asset('storage/' . Auth::user()->profile_photo_path))
                            : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                        alt="User Avatar">

                    <div class="flex-1">
                        <form action="{{ route('sosial.post.reply', $post->id) }}" method="POST">
                            @csrf
                            <textarea name="message" rows="3" class="w-full bg-white border-transparent rounded-lg shadow-sm focus:ring-primary focus:border-primary text-sm" placeholder="Tulis balasan Anda..."></textarea>
                            <div class="flex justify-end mt-2">
                                <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-primary rounded-lg shadow-sm hover:bg-primary-dark">
                                    Kirim Balasan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Daftar Balasan --}}
                <div class="mt-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">{{ $post->replies->count() }} Balasan</h3>

                    @forelse ($post->replies as $reply)
                        <div class="flex items-start gap-4 mb-6">
                            <img class="h-9 w-9 rounded-full object-cover"
                                src="{{ $reply->user->profile_photo_path
                                    ? (Str::startsWith($reply->user->profile_photo_path, 'http')
                                        ? $reply->user->profile_photo_path
                                        : asset('storage/' . $reply->user->profile_photo_path))
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($reply->user->name) }}"
                                alt="{{ $reply->user->name }}">

                            <div class="w-full">
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <div class="flex items-center justify-between">
                                        <p class="font-semibold text-sm text-gray-800">{{ $reply->user->name }}</p>
                                        <p class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</p>
                                    </div>
                                    <p class="text-sm text-gray-700 mt-2">{{ $reply->message }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-400 text-sm">Belum ada balasan.</p>
                    @endforelse
                </div>

            </main>
        </div>
    </div>
</div>
@endsection
