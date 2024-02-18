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
            <h4 class="fw-300 c-grey-900 mB-40 text-center"><strong>Terima Kasih</strong></h4>
             @foreach($siswa as $row)
            <h4 class="fw-300 c-grey-900 mB-40 text-center">{{ $row->s_nama }}</h4>
             @endforeach
            <p>sudah menyelesaikan upload persyaratan pendaftaran kuliah. Semoga nanti prosesnya lancar. Semangat!</p>
           
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

