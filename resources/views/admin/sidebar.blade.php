      <div id="sidebar" class="sidebar                  responsive                    ace-save-state">
        <script type="text/javascript">
          try{ace.settings.loadState('sidebar')}catch(e){}
        </script>

        <ul class="nav nav-list">
          <li class="">
            <a href="{{route('adminhome')}}">
              <i class="menu-icon fa fa-tachometer"></i>
              <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-users"></i>
              <span class="menu-text">
                Pengguna
              </span>

              <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
              <li class="">
                <a href="{{route('list.guru')}}">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Guru
                </a>

                <b class="arrow"></b>
              </li>

              <li class="">
                <a href="{{route('list.siswa')}}">
                  <i class="menu-icon fa fa-caret-right"></i>

                  Siswa
                </a>

                <b class="arrow"></b>

              </li>
            </ul>
          </li>

          <li class="">
            <a href="{{route('kelas')}}">
              <i class="menu-icon fa fa-laptop"></i>
              <span class="menu-text"> Kelas </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-book"></i>
              <span class="menu-text"> KH </span>

              <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
              <li class="">
                <a href="{{ route('kh') }}">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Jenis KH
                </a>

                <b class="arrow"></b>
              </li>           
            </ul>

            <!-- <ul class="submenu">
              <li class="">
                <a href="{{ route('transkrip') }}">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Transkrip KH
                </a>

                <b class="arrow"></b>
              </li>           
            </ul> -->
          </li>

          <li class="">
            <a href="{{ route('ujian.dzikrul') }}">
              <i class="menu-icon fa fa-book"></i>
              <span class="menu-text"> Ujian Dzikrul </span>
            </a>

            <b class="arrow"></b>
          </li>
          
          <li class="">
            <a href="{{ route('index.rekappaper') }}">
              <i class="menu-icon fa fa-file-archive-o"></i>
              <span class="menu-text"> Rekap Paper </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="{{ route('index.rapor') }}">
              <i class="menu-icon fa fa-file-pdf-o"></i>
              <span class="menu-text"> Rekap Ambil Rapor</span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="{{ route('th_ajar') }}">
              <i class="menu-icon fa fa-calendar"></i>
              <span class="menu-text"> Tahun Ajaran </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-file-text"></i>
              <span class="menu-text">
                Tanggungan Ijazah
              </span>

              <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
              <li class="">
                <a href="{{ route('index.ijazah') }}">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Ketuntasan
                </a>

                <b class="arrow"></b>
              </li>

              <li class="">
                <a href="{{ route('index.keu') }}">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Keuangan
                </a>

                <b class="arrow"></b>
              </li>

              <li class="">
                <a href="{{ route('index.dz') }}">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Dzikrul Ghofilin
                </a>

                <b class="arrow"></b>
              </li>

              <li class="">
                <a href="{{ route('index.paper') }}">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Paper
                </a>

                <b class="arrow"></b>
              </li>

              <li class="">
                <a href="{{ route('index.pondok') }}">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Pondok
                </a>

                <b class="arrow"></b>
              </li>

              <li class="">
                <a href="{{ route('index.aman') }}">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Keamanan PA
                </a>

                <b class="arrow"></b>
              </li>

              <li class="">
                <a href="{{ route('index.perpus') }}">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Perpus
                </a>

                <b class="arrow"></b>
              </li>

              <li class="">
                <a href="{{ route('index.asesmen') }}">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Asesmen
                </a>

                <b class="arrow"></b>
              </li>
            </ul>
          </li>

          <li class="">
            <a href="{{ route('index.kelas12') }}">
              <i class="menu-icon fa fa-calendar"></i>
              <span class="menu-text"> Data Kelas 12 </span>
            </a>

            <b class="arrow"></b>
          </li>

          <!-- <li class="">
            <a href="#">
              <i class="menu-icon fa  fa-envelope"></i>
              <span class="menu-text"> Perizinan </span>
            </a>

            <b class="arrow"></b>
          </li> -->
        </ul><!-- /.nav-list -->

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
          <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
      </div>