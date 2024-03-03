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
			                <h5 class="m-0">Rekap Kartu Hijau</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('th_ajar')}}">Tahun Ajaran</a></li>
			                    <li class="breadcrumb-item active">Rekap Kartu Hijau</li>
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
			                        <h3 class="card-title">@foreach($th_ajar as $ta)
										Rekap Kartu Hijau <br> {{ $ta->th_ajaran }} {{ $ta->smt }}
										@endforeach
									</h3>
			                    </div>
			                    <!-- /.card-header -->
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-12">
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