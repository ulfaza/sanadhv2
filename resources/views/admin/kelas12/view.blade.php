<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Data Kelas 12 {{ $th_lulus }} - Admin</title>

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
			                <h5 class="m-0">Data Kelas 12 {{ $th_lulus }} </h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('index.kelas12')}}">Data Kelas 12</a></li>
			                    <li class="breadcrumb-item active">Data Kelas 12 {{ $th_lulus }}</li>
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
			                        <h3 class="card-title">Data Kelas 12 {{ $th_lulus }}</h3>
			                    </div>
			                    <!-- /.card-header -->
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-12">
                                			<div class="table-responsive" >
												<!-- PAGE CONTENT BEGINS -->
												@yield('content')
												<table id="example1" class="table  table-bordered table-hover">
													<thead>
														<tr>
															<th>NO</th>
															<th>NIS</th>
															<th>NISN</th>
															<th>Nama Siswa</th>
															<th>Kelas</th>
															<th>No HP</th>
															<th>Email</th>
															<th>Tanggungan Ortu</th>
															<th>Penghasilan Ayah</th>
															<th>Penghasilan Ibu</th>
														</tr>
													</thead>
													<tbody>
														@foreach($kelas12 as $row)
													    <tr>
															<td>{{ $no++ }}</td>
															<td>{{ $row->nis }}</td>
															<td>{{ $row->nisn }}</td>
															<td>{{ $row->s_nama }}</td>
															<td>{{ $row->tingkat }} {{ $row->k_nama }}</td>
															<td>{{ $row->no_hp }}</td>
															<td>{{ $row->email }}</td>
															<td>{{ $row->tg_ortu }}</td>
															<td>{{ $row->penghasilan_ayah }}</td>
															<td>{{ $row->penghasilan_ibu }}</td>
														</tr>
														@endforeach
													</tbody>
												</table>						
												<!-- PAGE CONTENT ENDS -->
											</div>
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