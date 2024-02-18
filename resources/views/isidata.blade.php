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
            <h4 class="fw-300 c-grey-900 mB-40 text-center"><strong>Bagian 1</strong></h4>
            <p><strong>Data Diri</strong></p>
            
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
            <form method="POST" action="{{ route('datadiri.siswa', $row->s_id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label for="s_nama" class="text-normal text-dark"> <strong>Nama Lengkap</strong>  <br>Isi dengan benar sesuai KK jika masih salah</label>
                    <input id="s_nama" type="text" name="s_nama" class="form-control" value="{{ $row->s_nama }}" required>
                </div>
                <div class="form-group">
                    <label for="no_hp" class="text-normal text-dark"><strong>Nomor Handphone Pribadi</strong></label>
                    <input id="no_hp" type="text" name="no_hp" class="form-control" value="{{ $row->no_hp }}">
                </div>
                <div class="form-group">
                    <label for="email" class="text-normal text-dark"><strong>Email</strong> <br>Pastikan email aktif dan <strong>INGAT PASSWORDNYA!</strong> <br>Perhatikan penulisan email, jangan sampai salah ketik!</label>
                    <input id="email" type="text" name="email" class="form-control" value="{{ $row->email }}">
                </div>

                <div class="form-group">
                        <label for="foto"><strong>Foto</strong><br>Foto 3x4 berseragam putih baground merah, khusus bagi peserta didik yang tidak mengikuti foto ijazah bersama Madrasah</label>

                        <div class="col-sm-9">
                            <input type="file" id="foto" name="foto">
                        </div>
                    </div>

                @if($row->foto!=NULL)
                    <div class="form-group">
                        <div class="infobox infobox-blue col-sm-9">
                            <div class="infobox-data">
                                <span class="infobox-data-number">Foto</span>
                                <div class="infobox-content">Sudah terupload</div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                        <label for="ijazah"><strong>Foto Ijazah SMP/MTs</strong></label>

                        <div class="col-sm-9">
                            <input type="file" id="ijazah" name="ijazah">
                        </div>
                    </div>

                @if($row->ijazah!=NULL)
                    <div class="form-group">
                        <div class="infobox infobox-blue col-sm-9">
                            <div class="infobox-data">
                                <span class="infobox-data-number">Ijazah</span>
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

