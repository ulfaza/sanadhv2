<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Edit Guru - Admin</title>

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
			                <h5 class="m-0">Edit Guru</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('list.guru')}}">Guru</a></li>
			                    <li class="breadcrumb-item active">Edit Guru</li>
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
			                        <h3 class="card-title">Edit Guru</h3>
			                    </div>
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-5">
                                			@yield('content')
											@foreach($guru as $g)
											<form action="{{ route('update.list.guru', $g->id) }}" method="post" class="form-horizontal" role="form" >
												{{ csrf_field() }}
												<div class="form-group">
												    <label>Nama</label>
												    <input type="text" class="form-control" id="nama" name="nama" value="{{ $g->nama }}" placeholder="Input Nama" />
												</div>
												<div class="form-group">
												    <label>Username</label>
												    <input type="text" class="form-control" id="username" name="username" value="{{ $g->username }}" placeholder="Input Nama" />
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-sm btn-success">Simpan</button>
													<a onclick="return confirm('Perubahan anda belum disimpan. Tetap tinggalkan halaman ini ?')" href="{{ route('list.guru') }}" class="btn btn-sm btn-secondary"> Cancel</a>
													
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
		<!-- PAGE CONTENT ENDS -->
		</div>
	</div>
	@include('admin/loadjs')
	</body>
</html>