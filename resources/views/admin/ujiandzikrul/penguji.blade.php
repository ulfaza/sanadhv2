<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>	Dzikrul Ghofilin - Admin</title>

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
			                <h5 class="m-0">Penguji Dzikrul Ghofilin</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('ujian.dzikrul')}}">Ujian Dzikrul</a></li>
			                    <li class="breadcrumb-item active"><a href="{{route('penguji.dzikrul', $tingkat)}}">Penguji Dzikrul</a></li>
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
			                        <h3 class="card-title">Penguji Dzikrul Ghofilin</h3>
			                        <div class="float-right">
			                        	<a href="{{route('import.pengujidzikrul', $tingkat)}}" class="btn btn-sm btn-success"><i class="fas fa-file-excel"></i> Import Penguji</a>
			                        </div>
			                    </div>
			                    <!-- /.card-header -->
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-12">
                                			<div class="table-responsive" >
												@yield('content')
												{{ csrf_field() }}
									            <table id="example1" class="table table-bordered table-striped">
									              <thead>
									                <tr>
									                  <th style="visibility: hidden;" width="0%">id</th>
									                  <th>NO</th>
									                  <th>Kelas</th>
									                  <th>Penguji</th>
									                  <th></th>
									                </tr>
									              </thead>
									              <tbody>
									                @foreach($kelas as $row)
									                <tr>
									                  <td style="visibility: hidden; width: 0px;">{{ $row->k_id }}</td>
									                  <td>{{ $no++ }}</td>
									                  <td>{{ $row->tingkat }} {{ $row->k_nama }}</td>
									                  <td>{{ $row->penguji_dzikrul }}</td>
									                  <td>
														<div class="btn-group">
															<a href="{{route('edit.pengujidzikrul', $row->k_id)}}" class="btn btn-sm btn-success">
																Edit Penguji
															</a>
														</div>
													  </td>
									                </tr>
									                @endforeach
									              </tbody>
									            </table>
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
		<script type="text/javascript">
			$(function () {
			    $("#example1").DataTable({
			      "responsive": false, "lengthChange": false, "autoWidth": false,
			      "buttons": ["excel", "pdf"]
			    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
			});
		</script>
	</body>
</html>