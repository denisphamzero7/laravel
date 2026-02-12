@extends('layouts.app')
@section('content')
<h1>Đây trang admin</h1>
@if(Auth::check())
    <p>Xin chào, {{ $userDetails->name }}</p>
@else
    <p>Bạn chưa đăng nhập</p>
@endif
@endsection
