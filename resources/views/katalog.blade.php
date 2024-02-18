<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Parallax, Template, Registration, Landing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/dh.png') }}">
    <title>MA Darul Huda Ponorogo</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nivo-lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">    
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    <style>
      table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #45536b;
      }

      th, td {
        text-align: left;
        padding: 8px;
        color: black;
      }

      tr:nth-child(even){background-color: #f2f2f2}
      tr:nth-child(odd){background-color: #bec2bf}

      /* Style for the pagination links container */
      .pagination {
          display: flex;
          justify-content: center;
          margin-top: 20px;
      }

      /* Style for individual pagination link items */
      .pagination li {
          list-style: none;
          margin: 0 10px;
      }

      /* Style for the active pagination link */
      .pagination .page-item.active .page-link {
          background-color: #007bff;
          border-color: #007bff;
          color: #fff;
      }

      /* Style for pagination links */
      .pagination .page-link {
          padding: 6px 12px;
          border: 1px solid #ddd;
          background-color: #fff;
          color: #333;
          transition: background-color 0.3s, color 0.3s, border-color 0.3s;
      }

      /* Hover effect for pagination links */
      .pagination .page-link:hover {
          background-color: #f8f9fa;
          color: #333;
          border-color: #ddd;
      }

    </style>
  </head>
  <body>

    <!-- Header Section Start -->
    <header id="hero-blank" data-stellar-background-ratio="0.5">    
      <!-- Navbar Start -->
      <nav class="navbar navbar-expand-lg fixed-top scrolling-navbar indigo">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <a href="/" class="navbar-brand"><img class="img-fulid" src="{{ asset('img/logo.png') }}" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
              <i class="lnr lnr-menu"></i>
            </button>
          </div>
          <div class="collapse navbar-collapse" id="main-navbar">
            <ul class="navbar-nav mr-auto w-100 justify-content-end">
              <li class="nav-item">
                <a class="nav-link page-scroll" href="/">Home</a>
              </li>
            </ul>
          </div>
        </div>

        <!-- Mobile Menu Start -->
        <ul class="mobile-menu">
           <li>
              <a class="page-scroll" href="/">Home</a>
            </li>
        </ul>
        <!-- Mobile Menu End -->

      </nav>
      <!-- Navbar End -->   
      <div class="container">      
        <div class="row justify-content-md-center">
          <div class="col-md-10">
            <div class="contents text-center">
              <h1 class="wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s">Katalog Paper MA Darul Huda</h1>
            </div>
          </div>
        </div> 
      </div>           
    </header>
    <!-- Header Section End --> 

    <!-- Profil Section Start -->
    <section id="profil" class="section">
      <div class="container">
        <div class="section-header"> 
          <div style="text-align: right;"><input id="myInput" type="text" placeholder="Search.."></div>       
          <br>  
          <div style="overflow-x:auto;">
            <table>
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Judul</th>
                  <th>Pembimbing</th>
                </tr>
              </thead>
              <tbody id="myTable">
                @foreach($paper as $row)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $row->s_nama }}</td>
                  <td>{{ $row->tingkat }} {{ $row->k_nama }}</td>
                  <td>{{ $row->judul }}</td>
                  <td>{{ $row->pembimbing }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $paper->links() }}
          </div>
        </div>
      </div>
    </section>
    <!-- Profil Section End -->

    <!-- Contact Section Start -->
    <section id="contact" class="section" data-stellar-background-ratio="-0.2">      
      <div class="contact-form">
        <div class="container">
          <div class="row">     
            <div class="col-lg-6 col-sm-6 col-xs-12">
              <div class="contact-us">
                <h3>Contact With us</h3>
                <div class="contact-address">
                  <p>Jl. Ir. H. Juanda VI/38 Mayak, Tonatan, Ponorogo </p>
                  <p class="phone">Phone: <span>(0352) 461093</span></p>
                  <p class="email">Work Time: <span>07.00-12.00 (Hari Jum'at Libur)</span></p>
                </div>
                <div class="social-icons">
                  <ul>
                    <li class="facebook"><a href="https://www.facebook.com/DarulHudaMayak/?locale=id_ID"><i class="fa fa-facebook"></i></a></li>
                    <li class="twitter"><a href="https://www.instagram.com/darulhudamayak/"><i class="fa fa-instagram"></i></a></li>
                    <li class="google-plus"><a href="https://www.youtube.com/@DarulHudaMayak007"><i class="fa fa-youtube"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>     
          </div>
        </div>
      </div>           
    </section>
    <!-- Contact Section End -->

    <!-- Footer Section Start -->
    <footer>          
      <div class="container">
        <div class="row">
          <!-- Footer Links -->
          <div class="col-lg-6 col-sm-6 col-xs-12">
            <ul class="footer-links">
              <li>
                <a href="/">Homepage</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-6 col-sm-6 col-xs-12">
            <div class="copyright">
              <p>2023 - MA Darul Huda</a></p>
            </div>
          </div>  
        </div>
      </div>
    </footer>
    <!-- Footer Section End --> 

    <!-- Go To Top Link -->
    <a href="#" class="back-to-top">
      <i class="lnr lnr-arrow-up"></i>
    </a>
    
    <div id="loader">
      <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
      </div>
    </div>     

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="{{ asset('js/jquery-min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mixitup.js') }}"></script>
    <script src="{{ asset('js/nivo-lightbox.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>    
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>    
    <script src="{{ asset('js/jquery.nav.js') }}"></script>    
    <script src="{{ asset('js/scrolling-nav.js') }}"></script>    
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>    
    <script src="{{ asset('js/smoothscroll.js') }}"></script>    
    <script src="{{ asset('js/jquery.slicknav.js') }}"></script>     
    <script src="{{ asset('js/wow.js') }}"></script>   
    <script src="{{ asset('js/jquery.vide.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>    
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>    
    <script src="{{ asset('js/waypoints.min.js') }}"></script>    
    <script src="{{ asset('js/form-validator.min.js') }}"></script>
    <script src="{{ asset('js/contact-form-script.js') }}"></script>   
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    </script>
  </body>
</html>