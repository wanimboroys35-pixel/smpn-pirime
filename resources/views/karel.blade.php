@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="alert alert-warning text-center">
        <h2>⚡ Dashboard Karel</h2>
        <p>Halo, {{ auth()->user()->name }}! Kamu login sebagai <strong>Karel</strong>.</p>
    </div>
</div>
@endsection
