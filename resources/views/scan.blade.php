<!-- resources/views/barcode/scan.blade.php -->

@extends('layouts.app')

@section('content')
    {{ csrf_field() }}
   <form id="barcodeForm" action="{{ url('/guru/handle-scan') }}" method="post">
       <div id="interactive" class="viewport"></div>
       <input type="hidden" id="barcode" name="barcode" value="">
       <button type="submit">Submit</button>
   </form>
@endsection

@section('scripts')
   <script>
       Quagga.init({
           inputStream: {
               name: "Live",
               type: "LiveStream",
               target: document.querySelector('#interactive'),
           },
           decoder: {
               readers: ['code_128_reader', 'ean_reader', 'code_39_reader', 'qr_code_reader'],
           },
       }, function (err) {
           if (err) {
               console.error(err);
               return;
           }
           Quagga.start();
       });

       Quagga.onDetected(function (result) {
           document.getElementById('barcode').value = result.codeResult.code;
           // Automatically submit the form when a barcode is detected
           document.getElementById('barcodeForm').submit();
       });
   </script>
@endsection
