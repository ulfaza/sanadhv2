      <div id="sidebar" class="sidebar                  responsive                    ace-save-state">
        <script type="text/javascript">
          try{ace.settings.loadState('sidebar')}catch(e){}
        </script>

        <ul class="nav nav-list">
          <li class="">
            <a href="{{route('keamananhome')}}">
              <i class="menu-icon fa fa-tachometer"></i>
              <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-check-circle-o"></i>
              <span class="menu-text"> Tanggungan </span>
              <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
              @foreach($angkatan as $row)
              <li class="">
                <a href="{{route('tanggungan.keamanan', $row->th_lulus)}}">
                  <i class="menu-icon fa fa-caret-right"></i>
                  {{ $row->th_lulus }}
                </a>

                <b class="arrow"></b>
              </li>
              @endforeach
            </ul>         
          </li>

        </ul><!-- /.nav-list -->

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
          <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
      </div>