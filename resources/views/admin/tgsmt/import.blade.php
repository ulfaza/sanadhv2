<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Import Keuangan - Admin</title>

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
			                <h5 class="m-0">Import Keuangan</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                    <li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('th_ajar')}}">Tahun Ajaran</a></li>
			                    <li class="breadcrumb-item active">Import Keuangan</li>
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
			                        	@foreach($th_ajar as $ta)
                                		Import Tanggungan <br> {{ $ta->th_ajaran }} {{ $ta->smt }}
                                	</h3>
			                    </div>
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-5">
                                			@yield('content')
			                                <form action="{{ URL::to('/admin/keuangan/semester/importExcel', $ta->ta_id) }}" class="form-horizontal" method="post" enctype="multipart/form-data">  
			                                    <div class="form-group">
			                                    	<input type="file" name="import_file" />
			                                    </div>
												<div class="form-group">
													<button class="btn btn-sm btn-success"><i class="fas fa-save"></i> Import File</button>
												</div>
			                                </form> 
                                		@endforeach 
                                		</div>
                                	</div>
                                </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</section>
		<!-- PAGE CONTENT ENDS -->
		</div>
	</div>
	@include('admin/loadjs')
	</body>
</html>