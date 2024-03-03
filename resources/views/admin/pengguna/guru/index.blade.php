<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Daftar Akun Guru - Admin</title>

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
			                <h5 class="m-0">Daftar Guru</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item active">Guru</li>
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
			                        <h3 class="card-title">Daftar Guru</h3>
			                        <div class="float-right">
										<a href="{{route('insert.guru')}}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah </a>
			                        	<a href="{{route('import.guru')}}" class="btn btn-sm btn-info"><i class="fas fa-file-excel"></i> Import Excel</a>
			                        </div>
			                    </div>
			                    <!-- /.card-header -->
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-12">
                                			<table id="datatable" class="table  table-bordered table-hover">
                                				<thead>
													<tr>
														<th width="15%">NO</th>
														<th width="20%">Username</th>
														<th width="40%">Nama</th>
														<th width="25%">Action</th>
													</tr>
												</thead>
												<tbody>
													@foreach($guru as $g)
													<tr>
														<td>{{ $no++ }}</td>
														<td>{{ $g->username }}</td>
														<td>{{ $g->nama }}</td>
														<td>
															<div class="margin">
																<div class="btn-group">
																	<a href="{{ route('edit.list.guru', $g->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a>
											                    </div>	
											                    <div class="btn-group">
											                    	<a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{ route('delete.list.guru', $g->id) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
											                    </div>
															</div>
															
														</td>
													</tr>
													@endforeach
												</tbody>
                                			</table>
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