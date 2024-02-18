@extends('layouts.app')

@section('title', 'Form Kelas 12')

@section('content')
    <div class="peers ai-s fxw-nw h-100vh">
        <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style="background-image:url({{ asset('img/bg.jpg') }})">
            <div class="pos-a centerXY">
                {{-- <div class="bgc-white bdrs-50p pos-r" style="width:120px;height:120px"><img class="pos-a centerXY" src="{{ asset('img/logo_lsp_its.jpg') }}" alt=""></div> --}}
            </div>
        </div>
        <div class="col-12 col-md-4 peer pX-80 pY-80 h-100 bgc-white scrollable pos-r" style="min-width:320px">
            <h4 class="fw-300 c-grey-900 mB-40 text-center"><strong>Bagian 3</strong></h4>
            <p><strong>Berkas Rapor dan Sertifikat</strong></p>
            
            @if(\Session::has('alert'))
                <div class="alert alert-danger">
                    <div>{{Session::get('alert')}}</div>
                </div>
            @endif
            @if(\Session::has('alert-success'))
                <div class="alert alert-success">
                    <div>{{Session::get('alert-success')}}</div>
                </div>
            @endif
            @foreach($siswa as $row)
            <form method="POST" action="{{ route('berkasrapor.siswa', $row->s_id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="rapor_smt1"><strong>Scan Rapor Kelas 10 Semester 1</strong><br>Scan Rapor 1 semester dalam bentuk PDF</label>

                    <div class="col-sm-9">
                        <input type="file" id="rapor_smt1" name="rapor_smt1">
                    </div>
                </div>

                @if($row->rapor_smt1!=NULL)
                    <div class="form-group">
                        <div class="infobox infobox-blue col-sm-9">
                            <div class="infobox-data">
                                <span class="infobox-data-number">Rapor Kelas 10 Semester 1</span>
                                <div class="infobox-content">Sudah terupload</div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label for="rapor_smt2"><strong>Scan Rapor Kelas 10 Semester 2</strong><br>Scan Rapor 1 semester dalam bentuk PDF</label>

                    <div class="col-sm-9">
                        <input type="file" id="rapor_smt2" name="rapor_smt2">
                    </div>
                </div>

                @if($row->rapor_smt2!=NULL)
                    <div class="form-group">
                        <div class="infobox infobox-blue col-sm-9">
                            <div class="infobox-data">
                                <span class="infobox-data-number">Rapor Kelas 10 Semester 2</span>
                                <div class="infobox-content">Sudah terupload</div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label for="rapor_smt3"><strong>Scan Rapor Kelas 11 Semester 1</strong><br>Scan Rapor 1 semester dalam bentuk PDF</label>

                    <div class="col-sm-9">
                        <input type="file" id="rapor_smt3" name="rapor_smt3">
                    </div>
                </div>

                @if($row->rapor_smt3!=NULL)
                    <div class="form-group">
                        <div class="infobox infobox-blue col-sm-9">
                            <div class="infobox-data">
                                <span class="infobox-data-number">Rapor Kelas 11 Semester 1</span>
                                <div class="infobox-content">Sudah terupload</div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label for="rapor_smt4"><strong>Scan Rapor Kelas 11 Semester 2</strong><br>Scan Rapor 1 semester dalam bentuk PDF</label>

                    <div class="col-sm-9">
                        <input type="file" id="rapor_smt4" name="rapor_smt4">
                    </div>
                </div>

                @if($row->rapor_smt4!=NULL)
                    <div class="form-group">
                        <div class="infobox infobox-blue col-sm-9">
                            <div class="infobox-data">
                                <span class="infobox-data-number">Rapor Kelas 11 Semester 2</span>
                                <div class="infobox-content">Sudah terupload</div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label for="rapor_smt5"><strong>Scan Rapor Kelas 12 Semester 1</strong><br>Scan Rapor 1 semester dalam bentuk PDF</label>

                    <div class="col-sm-9">
                        <input type="file" id="rapor_smt5" name="rapor_smt5">
                    </div>
                </div>

                @if($row->rapor_smt5!=NULL)
                    <div class="form-group">
                        <div class="infobox infobox-blue col-sm-9">
                            <div class="infobox-data">
                                <span class="infobox-data-number">Rapor Kelas 12 Semester 1</span>
                                <div class="infobox-content">Sudah terupload</div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label for="sertif"><strong>Sertifikat Prestasi</strong><br>Scan sertifikat prestasi dalam bentuk PDF</label>

                    <div class="col-sm-9">
                        <input type="file" id="sertif" name="sertif">
                    </div>
                </div>

                @if($row->sertif!=NULL)
                    <div class="form-group">
                        <div class="infobox infobox-blue col-sm-9">
                            <div class="infobox-data">
                                <span class="infobox-data-number">Sertifikat prestasi</span>
                                <div class="infobox-content">Sudah terupload</div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    @include('layouts.utils.errorMessages')
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary btn-block">Next</button>
                </div>
                
            </form>
            @endforeach
        </div>
    </div>

    <script type="text/javascript">
        function myFunction() {
          var x = document.getElementById("password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
    </script>
@endsection

