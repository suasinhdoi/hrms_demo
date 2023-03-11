@extends('layouts.backend')

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Đổi mật khẩu</h3>
	</div>
</div>
@endsection
@section('content')
<form method="post" action="{{route('change-password')}}">
    @csrf
    <div class="form-group">
        <label>Mật khẩu cũ</label>
        <input name="old_password"type="password" class="form-control">
    </div>
    <div class="form-group">
        <label>Mật khẩu mới</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label>Xác nhận mật khẩu mới</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>
    <div class="submit-section">
        <button class="btn btn-primary submit-btn">Cập nhật</button>
    </div>
</form>
@endsection
