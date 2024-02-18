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
								Rekap Kartu Hijau<br> {{ $ta->th_ajaran }} {{ $ta->smt }}
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
								<div class="table-responsive" >
									<table id="example1" class="table  table-bordered table-hover">
										<thead>
											<tr>
												<th>NO</th>
												<th>NIS</th>
												<th>Nama Siswa</th>
												<th>Status</th>
												@foreach($kh as $k)
												<th>{{ $k->kh_nama }}</th>
												<th>Ketuntasan</th>
												@endforeach
											</tr>
										</thead>
										<tbody>
											@foreach($siswa as $row)
											<tr>
												<td>{{ $no++ }}</td>
												<td>{{ $row->nis }}</td>
												<td>{{ $row->s_nama }}</td>
												<td>{{ $row->status }}</td>
												@foreach($rekapkh as $r)
													@if ($row->s_nama == $r->s_nama)
													<td>{{ $r->total }}</td>
													<td>{{ $r->kriteria }}</td>
													@endif
												@endforeach
											</tr>
											@endforeach
										</tbody>
									</table>
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
