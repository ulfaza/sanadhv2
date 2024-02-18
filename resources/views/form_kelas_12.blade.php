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
            <h4 class="fw-300 c-grey-900 mB-40 text-center"><strong>Masukkan NIS dan Nama Lengkap</strong></h4>
            <p>Mohon isi data dengan benar! Pengisian data bisa dicicil per bagian dengan klik tombol next, maka otomatis data sudah tersimpan di sistem. Jika ada kendala silahkan menghubungi: <br>Putra: M. Abul Hasan Nadawy <br>Putri: Ulfatuz Zahroh</p>
            
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
            <form method="POST" action="{{ route('cari.siswa') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="nis" class="text-normal text-dark">NIS</label>
                    <input id="nis" type="text" name="nis" class="form-control" placeholder="NIS" value="{{ old('nis') }}" required autofocus>
                </div>
                <div class="form-group">
                    <label for="nama" class="text-normal text-dark">Nama Lengkap</label>
                    <input id="nama" type="nama" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                </div>
                <div class="form-group">
                    @include('layouts.utils.errorMessages')
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary btn-block">Isi Data</button>
                </div>
            </form>
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

