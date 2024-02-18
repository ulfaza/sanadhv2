<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Edit Gelombang - Paper</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		@include('paper/loadcss')

		<!-- inline styles related to this page -->

		
	</head>

	<body class="no-skin">
		@include('paper/header')

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			@include('paper/sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="{{route('paperhome')}}">Home</a>
							</li>
							<li>
								<a href="{{route('index.ujian')}}">Ujian</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h4>
								Edit Gelombang
							</h4>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								@yield('content')
								@foreach($gelombang as $row)
								<form action="{{route('update.gel', [$th_ajaran, $row->up_id, $row->tgl] )}}" method="post" class="form-horizontal" role="form" >
									{{ csrf_field() }}
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right"> Gelombang </label>

										<div class="col-xs-12 col-sm-9">
											<input type="number" id="gel" name="gel" class="col-xs-10 col-sm-5" value="{{ $row->gel }}" min="1" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Tanggal </label>

										<div class="col-sm-9">
											<input type="date" id="tgl" name="tgl" value="{{ $row->tgl }}" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Status </label>

										<div class="col-sm-9">
											<select  id="status" name="status" class="select col-xs-10 col-sm-5">
												<option>{{ $row->status_ujian }}</option>
												<option>AKTIF</option>
												<option>NONAKTIF</option>
											</select>
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
												<a onclick="return confirm('Perubahan anda belum disimpan. Tetap tinggalkan halaman ini ?')" href="{{('/paper/home')}}"> Cancel</a>
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

			@include('paper/footer')

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		@include('paper/loadjs')

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			
		</script>
	</body>
</html>
