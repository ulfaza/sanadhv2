<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Tanggungan Ijazah - Siswa</title>

		<meta name="description" content="3 styles with inline editable feature" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		@include('siswa/loadcss')

		<!-- inline styles related to this page -->

	</head>

	<body class="no-skin">
		@include('siswa/header')

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			@include('siswa/sidebar')

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h4>
								Tanggungan Ijazah
							</h4>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div>
									<div id="user-profile-1" class="user-profile row">
										@foreach($siswa as $row)
										<div class="col-xs-12 col-sm-3 center">
											<div>
												<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
													<div class="inline position-relative">
														<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
															<span class="white">{{$row->s_nama}}</span>
														</a>
													</div>
												</div>
											</div>

											<div class="hr hr16 dotted"></div>

											@if($row->status_ijazah=="DITANGGUHKAN") 
											<div class="infobox-container">
												<div class="infobox infobox-blue">
													<div class="infobox-icon">
														<i class="ace-icon fa fa-comments"></i>
													</div>

													<div class="infobox-data">
														<span class="infobox-data-number">Status Ijazah</span>
														<div class="infobox-content">{{$row->status_ijazah}}</div>
													</div>
												</div>

												<!-- <div class="hr hr16 dotted"></div> 

												<div class="">
													<textarea rows="5" cols="35" readonly="true">Mohon Maaf, Anda tidak diberi akses untuk melihat data tanggungan ijazah. Silahkan menghubungi Ust. Surip (+62 813-3159-9131). Sekian terima kasih.</textarea>
												</div>

												<div class="hr hr16 dotted"></div> -->
											</div>
											@elseif($row->status_ijazah=="BELUM ADA")
											<div class=" infobox-container">
												<div class="infobox infobox-blue">
													<div class="infobox-icon">
														<i class="ace-icon fa fa-comments"></i>
													</div>

													<div class="infobox-data">
														<span class="infobox-data-number">Status Ijazah</span>
														<div class="infobox-content">{{$row->status_ijazah}}</div>
													</div>
												</div>

												<div class="hr hr16 dotted"></div> 

												<div class="">
													<textarea rows="6" cols="35" readonly="true">Mohon Maaf, ijazah  belum dapat diambil karena blanko ijazah atas nama Anda belum datang dari pusat. Informasi lebih lanjut silahkan menghubungi Ust. Sujari (+62 815-1560-2287). Sekian terima kasih.</textarea>
												</div>

												<div class="hr hr16 dotted"></div> 

											</div> 
											@elseif($row->ketuntasan_ijazah=="TUNTAS")    
											<div class=" infobox-container">
												<div class="infobox infobox-green">
													<div class="infobox-icon">
														<i class="ace-icon fa fa-comments"></i>
													</div>

													<div class="infobox-data">
														<span class="infobox-data-number">Tanggungan</span>
														<div class="infobox-content">{{$row->ketuntasan_ijazah}}</div>
													</div>
												</div>

												<div class="infobox infobox-blue">
													<div class="infobox-icon">
														<i class="ace-icon fa fa-comments"></i>
													</div>

													<div class="infobox-data">
														<span class="infobox-data-number">Status Ijazah</span>
														<div class="infobox-content">{{$row->status_ijazah}}</div>
													</div>
												</div>

												<div class="hr hr16 dotted"></div> 
											</div>
											@endif
										</div>

										<div class="col-xs-12 col-sm-9">
											@if(count($errors) > 0)
											<div class="alert alert-danger">
												@foreach ($errors->all() as $error)
												{{ $error }} <br/>
												@endforeach
											</div>
											@endif

											@if($row->status_ijazah=="DITANGGUHKAN" or $row->ketuntasan_ijazah=="TUNTAS")
											@else
												<form class="form-horizontal" action="{{route('tg.siswa',$row->s_id)}}" method="post" enctype="multipart/form-data">
												{{ csrf_field() }}

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right">Tanggungan Keuangan</label>

														<div class="col-sm-9">
															<input type="text" id="tg_keuangan" name="tg_keuangan" value="{{ $row->tg_keuangan }}" readonly="true" class="col-xs-10 col-sm-5" />
														</div>
													</div>
													@if($row->tg_keuangan=="LUNAS")
													@else
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right">Nominal</label>

														<div class="col-sm-9">
															<input type="text" id="nominal" name="nominal" value="{{ $row->nominal}}" readonly="true" class="col-xs-10 col-sm-5" readonly="true" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Keterangan Keuangan</label>

														<div class="col-sm-9">
															<textarea id="ket_keuangan" name="ket_keuangan" rows="7" cols="35" readonly="true">{{ $row->ket_keuangan }}</textarea>
														</div>
													</div>
													@endif

													<div class="space-15"></div> 
													<div class="hr hr2 hr-double"></div>
													<div class="space-20"></div> 

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right">Tanggungan Asesmen</label>

														<div class="col-sm-9">
															<input type="text" id="tg_ujian" name="tg_ujian" value="{{ $row->tg_ujian }}" readonly="true" class="col-xs-10 col-sm-5" />
														</div>
													</div>

													@if($row->tg_ujian=="TUNTAS")
													@else
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Keterangan Asesmen</label>

														<div class="col-sm-9">
															<textarea id="ket_ujian" name="ket_ujian" rows="7" cols="35" readonly="true">{{ $row->ket_ujian }}</textarea>
														</div>
													</div>
													@endif

													<div class="space-15"></div> 
													<div class="hr hr2 hr-double"></div>
													<div class="space-20"></div> 

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right">Tanggungan Paper</label>

														<div class="col-sm-9">
															<input type="text" id="tg_paper" name="tg_paper" value="{{ $row->tg_paper }}" readonly="true" class="col-xs-10 col-sm-5" />
														</div>
													</div>

													@if($row->tg_paper=="TUNTAS")
													@else
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Keterangan Paper</label>

														<div class="col-sm-9">
															<textarea id="ket_paper" name="ket_paper" rows="7" cols="35" readonly="true">{{ $row->ket_paper }}</textarea>
														</div>
													</div>
													@endif

													<div class="space-15"></div> 
													<div class="hr hr2 hr-double"></div>
													<div class="space-20"></div> 

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right">Tanggungan Dzikrul Ghofilin</label>

														<div class="col-sm-9">
															<input type="text" id="tg_dzikrul" name="tg_dzikrul" value="{{ $row->tg_dzikrul }}" readonly="true" class="col-xs-10 col-sm-5" />
														</div>
													</div>

													<div class="space-15"></div> 
													<div class="hr hr2 hr-double"></div>
													<div class="space-20"></div> 

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right">Tanggungan Perpustakaan</label>

														<div class="col-sm-9">
															<input type="text" id="tg_perpus" name="tg_perpus" value="{{ $row->tg_perpus }}" readonly="true" class="col-xs-10 col-sm-5" />
														</div>
													</div>

													@if($row->tg_perpus=="TUNTAS")
													@elseif($row->bukti_perpus!=NULL)
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right">Denda</label>

														<div class="col-sm-9">
															<input type="text" id="denda_perpus" name="denda_perpus" value="{{ $row->denda_perpus }}" readonly="true" class="col-xs-10 col-sm-5" readonly="true" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Keterangan Perpustakaan</label>

														<div class="col-sm-9">
															<textarea id="ket_perpus" name="ket_perpus" rows="7" cols="35" readonly="true">{{ $row->ket_perpus }}</textarea>
														</div>
													</div>

													<div class="form-group">
														<div class="col-sm-2 no-padding-right">
															
														</div>
														<div class="infobox infobox-blue col-sm-9">
															<div class="infobox-icon">
																<i class="ace-icon fa fa-comments"></i>
															</div>

															<div class="infobox-data">
																<span class="infobox-data-number">Bukti</span>
																<div class="infobox-content">Sedang Diverifikasi</div>
															</div>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="file_perpus">Upload Ulang Bukti Perpustakaan</label>

														<div class="col-sm-9">
															<input type="file" id="file_perpus" name="file_perpus">
														</div>
													</div>
													@else
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right">Denda</label>

														<div class="col-sm-9">
															<input type="text" id="denda_perpus" name="denda_perpus" value="{{ $row->denda_perpus }}" readonly="true" class="col-xs-10 col-sm-5" readonly="true" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Keterangan Perpustakaan</label>

														<div class="col-sm-9">
															<textarea id="ket_perpus" name="ket_perpus" rows="7" cols="35" readonly="true">{{ $row->ket_perpus }}</textarea>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="file_perpus">Scan Bukti Tuntas Tanggungan Perpustakaan</label>

														<div class="col-sm-9">
															<input type="file" id="file_perpus" name="file_perpus">
														</div>
													</div>
													@endif

													<div class="space-15"></div> 
													<div class="hr hr2 hr-double"></div>
													<div class="space-20"></div> 

													@if($row->jenis_kel=="PUTRA")
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right">Tanggungan Keamanan Putra</label>

														<div class="col-sm-9">
															<input type="text" id="tg_aman_pa" name="tg_aman_pa" value="{{ $row->tg_aman_pa }}" readonly="true" class="col-xs-10 col-sm-5" />
														</div>
													</div>

														@if($row->tg_aman_pa=="TUNTAS")
														@elseif($row->bukti_aman_pa!=NULL)
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right">Nominal</label>

															<div class="col-sm-9">
																<input type="text" id="nominal_aman_pa" name="nominal_aman_pa" value="{{ $row->nominal_aman_pa }}" readonly="true" class="col-xs-10 col-sm-5" readonly="true" />
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right"> Keterangan Keamanan Putra</label>

															<div class="col-sm-9">
																<textarea id="ket_aman_pa" name="ket_aman_pa" rows="7" cols="35" readonly="true">{{ $row->ket_aman_pa }}</textarea>
															</div>
														</div>

														<div class="form-group">
															<div class="col-sm-2 no-padding-right">
																
															</div>
															<div class="infobox infobox-blue col-sm-9">
																<div class="infobox-icon">
																	<i class="ace-icon fa fa-comments"></i>
																</div>

																<div class="infobox-data">
																	<span class="infobox-data-number">Bukti</span>
																	<div class="infobox-content">Sedang Diverifikasi</div>
																</div>
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right" for="file_keamanan">Upload Ulang Bukti Keamanan Putra</label>

															<div class="col-sm-9">
																<input type="file" id="file_keamanan" name="file_keamanan">
															</div>
														</div>
														@else
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right">Nominal</label>

															<div class="col-sm-9">
																<input type="text" id="nominal_aman_pa" name="nominal_aman_pa" value="{{ $row->nominal_aman_pa }}" readonly="true" class="col-xs-10 col-sm-5" readonly="true" />
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right"> Keterangan Keamanan Putra</label>

															<div class="col-sm-9">
																<textarea id="ket_aman_pa" name="ket_aman_pa" rows="7" cols="35" readonly="true">{{ $row->ket_aman_pa }}</textarea>
															</div>
														</div>
														
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right" for="file_keamanan">Scan Bukti Tuntas Tanggungan Keamanan Putra</label>

															<div class="col-sm-9">
																<input type="file" id="file_keamanan" name="file_keamanan">
															</div>
														</div>
														@endif
													@endif

													<div class="space-15"></div> 
													<div class="hr hr2 hr-double"></div>
													<div class="space-20"></div> 

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right">Tanggungan Pondok</label>

														<div class="col-sm-9">
															<input type="text" id="tg_pondok" name="tg_pondok" value="{{ $row->tg_pondok }}" readonly="true" class="col-xs-10 col-sm-5" />
														</div>
													</div>

													@if($row->tg_pondok=="TUNTAS")
													@elseif($row->bukti_pondok!=NULL)
														@if($row->jenis_kel=="PUTRA")
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right">Nominal</label>

															<div class="col-sm-9">
																<input type="text" id="nominal_pondok" name="nominal_pondok" value="{{ $row->nominal_pondok }}" readonly="true" class="col-xs-10 col-sm-5" readonly="true" />
															</div>
														</div>
														@endif
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right"> Keterangan Pondok</label>

															<div class="col-sm-9">
																<textarea id="ket_pondok" name="ket_pondok" rows="7" cols="35" readonly="true">{{ $row->ket_pondok }}</textarea>
															</div>
														</div>

														<div class="form-group">
															<div class="col-sm-2 no-padding-right">
																
															</div>
															<div class="infobox infobox-blue col-sm-9">
																<div class="infobox-icon">
																	<i class="ace-icon fa fa-comments"></i>
																</div>

																<div class="infobox-data">
																	<span class="infobox-data-number">Bukti</span>
																	<div class="infobox-content">Sedang Diverifikasi</div>
																</div>
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right" for="file_pondok">Upload Ulang Bukti Pondok</label>

															<div class="col-sm-9">
																<input type="file" id="file_pondok" name="file_pondok">
															</div>
														</div>
														@if($row->jenis_kel=="PUTRI")
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right" >Download surat pernyataan 
						                                        <a href="{{route('download.sp')}}">disini</a></label>
					                                    </div>
					                                    @endif
													@else
														@if($row->jenis_kel=="PUTRA")	
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right">Nominal</label>

															<div class="col-sm-9">
																<input type="text" id="nominal_pondok" name="nominal_pondok" value="{{ $row->nominal_pondok }}" readonly="true" class="col-xs-10 col-sm-5" readonly="true" />
															</div>
														</div>
														@endif

														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right"> Keterangan Pondok</label>

															<div class="col-sm-9">
																<textarea id="ket_pondok" name="ket_pondok" rows="7" cols="35" readonly="true">{{ $row->ket_pondok }}</textarea>
															</div>
														</div>
														
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right" for="file_pondok">Scan Bukti Tuntas Tanggungan Pondok</label>

															<div class="col-sm-9">
																<input type="file" id="file_pondok" name="file_pondok">
															</div>
														</div>

														@if($row->jenis_kel=="PUTRI")
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right" >Download surat pernyataan (Khusus lulusan tahun 2022)
						                                        <a href="{{route('download.sp')}}">disini</a></label>
					                                    </div>
					                                    @endif
													@endif

													<div class="space-20"></div>
													<div class="hr hr12 dotted"></div>


													<div class="form-group" style="text-align: center;">
														<button type="submit" class="btn btn-primary">Simpan</button>

														&nbsp; &nbsp;
														<button class="btn" type="reset">
															<i class="ace-icon fa fa-undo bigger-110"></i>
															Reset
														</button>
													</div>
												</form>        
											@endif
											
										</div>
										@endforeach
									</div>
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			@include('siswa/footer')

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src=asset('assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="{{ asset('assets/js/jquery-ui.custom.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.ui.touch-punch.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.gritter.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootbox.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.easypiechart.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.hotkeys.index.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-wysiwyg.min.js') }}"></script>
		<script src="{{ asset('assets/js/select2.min.js') }}"></script>
		<script src="{{ asset('assets/js/spinbox.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-editable.min.js') }}"></script>
		<script src="{{ asset('assets/js/ace-editable.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.maskedinput.min.js') }}"></script>

		<!-- ace scripts -->
		<script src="{{ asset('assets/js/ace-elements.min.js') }}"></script>
		<script src="{{ asset('assets/js/ace.min.js') }}"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
		    var msg = '{{Session::get('alert')}}';
		    var exist = '{{Session::has('alert')}}';
		    if(exist){
		      alert(msg);
		    }
		</script>
	</body>
</html>
