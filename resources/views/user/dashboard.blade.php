@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
<div class="container">
    <h1>Selamat datang, {{ Auth::user()->name }}!</h1>
    <p>Ini halaman dashboard user kamu 🎉</p>
</div>
@endsection
