<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Edit Tanggungan Siswa - Perpus</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		@include('perpus/loadcss')

		<!-- inline styles related to this page -->

		
	</head>

	<body class="no-skin">
		@include('perpus/header')

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			@include('perpus/sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="{{route('perpushome')}}">Home</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h4>
								Edit Tanggungan Siswa
							</h4>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								@yield('content')
								@foreach($siswa as $row)
								<form action="{{route('update.tg.siswa', [$tingkat, $row->s_id])}}" method="post" class="form-horizontal" role="form" >
									{{ csrf_field() }}
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Nama Siswa</label>

										<div class="col-sm-9">
											<input type="text" id="s_nama" name="s_nama" value="{{ $row->s_nama }}" readonly="true" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Ketuntasan </label>

										<div class="col-sm-9">
											<select  id="tg_perpus" name="tg_perpus" class="select col-xs-10 col-sm-5">
												<option>{{ $row->tg_perpus }}</option>
												<option>TUNTAS</option>
												<option>TIDAK TUNTAS</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Denda </label>

										<div class="col-sm-9">
											<input type="text" id="denda_perpus" name="denda_perpus" value="{{ $row->denda_perpus }}" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Keterangan </label>

										<div class="col-sm-9">
											<textarea id="ket_perpus" name="ket_perpus" rows="5" cols="50">{{ $row->ket_perpus }}</textarea>
										</div>
									</div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-primary" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												<a onclick="return confirm('Perubahan anda belum disimpan. Tetap tinggalkan halaman ini ?')" href="{{('/perpus/home')}}"> Cancel</a>
											</button>
										</div>
									</div>
								</form>
								@endforeach
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			@include('perpus/footer')

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		@include('perpus/loadjs')

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			
		</script>
	</body>
</html>