<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>
			@foreach($th_ajar as $ta)
				Rekap KH {{ $ta->th_ajaran }} {{ $ta->smt }}
			@endforeach
		</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		@include('admin/loadcss')

		<!-- inline styles related to this page -->
		
	</head>

	<body class="no-skin">
		@include('admin/header')

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			@include('admin/sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="{{route('adminhome')}}">Home</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					

					<div class="page-content">
						<div class="page-header">
							<h4>
								@foreach($th_ajar as $ta)
								Rekap Kartu Hijau <br> {{ $ta->th_ajaran }} {{ $ta->smt }}
								@endforeach <br>
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
												<!-- <th></th> -->
												<th>NIS</th>
												<th>Nama Siswa</th>
												<th>Kelas</th>
												<th>Status</th>
												@foreach($kh as $k)
												<th>{{ $k->singkatan}}</th>
												<th>Ketuntasan</th>
												@endforeach
											</tr>
										</thead>
										<tbody>
											@for ($i = 0; $i < $totaldata; $i++)
										    <tr>
												<td>{{ $no++ }}</td>
												<!-- <td>{{ $rekappersiswa[$i][0]->s_id }}</td> -->
												<td>{{ $rekappersiswa[$i][0]->nis }}</td>
												<td>{{ $rekappersiswa[$i][0]->s_nama }}</td>
												<td>{{ $rekappersiswa[$i][0]->tingkat }} {{ $rekappersiswa[$i][0]->k_nama }}</td>
												<td>{{ $rekappersiswa[$i][0]->status }}</td>
												@for ($j = 0; $j < 4; $j++)
													<td>{{ $rekappersiswa[$i][$j]->total }}</td>
													<td>{{ $rekappersiswa[$i][$j]->kriteria }}</td>
												@endfor
											</tr>
											@endfor
										</tbody>
									</table>
								</div>							
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			@include('admin/footer')

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		@include('admin/loadjs')

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
