<style type="text/css">
	.nav-item .active {
		background: #8bb07f !important;
	}
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #084808;">
    <!-- Brand Logo -->
    <a href="{{route('adminhome')}}" class="brand-link text-center">
        <span class="brand-text font-weight-light">SANADH</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('adminhome') }}" class="nav-link {{ request()->routeIs('adminhome') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <!-- 
            	<a href="#" class="nav-link {{ request()->routeIs('list.guru') || request()->routeIs('list.siswa') ? 'active' : '' }}">-->
                <li class="nav-item">
				    <a href="#" class="nav-link">
				        <i class="nav-icon fas fa-users"></i>
				        <p>
				            Pengguna
				            <i class="fas fa-angle-left right"></i>
				        </p>
				    </a>
				    <ul class="nav nav-treeview">
				        <li class="nav-item">
				            <a href="{{route('list.guru')}}" class="nav-link">
				                <i class="far fa-circle nav-icon"></i>
				                <p>Guru</p>
				            </a>
				        </li>
				        <li class="nav-item">
				            <a href="{{route('list.siswa')}}" class="nav-link">
				                <i class="far fa-circle nav-icon"></i>
				                <p>Siswa</p>
				            </a>
				        </li>
				    </ul>
				</li>
                <li class="nav-item">
                    <a href="{{route('kelas')}}" class="nav-link">
                        <i class="nav-icon fas fa-laptop"></i>
                        <p>
                            Kelas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
				    <a href="#" class="nav-link">
				        <i class="nav-icon fas fa-book"></i>
				        <p>
				            KH
				            <i class="fas fa-angle-left right"></i>
				        </p>
				    </a>
				    <ul class="nav nav-treeview">
				        <li class="nav-item">
				            <a href="{{ route('kh') }}" class="nav-link">
				                <i class="far fa-circle nav-icon"></i>
				                <p>Jenis KH</p>
				            </a>
				        </li>
				    </ul>
				</li>
                <li class="nav-item">
                    <a href="{{ route('ujian.dzikrul') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Ujian Dzikrul
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('index.rekappaper') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-archive"></i>
                        <p>
                            Rekap Paper
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('index.rapor') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-pdf"></i>
                        <p>
                            Rekap Ambil Raport
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('th_ajar') }}" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Tahun Ajaran
                        </p>
                    </a>
                </li>
                <li class="nav-item">
				    <a href="#" class="nav-link">
				        <i class="nav-icon fas fa-copy"></i>
				        <p>
				            Tanggungan Ijazah
				            <i class="fas fa-angle-left right"></i>
				        </p>
				    </a>
				    <ul class="nav nav-treeview">
				        <li class="nav-item">
				            <a href="{{ route('index.ijazah') }}" class="nav-link">
				                <i class="far fa-circle nav-icon"></i>
				                <p>Ketuntasan</p>
				            </a>
				        </li>
				    </ul>
				    <ul class="nav nav-treeview">
				        <li class="nav-item">
				            <a href="{{ route('index.keu') }}" class="nav-link">
				                <i class="far fa-circle nav-icon"></i>
				                <p>Keuangan</p>
				            </a>
				        </li>
				    </ul>
				    <ul class="nav nav-treeview">
				        <li class="nav-item">
				            <a href="{{ route('index.dz') }}" class="nav-link">
				                <i class="far fa-circle nav-icon"></i>
				                <p>Dzikrul Ghofilin</p>
				            </a>
				        </li>
				    </ul>
				    <ul class="nav nav-treeview">
				        <li class="nav-item">
				            <a href="{{ route('index.paper') }}" class="nav-link">
				                <i class="far fa-circle nav-icon"></i>
				                <p>Paper</p>
				            </a>
				        </li>
				    </ul>
				    <ul class="nav nav-treeview">
				        <li class="nav-item">
				            <a href="{{ route('index.pondok') }}" class="nav-link">
				                <i class="far fa-circle nav-icon"></i>
				                <p>Pondok</p>
				            </a>
				        </li>
				    </ul>
				    <ul class="nav nav-treeview">
				        <li class="nav-item">
				            <a href="{{ route('index.aman') }}" class="nav-link">
				                <i class="far fa-circle nav-icon"></i>
				                <p>Keamanan PA</p>
				            </a>
				        </li>
				    </ul>
				    <ul class="nav nav-treeview">
				        <li class="nav-item">
				            <a href="{{ route('index.perpus') }}" class="nav-link">
				                <i class="far fa-circle nav-icon"></i>
				                <p>Perpus</p>
				            </a>
				        </li>
				    </ul>
				    <ul class="nav nav-treeview">
				        <li class="nav-item">
				            <a href="{{ route('index.asesmen') }}" class="nav-link">
				                <i class="far fa-circle nav-icon"></i>
				                <p>Asesmen</p>
				            </a>
				        </li>
				    </ul>
				</li>
                <li class="nav-item">
                    <a href="{{ route('index.kelas12') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Data Kelas 12
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                    {{ csrf_field() }}
	                </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
