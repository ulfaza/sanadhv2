<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Rekapitulasi KH - Guru</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		@include('guru/loadcss')

		<!-- inline styles related to this page -->

		
	</head>

	<body class="no-skin">
		@include('guru/header')

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			@include('guru/sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="{{route('guruhome')}}">Home</a>
							</li>
							<li>
								<a href="#">KH</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h4>
								Rekapitulasi Kartu Hijau <br> <br>
								@foreach($ujikh as $u)
								{{ $u->tingkat }} {{ $u->k_nama }}	<br>
								{{ $u->th_ajaran }} {{ $u->smt }} <br>
								{{ $u->kh_nama }}
								@endforeach
								<a style="float: right;" href="{{route('download.kh', $uji_id)}}" class="btn btn-xs btn-success">
									Download
								</a>
							</h4>
						</div><!-- /.page-header -->
			        	<div class="row">
							<div class="col-xs-12">
								{{ csrf_field() }}
								<table id="simple-table" class="table  table-bordered table-hover">
									<thead>
										<tr>
											<th>NIS</th>
							                <th>Nama Siswa</th>
							                <th class="detail-col">Nilai</th>
							                <th>Total</th>
						                </tr>
									</thead>

									<tbody>
										@foreach($rekapkh as $row)
										<tr>
											<td>{{ $row->nis }}</td>
											<td>{{ $row->s_nama }}</td>

											<td class="center">
												<div class="action-buttons">
													<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
														<i class="ace-icon fa fa-angle-double-down"></i>
														<span class="sr-only">Details</span>
													</a>
												</div>
											</td>
											<td>{{ $row->total }}</td>
										</tr>

										<tr class="detail-row">
											<td colspan="8">
												<div class="table-detail">
													<div class="row">
														<div class="col-xs-12 col-sm-3">

															<form action="{{route('edit.rekap',[$row->r_id,$uji_id])}}" method="post">
											              		{{ csrf_field() }}
										              			<div class="form-group">								
	      															<label for="nilai_a1">{{ $aspek1 }} Max:{{ $max_a1 }}</label>
																	<input type="number" class="form-control" id="nilai_a1" name="nilai_a1" value="{{ $row->nilai_a1 }}" max="{{ $max_a1 }}" >
																</div>
										              			<div class="form-group">
										              				<label for="nilai_a2">{{ $aspek2 }} Max:{{ $max_a2 }}</label>
																	<input type="number" class="form-control" id="nilai_a2" name="nilai_a2" value="{{ $row->nilai_a2 }}" max="{{ $max_a2 }}" >
																</div>
										              			<div class="form-group">
										              				<label for="nilai_a3">{{ $aspek3 }} Max:{{ $max_a3 }}</label>
																	<input type="number" class="form-control" id="nilai_a3" name="nilai_a3" value="{{ $row->nilai_a3 }}" max="{{ $max_a3 }}" >
																</div>
										              			<div class="form-group">
										              				<label for="nilai_a4">{{ $aspek4 }} Max:{{ $max_a4 }}</label>
																	<input type="number" class="form-control" id="nilai_a4" name="nilai_a4" value="{{ $row->nilai_a4 }}" max="{{ $max_a4 }}" >
																</div>
										              			<button type="submit" class="btn btn-primary">Simpan</button>
												             </form>
														</div>
													</div>
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div><!-- /.span -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			@include('guru/footer')

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		@include('guru/loadjs')

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
			})
		</script>
	</body>
</html>
