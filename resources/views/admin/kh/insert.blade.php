<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Tambah KH - Admin</title>

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
			                <h5 class="m-0">Tambah Kartu Hijau</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('kh')}}">KH</a></li>
			                    <li class="breadcrumb-item active">Tambah KH</li>
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
			                        <h3 class="card-title">Tambah Kartu Hijau</h3>
			                    </div>
			                    <!-- /.card-header -->
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-5">
                                			@yield('content')
											<form action="{{route('store.kh')}}" method="post" class="form-horizontal" role="form" >
												{{ csrf_field() }}
												<div class="form-group">
													<label>Nama Kartu Hijau</label>
													<input type="text" id="kh_nama" name="kh_nama" class="form-control" />
												</div>
												<div class="form-group">
													<label>KKM</label>
													<input type="text" id="kkm" name="kkm" class="form-control" />
												</div>
												<div class="form-group">
													<label>Aspek Penilaian 1</label>
													<input type="text" id="aspek1" name="aspek1" class="form-control" />
												</div>
												<div class="form-group">
													<label>Maksimal Nilai</label>
													<input type="text" id="max_a1" name="max_a1" class="form-control" />
												</div>
												<div class="form-group">
													<label>Aspek Penilaian 2</label>
													<input type="text" id="aspek2" name="aspek2" class="form-control" />
												</div>
												<div class="form-group">
													<label>Maksimal Nilai</label>
													<input type="text" id="max_a2" name="max_a2" class="form-control" />
												</div>
												<div class="form-group">
													<label>Aspek Penilaian 3</label>
													<input type="text" id="aspek3" name="aspek3" class="form-control" />
												</div>
												<div class="form-group">
													<label>Maksimal Nilai</label>
													<input type="text" id="max_a3" name="max_a3" class="form-control" />
												</div>
												<div class="form-group">
													<label>Aspek Penilaian 4</label>
													<input type="text" id="aspek4" name="aspek4" class="form-control" />
												</div>
												<div class="form-group">
													<label>Maksimal Nilai</label>
													<input type="text" id="max_a4" name="max_a4" class="form-control" />
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Simpan</button>
													<a onclick="return confirm('Perubahan anda belum disimpan. Tetap tinggalkan halaman ini ?')" href="{{route('kh')}}" class="btn btn-sm btn-secondary"><i class="fas fa-undo"></i> Cancel</a>
													
												</div>
											</form>
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
	</body>
</html>