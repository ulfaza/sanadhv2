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
            <h4 class="fw-300 c-grey-900 mB-40 text-center"><strong>Bagian 2</strong></h4>
            <p><strong>Data Orang Tua</strong></p>
            
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
            <form method="POST" action="{{ route('dataortu.siswa', $row->s_id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label for="tg_ortu" class="text-normal text-dark"> <strong>Jumlah Tanggungan Orang Tua (Orang)</strong></label>
                    <input id="tg_ortu" type="number" name="tg_ortu" class="form-control" value="{{ $row->tg_ortu }}" required>
                </div>
                <div class="form-group">
                    <label for="penghasilan_ayah" class="text-normal text-dark"><strong>Penghasilan Ayah</strong></label>
                    <input id="penghasilan_ayah" type="text" name="penghasilan_ayah" class="form-control" value="{{ $row->penghasilan_ayah }}">
                </div>
                <div class="form-group">
                    <label for="penghasilan_ibu" class="text-normal text-dark"><strong>Penghasilan Ibu</strong></label>
                    <input id="penghasilan_ibu" type="text" name="penghasilan_ibu" class="form-control" value="{{ $row->penghasilan_ibu }}">
                </div>

                <div class="form-group">
                        <label for="kk"><strong>Foto Kartu Keluarga</strong><br>Pastikan tulisan bisa terbaca!</label>

                        <div class="col-sm-9">
                            <input type="file" id="kk" name="kk">
                        </div>
                    </div>

                @if($row->kk!=NULL)
                    <div class="form-group">
                        <div class="infobox infobox-blue col-sm-9">
                            <div class="infobox-data">
                                <span class="infobox-data-number">Foto KK</span>
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

