<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Kelas - Admin</title>

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
			                <h5 class="m-0">Daftar Kelas</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item active">Kelas</li>
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
			                        <h3 class="card-title">Daftar Kelas</h3>
			                        <div class="float-right">
			                        	<a href="{{route('import.wali.kelas')}}" class="btn btn-sm btn-success">
											<i class="fas fa-file-excel"></i> Import Wali Kelas 
										</a>
										<a href="{{route('import.kelas')}}" class="btn btn-sm btn-success">
											<i class="fas fa-file-excel"></i> Import Kelas
										</a>
										<a href="#modal-form" class="btn btn-sm btn-success" data-toggle="modal">
											<i class="fas fa-sort-numeric-up-alt"></i> Naik Kelas 
										</a>
										<a href="{{route('insert.kelas')}}" class="btn btn-sm btn-success">
											<i class="fas fa-plus"></i> Tambah 
										</a>
			                        </div>
			                    </div>
			                    <!-- /.card-header -->
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-12">
                                			<div class="table-responsive" >
												<table id="datatable" class="table  table-bordered table-hover">
													<thead>
														<tr>
															<th style="width: 8%">NO</th>
															<th style="width: 32%">Kelas</th>
															<th style="width: 40%">Wali Kelas</th>
															<th style="width: 20%">Action</th>
														</tr>
													</thead>

													<tbody>
														@foreach($kelas as $k)
														<tr>
															<td>{{ $no++ }}</td>
															<td>{{ $k->tingkat }} {{ $k->k_nama }}</td>
															<td>{{ $k->nama }}</td>
															<td>
																<div class="margin">
																	<div class="btn-group">
																		<a href="{{route('siswa',$k->k_id)}}" class="btn btn-sm btn-info">Siswa</a>
																	</div>
																	<div class="btn-group">
																		<a href="{{route('edit.kelas',$k->k_id)}}" class="btn btn-sm btn-success"><i class="ace-icon fas fa-pen bigger-120"></i></a>
																	</div>
																	<div class="btn-group">
																		<a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{route('delete.kelas',$k->k_id)}}" class="btn btn-sm btn-danger"><i class="ace-icon fas fa-trash bigger-120"></i></a>
																	</div>
																</div>
															</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
											<div class="modal fade" id="modal-form" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
											    <div class="modal-dialog modal-dialog-centered" role="document">
											        <div class="modal-content">
											            <div class="modal-header">
											                <h5 class="modal-title" id="staticModalLabel">Anda yakin akan merubah tingkatan kelas?</h5>
											                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											                    <span aria-hidden="true">&times;</span>
											                </button>
											            </div>
											            <div class="modal-body" align="center">
											            	<form action="{{route('naik.kelas')}}" method="get" class="form-horizontal" role="form" >
												                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Ya</button>
												            	<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
															</form>
											            </div>
											        </div>
											    </div>
											</div>
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