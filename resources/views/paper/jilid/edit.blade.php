<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Edit Penjilidan - Paper</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		@include('paper/loadcss')

		<!-- inline styles related to this page -->

		
	</head>

	<body class="no-skin">
		@include('paper/header')

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			@include('paper/sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="{{route('paperhome')}}">Home</a>
							</li>
							<li>
								<a href="{{route('index.jilid')}}">Penjilidan</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h4>
								Edit Penjilidan
							</h4>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								@yield('content')
								@foreach($paper as $row)
								<form action="{{route('update.jilid', [$tingkat, $row->p_id])}}" method="post" class="form-horizontal" role="form" >
									{{ csrf_field() }}
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right"> Nama Siswa </label>

										<div class="col-xs-12 col-sm-9">
											<input type="text" id="s_nama" name="s_nama" class="col-xs-10 col-sm-5" value="{{ $row->s_nama }}" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right"> Kelas </label>

										<div class="col-xs-12 col-sm-9">
											<input type="text" id="kelas" name="kelas" class="col-xs-10 col-sm-5" value="{{ $row->tingkat }} {{ $row->k_nama }}" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right"> Judul </label>

										<div class="col-xs-12 col-sm-9">
											<textarea id="judul" name="judul" rows="5" cols="50" >{{ $row->judul }}</textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right"> Pembimbing </label>

										<div class="col-xs-12 col-sm-9">
											<input type="text" id="pembimbing" name="pembimbing" class="col-xs-10 col-sm-5" value="{{ $row->pembimbing }}" readonly />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right"> Tanggal Ujian </label>

										<div class="col-xs-12 col-sm-9">
											<input type="date" id="tgl_ujian" name="tgl_ujian" class="col-xs-10 col-sm-5" value="{{ $row->tgl_ujian }}"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right"> Nilai </label>

										<div class="col-xs-12 col-sm-9">
											<input type="text" id="nilai" name="nilai" class="col-xs-10 col-sm-5" value="{{ $row->nilai }}" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Status Paper</label>

										<div class="col-sm-9">
											<select  id="status_paper" name="status_paper" class="select col-xs-10 col-sm-5">
												<option>{{ $row->status_paper }}</option>
												<option>SETOR BERKAS</option>
												<option>SUDAH UJIAN</option>
												<option>DAFTAR UJIAN</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right"> Tanggal Setor Berkas </label>

										<div class="col-xs-12 col-sm-9">
											<input type="date" id="setor" name="setor" class="col-xs-10 col-sm-5" value="{{ $row->setor }}"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right"> Tanggal Jilid </label>

										<div class="col-xs-12 col-sm-9">
											<input type="date" id="jilid" name="jilid" class="col-xs-10 col-sm-5" value="{{ $row->jilid }}"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Tanggal Ambil </label>

										<div class="col-sm-9">
											<input type="date" id="ambil" name="ambil" value="{{ $row->ambil }}" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right"> Nama Pengambil </label>

										<div class="col-xs-12 col-sm-9">
											<input type="text" id="nama_pengambil" name="nama_pengambil" class="col-xs-10 col-sm-5" value="{{ $row->nama_pengambil }}" />
										</div>
									</div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-primary" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												<a onclick="return confirm('Perubahan anda belum disimpan. Tetap tinggalkan halaman ini ?')" href="{{('/paper/home')}}"> Cancel</a>
											</button>
										</div>
									</div>
								</form>
								@endforeach
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			@include('paper/footer')

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		@include('paper/loadjs')

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			
		</script>
	</body>
</html>
