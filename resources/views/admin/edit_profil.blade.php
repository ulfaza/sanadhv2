<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Profil - Admin</title>

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
			                <h5 class="m-0">Profil</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item active">Profil</li>
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
			                        	Profil
									</h3>
			                    </div>
			                    <!-- /.card-header -->
			                    <div class="card-body">
                        			<div id="user-profile-1" class="user-profile row">
                        				<div class="row">
                        				@foreach($users as $row)
										<div class="col-sm-3 col-12 center">
											<div>
												<span class="profile-picture">
													<img id="avatar" style="width: 100%" class="editable img-responsive" alt="Alex's Avatar" src="{{ url('/profile/'.$row->foto) }}"  />
												</span>
											</div>
											<h4 class="header blue bolder smaller" style="text-align: center;">Ganti Foto</h4>
											<form class="form-horizontal" action="{{route('update.foto',$row->id)}}" method="post" enctype="multipart/form-data">
											{{ csrf_field() }}

												<div class="form-group">
													<label>Foto</label>
													<input type="file" id="foto" name="foto">
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-sm btn-primary">Simpan</button>
													<button class="btn btn-sm btn-secondary" type="reset">
														<i class="ace-icon fa fa-undo bigger-110"></i>
														Reset
													</button>
												</div>
											</form>
										</div>
										<div class="col-sm-6 col-12">
											@if(count($errors) > 0)
											<div class="alert alert-danger">
												@foreach ($errors->all() as $error)
												{{ $error }} <br/>
												@endforeach
											</div>
											@endif

											<h4 class="header blue bolder smaller">Profile</h4>

											<form class="form-horizontal" action="{{route('update.admin',$row->id)}}" method="post">
											{{ csrf_field() }}
												<div class="form-group">
													<label>Username</label>
													<input class="form-control" type="text" id="username" placeholder="Username" name="username" value="{{$row->username}}" readonly="true" />
												</div>
												<div class="form-group">
													<label>Nama</label>
													<input class="form-control" type="text" id="username" placeholder="Nama" name="username" value="{{$row->nama}}" readonly="true" />
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-sm btn-primary">Simpan</button>
													<button class="btn btn-sm btn-secondary" type="reset">
														<i class="ace-icon fa fa-undo bigger-110"></i>
														Reset
													</button>
												</div>
											</form>

											<h4 class="header blue bolder smaller">Ganti Password</h4>

											<form class="form-horizontal" action="{{route('update.pw',$row->id)}}" method="post">
											{{ csrf_field() }}
												<div class="form-group">
													<label>New Password</label>
													<input class="form-control" type="password" id="password" name="password" />
												</div>
												<div class="form-group">
													<label>Confirm Password</label>
													<input class="form-control" type="password" id="password_confirmation" name="password_confirmation" />
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-sm btn-primary">Simpan</button>
													<button class="btn btn-sm btn-secondary" type="reset">
														<i class="ace-icon fa fa-undo bigger-110"></i>
														Reset
													</button>
												</div>
											</form>
										</div>
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