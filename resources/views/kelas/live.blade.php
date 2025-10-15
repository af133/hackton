@extends('layouts.app')

@section('title', 'Live Class')

@section('content')
<div class="h-screen w-screen bg-gray-900 text-white">
    <iframe
        allow="camera; microphone; fullscreen; display-capture"
        src="https://meet.jit.si/{{ $room }}/{{ $kelasId }}/{{ $jenisLive }}"
        class="w-full h-full border-0">
    </iframe>
</div>
@endsection
