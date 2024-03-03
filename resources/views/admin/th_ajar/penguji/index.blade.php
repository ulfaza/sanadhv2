<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Penguji KH - Admin</title>

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
			                <h5 class="m-0">Penguji KH</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('th_ajar')}}">Ujian KH</a></li>
			                    <li class="breadcrumb-item active">Penguji KH</li>
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
			                        <h3 class="card-title">
			                        	Penguji Kartu Hijau
										<small>
											@foreach($th_ajar as $ta)
												<h4>{{ $ta->th_ajaran }} &nbsp {{ $ta->smt }}</h4>
											@endforeach
											@foreach($kh as $k)
												<h4>{{ $k->kh_nama }}</h4>
											@endforeach
										</small>
			                        </h3>
			                        <div class="float-right">
										<a href="{{route('import.penguji',[$ta_id,$id_kh])}}" class="btn btn-sm btn-success">
											Import Penguji
										</a>
			                        </div>
			                    </div>
			                    <!-- /.card-header -->
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-12">
                                			<div class="table-responsive" >
												<!-- PAGE CONTENT BEGINS -->
												@yield('content')sm
												{{ csrf_field() }}
												<div class="table-responsive">
										            <table id="datatable" class="table table-bordered table-striped">
										              <thead>
										                <tr>
										                  <th width="20%">Kelas</th>
										                  <th width="30%">Penguji</th>
										                  <th width="20%"></th>
										                </tr>
										              </thead>
										              <tbody>
										                @foreach($ujikh as $row)
										                <tr>
										                  <td>{{ $row->tingkat }} {{ $row->k_nama }} </td>
										                  <td>{{ $row->penguji }} </td>
										                  <td>
										                  	<div class="margin">
										                  		<div class="btn-group">
											                  		<a href="{{ route('edit.ujikh', $row->uji_id) }}" class="btn btn-sm btn-success">
																		Edit Penguji
																	</a>	
										                  		</div>
										                  		<div class="btn-group">
											                  		<a href="{{ route('rekap', $row->uji_id) }}" class="btn btn-sm btn-success">
																		Rekap KH
																	</a>	
										                  		</div>
										                  	</div>
														  </td>
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