@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>
    
@endsection
