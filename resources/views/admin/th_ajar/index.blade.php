<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Tahun Ajaran - Admin</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		@include('admin/loadcss')
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		
		@include('admin/header')
		@include('admin/sidebar')
		<div class="content-wrapper">
			<div class="content-header">
			    <div class="container-fluid">
			        <div class="row mb-2">
			            <div class="col-sm-6">
			                <h5 class="m-0">Tahun Ajaran</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item active">Tahun Ajaran</li>
			                </ol>
			            </div>
			            <!-- /.col -->
			        </div>
			        <!-- /.row -->
			    </div>
			    <!-- /.container-fluid -->
			</div>
			<section class="content">
			    <div class="container-fluid">
			        <div class="row">
			            <div class="col-12">
			                <div class="card">
			                    <div class="card-header">
			                        <h3 class="card-title">Tahun Ajaran</h3>
			                        <div class="float-right">
			                        	<a href="{{ route('insert.th_ajar') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Tambah</a>
			                        </div>
			                    </div>
			                    <!-- /.card-header -->
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-12">
                                			<!-- PAGE CONTENT BEGINS -->
											@yield('content')
											{{ csrf_field() }}
											<div class="table-responsive">
									            <table id="datatable" class="table table-bordered table-striped">
									              <thead>
									                <tr>
									                  <th>NO</th>
									                  <th>Tahun Ajaran</th>
									                  <th>Semester</th>
									                  <th>Status</th>
									                  <th style="text-align: center">Penguji KH</th>
									                  <th>Action</th>
									                </tr>
									              </thead>
									              <tbody>
									                @foreach($th_ajar as $row)
									                <tr>
									                  <td>{{ $no++ }}</td>
									                  <td>{{ $row->th_ajaran }}</td>
									                  <td>{{ $row->smt }}</td>
									                  <td>{{ $row->status }}</td>
									                  <td>
									                  	<div class="margin">
									                  	@foreach($uji as $u)
									                  		@if (($row->th_ajaran == $u->th_ajaran)&&($row->smt == $u->smt))
									                  		<div class="btn-group" style="padding: 5px 0px;">
										                  		<a href="{{route('ujikh',[$u->kh_nama,$row->ta_id])}}" class="btn btn-sm btn-success">
																	{{ $u->kh_nama }} 
																</a>	
									                  		</div>
															@endif
														@endforeach	
									                  	</div>
									                  </td>
									                  <td>
									                  	<div class="margin">
										                  	<div class="btn-group" style="padding: 5px 0px;">
																<a href="{{route('rekapan',$row->ta_id)}}" class="btn btn-sm btn-success">
																	Rekap KH
																</a>
															</div>	
															<div class="btn-group" style="padding: 5px 0px;">
																<a href="{{route('rekap.penguji',$row->ta_id)}}" class="btn btn-sm btn-success">
																	Rekap Penguji
																</a>
															</div>
															<div class="btn-group" style="padding: 5px 0px;">
																<a href="{{route('tanggungan',$row->ta_id)}}" class="btn btn-sm btn-success">
																	Rekap Ceklist
																</a>
															</div>
															<div class="btn-group" style="padding: 5px 0px;">
																<a href="{{route('edit.th_ajar',$row->ta_id)}}" class="btn btn-sm btn-success">
																	<i class="ace-icon fa fa-pen bigger-120"></i>
																</a>
															</div>
															<div class="btn-group" style="padding: 5px 0px;">
																<a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{route('delete.th_ajar',$row->ta_id)}}" class="btn btn-sm btn-danger">
																	<i class="ace-icon fa fa-trash bigger-120"></i>
																</a>
															</div>
									                  	</div>
														
													  </td>
									                </tr>
									                @endforeach
									              </tbody>
									            </table>
								        	</div>
											<!-- PAGE CONTENT ENDS -->
                                		</div>
                                	</div>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</section>
		<!-- PAGE CONTENT BEGINS -->
		@yield('content')
		<!-- PAGE CONTENT ENDS -->
		</div>
	</div>
	@include('admin/loadjs')
	<!-- inline scripts related to this page -->
		<script type="text/javascript">
			$(document).ready(function() {
			    $('#datatable').DataTable();
			} );
		</script>
	</body>
</html>