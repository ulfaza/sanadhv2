<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>
			@foreach($th_ajar as $ta)
				Rekap Penguji KH {{ $ta->th_ajaran }} {{ $ta->smt }}
			@endforeach - Admin
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
			                <h5 class="m-0">Rekap Penguji Kartu Hijau</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('th_ajar')}}">Tahun Ajaran</a></li>
			                    <li class="breadcrumb-item active">Rekap Penguji Kartu Hijau</li>
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
										Rekap Penguji Kartu Hijau <br> {{ $ta->th_ajaran }} {{ $ta->smt }}
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
															<th>Nama Penguji</th>
															<th>Total</th>
														</tr>
													</thead>
													<tbody>
														@foreach($penguji as $row)
													    <tr>
															<td>{{ $no++ }}</td>
															<td>{{ $row->nama_penguji }}</td>
															<td>{{ $row->count }}</td>
														</tr>
														@endforeach
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
		<script type="text/javascript">
			$(document).ready(function() {
			    $('#example1').DataTable();
			} );
		</script>
	</body>
</html>