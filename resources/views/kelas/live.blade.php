@extends('layouts.app')

@section('title', 'Live Class')

@section('content')
<div class="h-screen w-screen bg-gray-900 text-white">
    @if($isHost=='guru')
        <div class="absolute top-4 left-4 bg-blue-600 px-3 py-1 rounded">
            <span class="font-semibold">Mode Host</span>
        </div>
    @else
        <div class="absolute top-4 left-4 bg-green-600 px-3 py-1 rounded">
            <span class="font-semibold">Mode Peserta</span>
        </div>
    @endif

    <iframe
        allow="camera; microphone; fullscreen; display-capture"
        src="https://meet.jit.si/{{ $room }}"
        class="w-full h-full border-0">
    </iframe>
</div>
@endsection
