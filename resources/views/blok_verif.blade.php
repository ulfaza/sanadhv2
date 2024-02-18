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
            <h4 class="fw-300 c-grey-900 mB-40 text-center"><strong>Bagian 4</strong></h4>
            <p><strong>Nonaktifkan Verfikasi 2 Langkah Akun Google</strong></p>
            
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
            <form method="POST" action="{{ route('selesai', $row->s_id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label for="s_nama" class="text-normal text-dark"> <strong>Nonaktifkan Verifikasi 2 Langkah Google</strong>  <br>Demi kelancaran proses pendaftaran perkuliahn, mohon untuk menonaktifkan verifikasi 2 langkah akun google. Tutorial bisa dilihat di google dengan keyword "cara mematikan verifikasi 2 langkah akun google". Alasan verfikasi 2 langkah dimatikan supaya ketika mendaftar tidak perlu menunggu konfirmasi dari pihak rumah karena seringkali pihak rumah tidak online ketika ada notifikasi dan proses verifikasi ke handphone terbatas oleh waktu.</label>
                </div>

                <div class="form-group">
                    @include('layouts.utils.errorMessages')
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary btn-block">Selesai</button>
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

