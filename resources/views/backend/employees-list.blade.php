@extends('layouts.backend')

@section('styles')	
<!-- Datatable CSS -->
<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Danh sách nhân viên</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Nhân Sự</a></li>
			<li class="breadcrumb-item active">Danh sách</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="javascript:void(0)" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Thêm nhân viên</a>
		<!-- <div class="view-icons">
			<a href="{{route('employees')}}" class="grid-view btn btn-link {{route_is(['employees','employees-list']) ? 'active' : ''}}"><i class="fa fa-th"></i></a>
			<a href="{{route('employees-list')}}" class="list-view btn btn-link {{route_is(['employees','employees-list']) ? 'active' : '' }}"><i class="fa fa-bars"></i></a>
		</div> -->
	</div>
</div>
@endsection

@section('content')


<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table datatable">
				<thead>
					<tr>
						<th>Tên nhân viên</th>
						<th>Mã nhân viên</th>
						<th>Email</th>
						<th>Điện thoại</th>
						<th class="text-nowrap">Ngày vào làm</th>
						<th>Chức danh</th>
						<th class="text-right no-sort">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($employees as $employee)
					<tr>
						<td>
							<h2 class="table-avatar">
								<a href="javascript:void(0)" class="avatar"><img alt="avatar" src="@if(!empty($employee->avatar)) {{asset('storage/employees/'.$employee->avatar)}} @else assets/img/profiles/default.jpg @endif"></a>
								<a href="javascript:void(0)">{{$employee->firstname}} {{$employee->lastname}}</a>
							</h2>
						</td>
						<td>{{$employee->uuid}}</td>
						<td>{{$employee->email}}</td>
						<td>{{$employee->phone}}</td>
						<td>{{date_format(date_create($employee->date_created),"d M,Y")}}</td>
						<td>
							{{$employee->designation->name}}
						</td>
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="javascript:void(0)" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a data-id="{{$employee->id}}" data-firstname="{{$employee->firstname}}" data-lastname="{{$employee->lastname}}" data-email="{{$employee->email}}" data-phone="{{$employee->phone}}" data-avatar="{{$employee->avatar}}" data-company="{{$employee->company}}" data-designation="{{$employee->designation}}" data-department="{{$employee->department}}" class="dropdown-item editbtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Chỉnh sửa</a>
									<a data-id="{{$employee->id}}" class="dropdown-item deletebtn" href="javascript:void(0)" data-toggle="modal" ><i class="fa fa-trash-o m-r-5"></i> Xóa</a>
								</div>
							</div>
						</td>
					</tr>
					@endforeach
					<x-modals.delete :route="'employee.destroy'" :title="'Employee'" />
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Add Employee Modal -->
<div id="add_employee" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Thêm nhân viên</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{route('employee.add')}}" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Tên nhân viên <span class="text-danger">*</span></label>
								<input class="form-control" name="firstname" type="text">
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Email <span class="text-danger">*</span></label>
								<input class="form-control" name="email" type="email">
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Điện thoại </label>
								<input class="form-control" name="phone" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Phòng ban <span class="text-danger">*</span></label>
								<select name="department" class="select">
									<option>Chọn</option>
									@foreach ($departments as $department)
										<option value="{{$department->id}}">{{$department->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Chức danh <span class="text-danger">*</span></label>
								<select name="designation" class="select">
									<option>Chọn</option>
									@foreach ($designations as $designation)
										<option value="{{$designation->id}}">{{$designation->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<!-- <div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Hình nhân viên<span class="text-danger"></span></label>
								<input class="form-control floating" name="avatar" type="file">
							</div>
						</div> -->
					</div>
					
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Lưu</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add Employee Modal -->

<!-- Edit Employee Modal -->
<div id="edit_employee" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Chỉnh sửa nhân viên</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{route('employee.update')}}" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="row">
						<input type="hidden" name="id" id="edit_id">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">First Name <span class="text-danger">*</span></label>
								<input class="form-control edit_firstname" name="firstname" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Email <span class="text-danger">*</span></label>
								<input class="form-control edit_email" name="email" type="email">
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-form-label">Phone </label>
								<input class="form-control edit_phone" name="phone" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Department <span class="text-danger">*</span></label>
								<select name="department" class="select edit_department">
									@foreach ($departments as $department)
										<option value="{{$department->id}}">{{$department->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Designation <span class="text-danger">*</span></label>
								<select name="designation" class="select edit_designation">
									@foreach ($designations as $designation)
										<option value="{{$designation->id}}">{{$designation->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Cập nhật</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Edit Employee Modal -->
@endsection

@section('scripts')
<!-- Datatable JS -->
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
<script>
	$(document).ready(function (){
		$('.editbtn').on('click',function (){
			$('#edit_employee').modal('show');
			var id = $(this).data('id');
			var firstname = $(this).data('firstname');
			var lastname = $(this).data('lastname');
			var email = $(this).data('email');
			var phone = $(this).data('phone');
			var avatar = $(this).data('avatar');
			var company = $(this).data('company');
			var designation = $(this).data('designation');
			var department = $(this).data('department');

			$('#edit_id').val(id);
			$('.edit_firstname').val(firstname);
			$('.edit_lastname').val(lastname);
			$('.edit_email').val(email);
			$('.edit_phone').val(phone);
			$('.edit_company').val(company);
			$('.edit_designation').val(designation);
			$('.edit_department').val(department);
			$('.edit_avatar').val(avatar);
		})
	})
</script>
@endsection
