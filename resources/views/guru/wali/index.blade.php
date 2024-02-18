<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		@foreach($kelas as $k)
		<title>Kelas - {{ $k->tingkat }} {{ $k->k_nama }}</title>
		@endforeach
		

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		@include('guru/loadcss')

		<!-- inline styles related to this page -->
		
	</head>

	<body class="no-skin">
		@include('guru/header')

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			@include('guru/sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="{{route('guruhome')}}">Home</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h4>
								@foreach($th_ajar as $ta)
								{{ $ta->th_ajaran }} {{ $ta->smt }}
								@endforeach <br>
								@foreach($kelas as $k)
								{{ $k->tingkat }} {{ $k->k_nama }}
								@endforeach
							</h4>
							
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								@yield('content')
								<div class="col-xs-6 col-sm-3 pricing-box">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title bigger lighter">Ceklist Tanggungan</h5>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												<ul class="list-unstyled spaced2">
													<li>
													Rekapitulasi Tanggungan Siswa	
													</li>
												</ul>
											</div>

											<div>
												<a href="{{route('ceklist.kelas', $k_id)}}" class="btn btn-block btn-primary">
													<span>Klik Disini</span>
												</a>
											</div>
										</div>
									</div>
								</div>	

								<div class="col-xs-6 col-sm-3 pricing-box">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title bigger lighter">Ceklist Rapor</h5>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												<ul class="list-unstyled spaced2">
													<li>
													Rekapitulasi Rapor Siswa	
													</li>
												</ul>
											</div>

											<div>
												<a href="{{route('ceklist.rapor', $k_id)}}" class="btn btn-block btn-primary">
													<span>Klik Disini</span>
												</a>
											</div>
										</div>
									</div>
								</div>	

								<div class="col-xs-6 col-sm-3 pricing-box">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title bigger lighter">Rekap KH</h5>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												<ul class="list-unstyled spaced2">
													<li>
													Rekapitulasi Kartu Hijau Siswa
													</li>
												</ul>
											</div>

											<div>
												<a href="{{route('rekap.kelas', $k_id)}}" class="btn btn-block btn-primary">
													<span>Klik Disini</span>
												</a>
											</div>
										</div>
									</div>
								</div>			

								<div class="col-xs-6 col-sm-3 pricing-box">
									<div class="widget-box widget-color-blue">
										<div class="widget-header">
											<h5 class="widget-title bigger lighter">Rekap Paper</h5>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												<ul class="list-unstyled spaced2">
													<li>
													Rekapitulasi Paper Siswa
													</li>
												</ul>
											</div>

											<div>
												<a href="{{route('rekap.paper', $k_id)}}" class="btn btn-block btn-primary">
													<span>Klik Disini</span>
												</a>
											</div>
										</div>
									</div>
								</div>						
								<!-- PAGE CONTENT ENDS -->

							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			@include('guru/footer')

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		@include('guru/loadjs')

		<!-- inline scripts related to this page -->
		<script>
		  $(function () {
		    $("#example1").DataTable({
		      "responsive": false, "lengthChange": false, "autoWidth": false,
		      "buttons": ["excel", "pdf"]
		    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		  });
		</script>
	</body>
</html>
