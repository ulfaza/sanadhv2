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
			                    <li class="breadcrumb-item"><a href="{{route('kelas')}}">Kelas</a></li>
			                    <li class="breadcrumb-item">Siswa</li>
			                    <li class="breadcrumb-item active">Tambah Siswa</li>
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
			                        <h3 class="card-title">
			                        	Tambah Siswa
			                        	@foreach($kelas as $k)
	                                	{{ $k->tingkat }} {{ $k->k_nama }}
			                        </h3>
			                    </div>
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-5">
                                			@yield('content')
											<form action="{{route('store.siswa',$k->k_id)}}" method="post" class="form-horizontal" role="form" >
												{{ csrf_field() }}
												<input type="hidden" id="k_id" name="k_id" value="{{ $k->k_id }}">
												<div class="form-group">
													<label>NIS</label>
													<input type="text" id="nis" name="nis" class="form-control" />
												</div>
												<div class="form-group">
													<label>NISN</label>
													<input type="text" id="nisn" name="nisn" class="form-control" />
												</div>
												<div class="form-group">
													<label>Nama</label>
													<input type="text" id="s_nama" name="s_nama" class="form-control" />
												</div>
												<div class="form-group">
													<label>Status</label>
													<select class="form-control" id="status" name="status" data-placeholder="Pilih Status...">
														<option value="MUKIM">MUKIM</option>
														<option value="LAJU">LAJU</option>
													</select>
												</div>
												<div class="form-group">
													<label>Status</label>
													<select class="form-control" id="jenis_kel" name="jenis_kel" data-placeholder="Pilih Jenis Kelamin...">
														<option value="PUTRA">PUTRA</option>
														<option value="PUTRI">PUTRI</option>
													</select>
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Simpan</button>
													<a onclick="return confirm('Perubahan anda belum disimpan. Tetap tinggalkan halaman ini ?')" href="{{route('siswa',$k->k_id)}}" class="btn btn-sm btn-secondary"><i class="fas fa-undo"></i> Cancel</a>
													
												</div>
											</form>
			                            	@endforeach
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