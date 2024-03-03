<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Tanggungan Keuangan {{ $th_lulus }} - Admin</title>

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
			                <h5 class="m-0">Tanggungan Keuangan {{ $th_lulus }} </h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('index.keu')}}">Tanggungan Keuangan</a></li>
			                    <li class="breadcrumb-item active">Tanggungan Keuangan {{ $th_lulus }}</li>
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
			                        <h3 class="card-title">Tanggungan Keuangan {{ $th_lulus }}</h3>
			                        <div class="float-right">
			                        	<a href="{{route('import.keu', $th_lulus)}}" class="btn btn-sm btn-success">Import Tanggungan</a>
			                        </div>
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
															<th style="visibility: hidden;" width="0%">id</th>
															<th width="18%" >nama</th>
															<th width="10%">kelas</th>
															<th width="10%">status</th>
															<th width="10%">ketuntasan</th>
															<th width="10%">nominal</th>
															<th width="30%">keterangan</th>
															<th width="12%"></th>
														</tr>
													</thead>
													<tbody>
														@foreach($tg_keu as $row)
													    <tr>
															<td style="visibility: hidden; width: 0px;">{{ $row->s_id }}</td>
															<td>{{ $row->s_nama }}</td>
															<td>{{ $row->k_nama }}</td>
															<td>{{ $row->status }}</td>
															<td>{{ $row->tg_keuangan }}</td>
															<td>{{ $row->nominal }}</td>
															<td>{{ $row->ket_keuangan }}</td>
															<td>
																<div class="btn-group">
																	<a href="{{route('edit.keu',[$th_lulus, $row->s_id])}}" class="btn btn-sm btn-success">
																		<i class="ace-icon fa fa-pen bigger-120"></i>
																	</a>
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
		      "buttons": ["excel"]
		    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		  });
		</script>
	</body>
</html>