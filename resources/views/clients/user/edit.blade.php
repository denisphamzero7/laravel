@extends('layouts.client')

@section('title')
    {{ $title }}
@endsection
@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <div>
        <div class="py-3">
            <h1 class="text-start">
                {{ $title }}
            </h1>
        </div>
      @if ($errors->any())
      <div class="alert alert-danger">Dữ liệu không hợp lệ</div>

      @endif
       <form action="{{route('users.postEdit')}}" method="post">
            <div class="mb-3">
                <label for="">Họ và tên</label>
                <input type="text" class="form-control" value="{{old('fullname')?? $userDetail->fullname}}" name="fullname" placeholder="Nhập họ và tên">
            @error('fullname')
          <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="text" class="form-control" value="{{old('email')?? $userDetail->email}}" name="email" placeholder="Nhập email">
                 @error('email')
          <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
           <button class="btn btn-primary">Cập nhật người dùng</button>
           <a href="{{route('users.index')}}" class="btn btn-warning">Quay lại</a>
        @csrf
       </form>

    </div>
@endsection
