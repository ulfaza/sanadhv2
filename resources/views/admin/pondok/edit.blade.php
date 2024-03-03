<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Edit Tanggungan Pondok - Admin</title>

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
			                <h5 class="m-0">Edit Tanggungan Pondok</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('index.pondok')}}">Tanggungan Pondok</a></li>
			                    <li class="breadcrumb-item active">Edit Tanggungan Pondok</li>
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
			                        <h3 class="card-title">Edit Tanggungan Pondok</h3>
			                    </div>
			                    <!-- /.card-header -->
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-6">
                                			<!-- PAGE CONTENT BEGINS -->
											@yield('content')
											@foreach($siswa as $row)
											<form action="{{route('update.pondok', [$th_lulus, $row->s_id])}}" method="post" class="form-horizontal" role="form" >
												{{ csrf_field() }}
												<div class="form-group">
													<label>Nama Siswa</label>
													<input type="text" id="s_nama" name="s_nama" value="{{ $row->s_nama }}" readonly="true" class="form-control" />
												</div>
												<div class="form-group">
													<label>Ketuntasan</label>
													<select  id="tg_pondok" name="tg_pondok" class="select form-control">
														<option>{{ $row->tg_pondok }}</option>
														<option>TUNTAS</option>
														<option>TIDAK TUNTAS</option>
													</select>
												</div>

												<div class="form-group">
													<label>Nominal</label>
													<input type="text" id="nominal_pondok" name="nominal_pondok" value="{{ $row->nominal_pondok }}" class="form-control" />
												</div>
												
												<div class="form-group">
													<label>Keterangan</label>
													<textarea class="form-control" id="ket_pondok" name="ket_pondok" rows="5" cols="50">{{ $row->ket_pondok }}</textarea>
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Simpan</button>
													<a onclick="return confirm('Perubahan anda belum disimpan. Tetap tinggalkan halaman ini ?')" href="{{ route('index.pondok') }}" class="btn btn-sm btn-secondary"><i class="fas fa-undo"></i> Cancel</a>
													
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
	</body>
</html>