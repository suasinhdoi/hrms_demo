@extends('layouts.backend')

@section('styles')	
<!-- Select2 CSS -->
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}">

<!-- Datatable CSS -->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Nghỉ phép</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Nhân sự</a></li>
			<li class="breadcrumb-item active">Nghỉ phép</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="javascript:void(0)" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Tạo nghỉ phép</a>
	</div>
</div>
@endsection


@section('content')
	
	
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-striped custom-table mb-0 datatable">
					<thead>
						<tr>
							<th>Nhân viên</th>
							<th>Loại phép</th>
							<th>Từ ngày</th>
							<th>Đến ngày</th>
							<th>Số ngày</th>
							<th>Lý do</th>
							<th class="text-center">Trạng thái</th>
							<th class="text-right">Tùy chọn</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($leaves as $leave)
							<tr>
								<td>
									<h2 class="table-avatar">
										<a href="javascript:void(0)" class="avatar avatar-xs">
											<img alt="avatar" src="{{!empty($leave->employee->avatar)? asset('storage/employees/'.$leave->employee->avatar): asset('assets/img/user.jpg')}}">
										</a>
										<a href="#">{{$leave->employee->firstname}} {{$leave->employee->lastname}}</a>
									</h2>
								</td>
								<td>{{$leave->leaveType->type}}</td>
								<td>{{date_format(date_create($leave->from),"d/m/Y")}}</td>
								<td>{{date_format(date_create($leave->to),"d/m/Y")}}</td>
								<td>
									@php
										$start = new DateTime($leave->to);
										$end_date = new DateTime($leave->from);
									@endphp
									{{($start->diff($end_date,"%d")->days).' '. Str::plural('Days',$start->diff($end_date,"%d")->days)}}
								</td>
								<td>{{substr($leave->reason,0,10).' ........'}}</td>
								<td class="text-center">
									<div class="action-label">
										<a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
											@if ($leave->status =='Approved')
											<i class="fa fa-dot-circle-o text-success"></i> Đã duyệt
											@elseif ($leave->status =='Pendding')
											<i class="fa fa-dot-circle-o text-warning"></i> Chưa duyệt
											@else
											<i class="fa fa-dot-circle-o text-danger"></i> Không duyệt
											@endif
										</a>
									</div>
								</td>
								<td class="text-right">
									<div class="dropdown dropdown-action">
										<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a data-id="{{$leave->id}}" data-from="{{$leave->from}}"
												data-to="{{$leave->to}}" data-employee="{{$leave->employee_id}}"
												data-leave_type="{{$leave->leave_type_id}}" data-status="{{$leave->status}}"
												data-reason="{{$leave->reason}}" class="dropdown-item editbtn" href="javascript:void(0)" data-toggle="modal" data-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i> Chỉnh sửa</a>
											<a data-id="{{$leave->id}}" class="dropdown-item deletebtn" href="javascript:void(0)" data-toggle="modal" ><i class="fa fa-trash-o m-r-5"></i> Xóa</a>
										</div>
									</div>
								</td>
							</tr>
						@endforeach	
						<!-- delete Leave Modal -->
						<x-modals.delete :route="'leave.destroy'" :title="'Leave'" />
						<!-- /delete Leave Modal -->					
					</tbody>
				</table>
			</div>
		</div>
	</div>

<!-- Add Leave Modal -->
<div id="add_leave" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tạo nghỉ phép</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{route('employee-leave')}}">
					@csrf

					<div class="form-group">
						<label>Nhân viên</label>
						<select name="employee" class="select">
							@foreach ($employees as $employee)
								<option value="{{$employee->id}}">{{$employee->firstname}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label>Loại phép <span class="text-danger">*</span></label>
						<select name="leave_type" class="select">
							@foreach ($leave_types as $leave_type)
								<option value="{{$leave_type->id}}">{{$leave_type->type}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Từ ngày <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input name="from" class="form-control datetimepicker" type="text">
						</div>
					</div>
					<div class="form-group">
						<label>Đến ngày <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input name="to" class="form-control datetimepicker" type="text">
						</div>
					</div>
					
					<div class="form-group">
						<label>Lý do <span class="text-danger">*</span></label>
						<textarea name="reason" rows="4" class="form-control"></textarea>
					</div>

					<div class="form-group">
                        <label>Trạng thái </label>
                        <select name="status" class="select">
                            <option value="null" disabled selected>Chọn</option>
                            <option value="Approved">Đã duyệt</option>
                            <option value="Pendding">Chưa duyệt</option>
                            <option value="Unapproved">Không duyệt</option>
                        </select>
                    </div>
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Tạo</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add Leave Modal -->

<!-- Edit Leave Modal -->
<div id="edit_leave" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Sửa nghỉ phép</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{route('employee-leave')}}" method="post">
					@csrf
					@method("PUT")
					<input type="hidden" name="id" id="edit_id">
					<div class="form-group">
						<label>Nhân viên<span class="text-danger">*</span></label>
						<select name="employee" class="select2" id="edit_employee">
							@foreach ($employees as $employee)
								<option value="{{$employee->id}}">{{$employee->firstname}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label>Loại phép <span class="text-danger">*</span></label>
						<select name="leave_type" class="select2" id="edit_leave_type">
							@foreach ($leave_types as $leave_type)
								<option value="{{$leave_type->id}}">{{$leave_type->type}}</option>
							@endforeach
						</select>
					</div>
					
					<div class="form-group">
						<label>Từ ngày <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input name="from" class="form-control datetimepicker" type="text" id="edit_from">
						</div>
					</div>
					<div class="form-group">
						<label>Đến ngày <span class="text-danger">*</span></label>
						<div class="cal-icon">
							<input name="to" class="form-control datetimepicker" type="text" id="edit_to">
						</div>
					</div>
					
					<div class="form-group">
						<label>Lý do <span class="text-danger">*</span></label>
						<textarea name="reason" rows="4" class="form-control" id="edit_reason"></textarea>
					</div>
					<div class="form-group">
						<label>Trạng thái </label>
                        <select name="status" class="select2 form-control" id="edit_status">
							<option value="null" disabled selected>Chọn</option>
                            <option value="Approved">Đã duyệt</option>
                            <option value="Pendding">Chưa duyệt</option>
                            <option value="Unapproved">Không duyệt</option>
						</select>
                    </div>
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Cập nhật</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Edit Leave Modal -->
@endsection

@section('scripts')
<!-- Select2 JS -->
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<!-- Datatable JS -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
	$(document).ready(function(){
		$('.editbtn').click(function(){
			var id = $(this).data('id');
			var employee = $(this).data('employee');
			var leave_type = $(this).data('leave_type');
			var status = $(this).data('status');
			var from  = $(this).data('from');
			var to  = $(this).data('to');
			var reason = $(this).data('reason')
			$('#edit_leave').modal('show');
			$('#edit_id').val(id);
			$('#edit_employee').val(employee).trigger('change');
			$('#edit_leave_type').val(leave_type).trigger('change');
			$('#edit_status').val(status).trigger('change');
			$('#edit_from').val(from);
			$('#edit_to').val(to)
			$('#edit_reason').append(reason);
			// check employee select
			$("#edit_employee option").each(function()
			{
				if($(this).val() == employee){
					$(this).attr('selected','selected');
				}
			});
			// check leave type select
			$("#edit_type option").each(function()
			{
				if($(this).val() == leave_type){
					$(this).attr('selected','selected');
				}
			});
			// check status select
			$("#edit_status option").each(function()
			{
				if($(this).val() == status){
					$(this).attr('selected','selected');
				}
			});
		});
	});
</script>
@endsection
