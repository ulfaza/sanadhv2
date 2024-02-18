<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Jenis KH - Admin</title>

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
							<li>
								<a href="#">KH</a>
							</li>
							<li>
								<a href="{{route('kh')}}">Jenis KH</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h4>
								Daftar Kartu Hijau
								<small>
									<a style="float: right;" href="{{ route('insert.kh') }}" class="btn btn-xs btn-info">
										Tambah 
									</a>
								</small>
							</h4>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								@yield('content')
								{{ csrf_field() }}
								<div class="table-responsive">
					            <table id="editable" class="table table-bordered table-striped">
					              <thead>
					                <tr>
					                  <th>ID</th>
					                  <th>Nama KH</th>
					                  <th>KKM</th>
					                  <th>Aspek Penilaian 1</th>
					                  <th>Maksimum Nilai</th>
					                  <th>Aspek Penilaian 2</th>
					                  <th>Maksimum Nilai</th>
					                  <th>Aspek Penilaian 3</th>
					                  <th>Maksimum Nilai</th>
					                  <th>Aspek Penilaian 4</th>
					                  <th>Maksimum Nilai</th>
					                </tr>
					              </thead>
					              <tbody>
					                @foreach($jeniskh as $row)
					                <tr>
					                  <td>{{ $row->kh_id }}</td>
					                  <td>{{ $row->kh_nama }}</td>
					                  <td>{{ $row->kkm }}</td>
					                  <td>{{ $row->aspek1 }}</td>
					                  <td>{{ $row->max_a1 }}</td>
					                  <td>{{ $row->aspek2 }}</td>
					                  <td>{{ $row->max_a2 }}</td>
					                  <td>{{ $row->aspek3 }}</td>
					                  <td>{{ $row->max_a3 }}</td>
					                  <td>{{ $row->aspek4 }}</td>
					                  <td>{{ $row->max_a4 }}</td>
					                </tr>
					                @endforeach
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
		<script type="text/javascript">
		$(document).ready(function(){

		  $.ajaxSetup({
		    headers:{
		      'X-CSRF-Token' : $("input[name=_token]").val()
		    }
		  });

		  $('#editable').Tabledit({
		    url:'{{ route("action.kh") }}',
		    hideIdentifier: true,
		    dataType:"json",
		    columns:{
		      identifier:[0, 'kh_id'],
		      editable:[[1, 'kh_nama'],[2, 'kkm'],[3, 'aspek1'],[4, 'max_a1'],[5, 'aspek2'],[6, 'max_a2'],[7, 'aspek3'],[8, 'max_a3'],[9, 'aspek4'],[10, 'max_a4']]
		    },
		    deleteButton:true,
		    restoreButton:false,
		    onSuccess:function(data, textStatus, jqXHR)
		    {
		      if(data.action == 'delete')
		      {
		        $('#'+data.kh_id).remove();
		      }
		    }
		  });
		});  
		</script>
	</body>
</html>
