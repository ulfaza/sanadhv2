<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Import Ujian - Paper</title>

        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        @include('paper/loadcss')
    </head>

    <body class="no-skin">
        @include('paper/header')

        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try{ace.settings.loadState('main-container')}catch(e){}
            </script>

            @include('paper/sidebar')

            <div class="main-content">
                <div class="main-content-inner">
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="{{route('paperhome')}}">Home</a>
                            </li>
                            <li>
                                <a href="{{route('index.ujian')}}">Ujian</a>
                            </li>
                            <li>
                                <a href="{{route('view.ujian', $th_ajaran)}}">{{ $th_ajaran }}</a>
                            </li>
                        </ul><!-- /.breadcrumb -->
                    </div>

                    <div class="page-content">
                        <div class="page-header">
                            <h4>
                                Import Ujian Paper Tahun Ajaran {{ $th_ajaran }} Tanggal {{ $tgl }}
                            </h4>      
                        </div><!-- /.page-header -->
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                @yield('content')
                                <form action="{{route('excel.peserta',[$th_ajaran, $tgl])}}" class="form-horizontal" method="post" enctype="multipart/form-data">  
                                    {{ csrf_field() }}
                                    <input type="file" name="import_file" />  
                                    <br>
                                    <button class="btn-sm btn-primary">Import File</button>  
                                </form> 
                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->

            @include('paper/footer')

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        @include('paper/loadjs')

        <!-- inline scripts related to this page -->
    </body>
</html>

