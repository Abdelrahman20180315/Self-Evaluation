<header>
    <!-- header inner -->
    <div class="header">
       <div class="container-fluid">
          <div class="row">
             <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                <div class="full">
                   <div class="center-desk">
                      <div class="logo">
                         <a href="index.html"><img src="UserFront/images/logo.png" alt="#" /></a>
                      </div>
                   </div>
                </div>
             </div>
             <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                <nav class="navigation navbar navbar-expand-md navbar-dark ">
                   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                   <span class="navbar-toggler-icon"></span>
                   </button>
                   <div class="collapse navbar-collapse" id="navbarsExample04">
                      <ul class="navbar-nav mr-auto">
                         <li class="nav-item active">
                            <a class="nav-link" href="UserFront/index.html">Home</a>
                         </li>
                         <li class="nav-item">
                            <a class="nav-link" href="UserFront/about.html">About</a>
                         </li>
                         <li class="nav-item">
                            <a class="nav-link" href="UserFront/glasses.html">Our Glasses</a>
                         </li>
                         <li class="nav-item">
                            <a class="nav-link" href="UserFront/shop.html">Shop</a>
                         </li>
                         <li class="nav-item">
                            <a class="nav-link" href="UserFront/contact.html">Contact Us</a>
                         </li>
                         {{-- <li class="nav-item d_none login_btn">
                            <a class="nav-link" href="#">Login</a>
                         </li>
                         <li class="nav-item d_none">
                            <a class="nav-link" href="#">Register</a>
                         </li>
                         <li class="nav-item d_none sea_icon">
                            <a class="nav-link" href="#"><i class="fa fa-shopping-bag" aria-hidden="true"></i><i class="fa fa-search" aria-hidden="true"></i></a>
                         </li> --}}
                         <li class="nav-item d_none login_btn">
                   
                           @if(Auth::id())
                               <form method="POST" action="{{ route('logout') }}">
                               @csrf 
                           
                                   <a style="font-size:20px;" href="{{ route('logout') }}" onclick="event.preventDefault();
                                       this.closest('form').submit(); " role="button">
                                       {{ __('تسجيل الخروج') }}
                               </a>
                           
                               </form>
                           @endif
                       </li>
                      </ul>
                   </div>
                </nav>
             </div>
          </div>
       </div>
    </div>
 </header>