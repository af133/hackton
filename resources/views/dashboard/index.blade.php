@extends('layouts.app')

@section('title', 'Dashboard - SkillSwap')

@section('content')
<h1>Ini Dashboard</h1>

<form action="{{ route('auth.logout') }}" method="POST">
    @csrf
    <button type="submit">logout</button>
</form>
@endsection
