<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Ujian Paper - Guru</title>

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
								<a href="{{route('paper.guru')}}">Ujian Paper</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h4>
								Ujian Paper 
							</h4>
						</div><!-- /.page-header -->
			        	<div class="row">
							<div class="col-xs-12">
								{{ csrf_field() }}
								<table id="simple-table" class="table  table-bordered table-hover">
									<thead>
										<tr>
							                <th>Nama Siswa</th>
							                <th class="detail-col">Nilai</th>
							                <th>Nilai</th>
							                <th>Predikat</th>
						                </tr>
									</thead>

									<tbody>
										@foreach($ujipaper as $row)
										<tr>
											<td>{{ $row->siswa->s_nama }}</td>

											<td class="center">
												<div class="action-buttons">
													<a href="#" class="green bigger-140 show-details-btn" title="Show Details">
														<i class="ace-icon fa fa-angle-double-down"></i>
														<span class="sr-only">Details</span>
													</a>
												</div>
											</td>
											<td>{{ $row->nilai }}</td>
											<td>{{ $row->predikat }}</td>
										</tr>

										<tr class="detail-row">
											<td colspan="8">
												<div class="table-detail">
													<div class="row">
														<div class="col-xs-12 col-sm-3">

															<form action="{{route('update.ujianpaper', $row->p_id)}}" method="post">
											              		{{ csrf_field() }}
											              		<div class="form-group">								
	      															<label for="judul">Judul</label>
																	<textarea id="judul" name="judul" rows="5" cols="40" readonly >{{ $row->judul }}</textarea>
																</div>
																<div class="form-group">								
	      															<label for="pembimbing">Pembimbing</label>
																	<input type="text" class="form-control" id="pembimbing" name="pembimbing" value="{{ $row->pembimbing }}" readonly >
																</div>
										              			<div class="form-group">								
	      															<label for="penguasaan">Penguasaan Materi</label>
																	<input type="number" class="form-control" id="penguasaan" name="penguasaan" value="{{ $row->penguasaan }}" max="40" >
																</div>
										              			<div class="form-group">
										              				<label for="sinkron">Sinkronisasi Antara Judul dan Isi</label>
																	<input type="number" class="form-control" id="sinkron" name="sinkron" value="{{ $row->sinkron }}" max="30" >
																</div>
										              			<div class="form-group">
										              				<label for="penulisan">Metode Penulisan</label>
																	<input type="number" class="form-control" id="penulisan" name="penulisan" value="{{ $row->penulisan }}" max="20" >
																</div>
										              			<div class="form-group">
										              				<label for="adab">Adab</label>
																	<input type="number" class="form-control" id="adab" name="adab" value="{{ $row->adab }}" max="10" >
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
