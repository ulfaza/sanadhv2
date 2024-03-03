<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Edit Kelas - Admin</title>

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
			                <h5 class="m-0">Edit Kelas</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('kelas')}}">Siswa</a></li>
			                    <li class="breadcrumb-item active">Edit Kelas</li>
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
			                        <h3 class="card-title">Edit Kelas</h3>
			                    </div>
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-5">
                                			<!-- PAGE CONTENT BEGINS -->
											@yield('content')
											@foreach($kelas as $k)
											<form action="{{route('update.kelas', $k->k_id)}}" method="post" class="form-horizontal" role="form" >
												{{ csrf_field() }}
												<div class="form-group">
													<label>Wali Kelas</label>
													<select  id="wali" name="wali" class="form-control select2" value="{{ $k->nama }}" data-placeholder="Click to Choose...">
														<option value="{{ $k->id }}">{{ $k->nama }}</option>
														@foreach($guru as $g)
														<option value="{{ $g->id }}">{{ $g->nama }}</option>
														@endforeach
													</select>
												</div>
												<div class="form-group">
													<label>Tingkat</label>
													<select class="form-control" id="tingkat" name="tingkat" data-placeholder="Pilih Tingkat...">
														<option>{{ $k->tingkat }}</option>
														<option>10</option>
														<option>11</option>
														<option>12</option>
													</select>
												</div>
												<div class="form-group">
													<label>Nama Kelas</label>
													<input type="text" id="k_nama" name="k_nama" value="{{ $k->k_nama }}" class="form-control" />
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Simpan</button>
													<a onclick="return confirm('Perubahan anda belum disimpan. Tetap tinggalkan halaman ini ?')" href="{{ route('kelas') }}" class="btn btn-sm btn-secondary"><i class="fas fa-undo"></i> Cancel</a>
													
												</div>
											</form>
											@endforeach
											<!-- PAGE CONTENT ENDS -->
                                		</div>
                                	</div>
                                </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</section>
		<!-- PAGE CONTENT ENDS -->
		</div>
	</div>
	@include('admin/loadjs')
	<script type="text/javascript">
		jQuery(function($){
			$('.select2').select2()
		});
	</script>
	</body>
</html>