<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
        <title>Dzikrul Ghofilin - Admin</title>

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
                            Import Penguji Dzikrul Ghofilin
                            <h5>Kelas {{ $tingkat }}</h5>
			            </div>
			            <!-- /.col -->
			            <div class="col-sm-6">
			                <ol class="breadcrumb float-sm-right">
			                	<li class="breadcrumb-item"><a href="{{route('adminhome')}}">Home</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('ujian.dzikrul')}}">Ujian Dzikrul</a></li>
			                    <li class="breadcrumb-item"><a href="{{route('penguji.dzikrul', $tingkat)}}">Penguji Dzikrul</a></li>
			                    <li class="breadcrumb-item active">Import Penguji</li>
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
			                        <h3 class="card-title">Import Penguji Dzikrul Ghofilin Kelas {{ $tingkat }}</h3>
			                    </div>
			                    <div class="card-body">
			                    	<div class="row">
                                		<div class="col-sm-5">
                                			@yield('content')
			                                <form action="{{route('excel.pengujidzikrul',$tingkat)}}" class="form-horizontal" method="post" enctype="multipart/form-data">
			                                    {{ csrf_field() }}
			                                    <div class="form-group">
			                                    	<input type="file" name="import_file" />
			                                    </div>
												<div class="form-group">
													<button class="btn btn-sm btn-success"><i class="fas fa-save"></i> Import File</button>
												</div>
			                                </form> 
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