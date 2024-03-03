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
			                <h5 class="m-0">Ujian Dzikrul Ghofilin</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item active">Ujian Dzikrul Ghofilin</li>
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
			                        <h3 class="card-title">Ujian Dzikrul Ghofilin</h3>
			                    </div>
			                    <!-- /.card-header -->
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-12">
                                			<div class="table-responsive" >
												@yield('content')
												{{ csrf_field() }}
									            <table id="datatable" class="table table-bordered table-striped">
									              <thead>
									                <tr>
									                  <th>NO</th>
									                  <th>Tingkat</th>
									                  <th></th>
									                </tr>
									              </thead>
									              <tbody>
									                @foreach($tingkatan as $row)
									                <tr>
									                  <td>{{ $no++ }}</td>
									                  <td>{{ $row->tingkat }}</td>
									                  <td>
									                  	<div class="margin">
									                  		<div class="btn-group">
																<a href="{{route('penguji.dzikrul', $row->tingkat)}}" class="btn btn-sm btn-success">Edit Penguji</a>
									                  		</div>
									                  		<div class="btn-group">
									                  			<a href="{{route('rekap.dzikrul', $row->tingkat)}}" class="btn btn-sm btn-success">Rekap Nilai</a>
									                  		</div>
									                  		<div class="btn-group">
									                  			<a href="{{route('rekap.pengujidzikrul', $row->tingkat)}}" class="btn btn-sm btn-success">Rekap Penguji</a>
									                  		</div>
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
			$(document).ready(function() {
			    $('#datatable').DataTable();
			} );
		</script>
	</body>
</html>