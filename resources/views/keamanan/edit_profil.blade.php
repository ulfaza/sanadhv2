<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Edit Profil - Keamanan</title>

		<meta name="description" content="3 styles with inline editable feature" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		@include('keamanan/loadcss')

		<!-- inline styles related to this page -->

	</head>

	<body class="no-skin">
		@include('keamanan/header')

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			@include('keamanan/sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="{{route('keamananhome')}}">Home</a>
							</li>
							<li class="active">User Profile</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h4>
								User Profile Page
							</h4>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div>
									<div id="user-profile-1" class="user-profile row">
										@foreach($users as $row)
										<div class="col-xs-12 col-sm-3 center">
											<div>
												<span class="profile-picture">
													<img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="{{ url('/profile/'.$row->foto) }}"  />
												</span>

												<div class="space-4"></div>

												<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
													<div class="inline position-relative">
														<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
															<i class="ace-icon fa fa-circle light-green"></i>
															&nbsp;
															<span class="white">{{$row->nama}}</span>
														</a>
													</div>
												</div>
											</div>

											<div class="space-6"></div>

											<div class="hr hr16 dotted"></div>
										</div>

										<div class="col-xs-12 col-sm-9">
											@if(count($errors) > 0)
											<div class="alert alert-danger">
												@foreach ($errors->all() as $error)
												{{ $error }} <br/>
												@endforeach
											</div>
											@endif

											<h4 class="header blue bolder smaller">Ganti Foto</h4>

											<form class="form-horizontal" action="{{route('foto.keamanan',$row->id)}}" method="post" enctype="multipart/form-data">
											{{ csrf_field() }}

												<div class="form-group">
													<label class="col-sm-4 control-label no-padding-right" for="foto">Foto</label>

													<div class="col-sm-8">
														<input type="file" id="foto" name="foto">
													</div>
												</div>

												<div class="space-4"></div>

												<div class="form-group" style="text-align: center;">
													<button type="submit" class="btn btn-primary">Simpan</button>

													&nbsp; &nbsp;
													<button class="btn" type="reset">
														<i class="ace-icon fa fa-undo bigger-110"></i>
														Reset
													</button>
												</div>
											</form>

											<div class="space-20"></div> 

											<div class="hr hr2 hr-double"></div>

											<div class="space-20"></div>

											<h4 class="header blue bolder smaller">Ganti Password</h4>

											<form class="form-horizontal" action="{{route('pw.keamanan',$row->id)}}" method="post">
											{{ csrf_field() }}
												<div class="space-10"></div>

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right" for="password">New Password</label>

													<div class="col-sm-9">
														<input type="password" id="password" name="password" />
													</div>
												</div>

												<div class="space-4"></div>

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right" for="password_confirmation">Confirm Password</label>

													<div class="col-sm-9">
														<input type="password" id="password_confirmation" name="password_confirmation" />
													</div>
												</div>

												<div class="space-4"></div>

												<div class="form-group" style="text-align: center;">
													<button type="submit" class="btn btn-primary">Simpan</button>

													&nbsp; &nbsp;
													<button class="btn" type="reset">
														<i class="ace-icon fa fa-undo bigger-110"></i>
														Reset
													</button>
												</div>
											</form>

											<div class="space-6"></div>

										</div>
										@endforeach
									</div>
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			@include('keamanan/footer')

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src=asset('assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="{{ asset('assets/js/jquery-ui.custom.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.ui.touch-punch.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.gritter.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootbox.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.easypiechart.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.hotkeys.index.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-wysiwyg.min.js') }}"></script>
		<script src="{{ asset('assets/js/select2.min.js') }}"></script>
		<script src="{{ asset('assets/js/spinbox.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-editable.min.js') }}"></script>
		<script src="{{ asset('assets/js/ace-editable.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.maskedinput.min.js') }}"></script>

		<!-- ace scripts -->
		<script src="{{ asset('assets/js/ace-elements.min.js') }}"></script>
		<script src="{{ asset('assets/js/ace.min.js') }}"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
	       
	    </script>
	</body>
</html>
