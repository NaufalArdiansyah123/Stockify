@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>
    <p>Halo, {{ Auth::user()->name }}. Anda login sebagai <b>Admin</b>.</p>
</div>
@endsection
