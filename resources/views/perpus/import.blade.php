<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Tanggungan Perpus</title>

        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        @include('perpus/loadcss')
    </head>

    <body class="no-skin">
        @include('perpus/header')

        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try{ace.settings.loadState('main-container')}catch(e){}
            </script>

            @include('perpus/sidebar')

            <div class="main-content">
                <div class="main-content-inner">
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="{{route('perpushome')}}">Home</a>
                            </li>
                        </ul><!-- /.breadcrumb -->
                    </div>

                    <div class="page-content">
                        <div class="page-header">
                            <h4>
                                Import Tanggungan
                            </h4>
                            
                        </div><!-- /.page-header -->
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                @yield('content')
                                <form action="{{ URL::to('/perpus/importExcel', $th_lulus) }}" class="form-horizontal" method="post" enctype="multipart/form-data">  
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

            @include('perpus/footer')

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        @include('perpus/loadjs')

        <!-- inline scripts related to this page -->
    </body>
</html>

