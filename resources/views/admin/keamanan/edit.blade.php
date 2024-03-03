<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Edit Tanggungan Keamanan Putra - Admin</title>

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
			                <h5 class="m-0">Edit Tanggungan Keamanan Putra </h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('index.aman')}}">Tanggungan Keamanan Putra</a></li>
			                    <li class="breadcrumb-item active">Edit Tanggungan Keamanan Putra</li>
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
			                        <h3 class="card-title">Edit Tanggungan Keamanan Putra</h3>
			                    </div>
			                    <!-- /.card-header -->
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-12">
                                			<div class="table-responsive" >
												<!-- PAGE CONTENT BEGINS -->
												@yield('content')
												@foreach($siswa as $row)
												<form action="{{route('update.aman', [$th_lulus, $row->s_id])}}" method="post" class="form-horizontal" role="form" >
													{{ csrf_field() }}
													<div class="form-group">
														<label>Nama Siswa</label>
														<input type="text" id="s_nama" name="s_nama" value="{{ $row->s_nama }}" readonly="true" class="form-control" />
													</div>
													<div class="form-group">
														<label>Ketuntasan</label>
														<select  id="tg_aman_pa" name="tg_aman_pa" class="select form-control">
															<option>{{ $row->tg_aman_pa }}</option>
															<option>TUNTAS</option>
															<option>TIDAK TUNTAS</option>
														</select>
													</div>
													<div class="form-group">
														<label>Nominal</label>
														<input type="text" id="nominal_aman_pa" name="nominal_aman_pa" value="{{ $row->nominal_aman_pa }}" class="form-control" />
													</div>
													<div class="form-group">
														<label>Keterangan</label>
														<textarea id="ket_aman_pa" name="ket_aman_pa" rows="5" class="form-control" cols="50">{{ $row->ket_aman_pa }}</textarea>
													</div>
													<div class="form-group">
														<button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Simpan</button>
														<a onclick="return confirm('Perubahan anda belum disimpan. Tetap tinggalkan halaman ini ?')" href="{{ route('index.aman') }}" class="btn btn-sm btn-secondary"><i class="fas fa-undo"></i> Cancel</a>
														
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