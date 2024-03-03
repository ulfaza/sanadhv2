<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Edit Penguji Kartu Hijau - Admin</title>

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
			                <h5 class="m-0">Edit Penguji Kartu Hijau</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('th_ajar')}}">Ujian KH</a></li>
			                    <li class="breadcrumb-item active">Edit Penguji Kartu Hijau</li>
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
									@foreach($ujikh as $u)
			                        <h3 class="card-title">
			                        	Edit Penguji Kartu Hijau <br>
										{{ $u->tingkat }} {{ $u->k_nama }}	<br>
										{{ $u->th_ajaran }} {{ $u->smt }} <br>
										{{ $u->kh_nama }}
			                        </h3>
			                    </div>
			                    <!-- /.card-header -->
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-6">
                                			<!-- PAGE CONTENT BEGINS -->
											@yield('content')
											<form action="{{ route('update.ujikh', [$u->uji_id,$u->ta_id,$u->kh_nama]) }}" method="post" class="form-horizontal" role="form" >
												{{ csrf_field() }}
												<div class="form-group">
													<label>Penguji</label>
													<select  id="penguji" name="penguji" class="select2" >
														<option>{{ $u->penguji }}</option>
														@foreach($guru as $g)
														<option value="{{ $g->nama }}">{{ $g->nama }}</option>
														@endforeach
													</select>
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Simpan</button>
													<a onclick="return confirm('Perubahan anda belum disimpan. Tetap tinggalkan halaman ini ?')" href="{{ route('th_ajar') }}" class="btn btn-sm btn-secondary"><i class="fas fa-undo"></i> Cancel</a>
													
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
		<!-- PAGE CONTENT BEGINS -->
		@yield('content')
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