 <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="../Admin/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Material Dashboard 2</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
       
        <li class="nav-item ">
          <a class="{{ (request()->is('/users')) ? 'nav-link text-white active bg-gradient-primary' : 'nav-link text-white' }}" href="{{url('/users')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Show All Users</span>
          </a>
        </li>
        
        <li class="nav-item ">
          <a class="{{ (request()->is('add_country')) ? 'nav-link text-white active bg-gradient-primary' : 'nav-link text-white' }}" href="{{url('add_country')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Add Country</span>
          </a>
        </li>
        <li class="nav-item ">
          <a class="{{ (request()->is('show_contries')) ? 'nav-link text-white active bg-gradient-primary' : 'nav-link text-white' }}" href="{{url('show_contries')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Show Countries</span>
          </a>
        </li>

        <li class="nav-item ">
          <a class="{{ (request()->is('add_volt')) ? 'nav-link text-white active bg-gradient-primary' : 'nav-link text-white' }}" href="{{url('add_volt')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Add Volt</span>
          </a>
        </li>

        <li class="nav-item ">
          <a class="{{ (request()->is('show_volts')) ? 'nav-link text-white active bg-gradient-primary' : 'nav-link text-white' }}" href="{{url('show_volts')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Show Volts</span>
          </a>
        </li>

        <li class="nav-item ">
          <a class="{{ (request()->is('add_bar')) ? 'nav-link text-white active bg-gradient-primary' : 'nav-link text-white' }}" href="{{url('add_bar')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Add Bar</span>
          </a>
        </li>
        <li class="nav-item ">
          <a class="{{ (request()->is('show_bars')) ? 'nav-link text-white active bg-gradient-primary' : 'nav-link text-white' }}" href="{{url('show_bars')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Show Bars</span>
          </a>
        </li>

        <li class="nav-item ">
          <a class="{{ (request()->is('barwithitsvolt')) ? 'nav-link text-white active bg-gradient-primary' : 'nav-link text-white' }}" href="{{url('barwithitsvolt')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Show Bar with its Volt</span>
          </a>
        </li>

        








        
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn bg-gradient-primary mt-4 w-100" href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>
      </div>
    </div>
  </aside>