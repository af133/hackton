@extends('layouts.app')

@section('title', 'Live Class')

@section('content')
<div class="h-screen w-screen bg-gray-900 text-white">
    <iframe
        allow="camera; microphone; fullscreen; display-capture"
        src="http://meet.jit.si/{{ $kelasId }}/{{ $room }}"
        class="w-full h-full border-0">
    </iframe>
</div>
@endsection
