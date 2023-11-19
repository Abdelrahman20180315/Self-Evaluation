 <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#" target="_blank">
        <img src="{{asset('/Admin/img/logo-ct.png')}}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Self Evaluation System</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        
        <li class="nav-item ">
          <a class="{{ (request()->is('Adminhome')) ? 'nav-link text-white active bg-gradient-primary' : 'nav-link text-white' }}" href="{{url('/Adminhome')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">عرض المستخدمين</span>
          </a>
        </li>
        <li class="nav-item ">
          <a class="{{ (request()->is('/enter_organizationstatus')) ? 'nav-link text-white active bg-gradient-primary' : 'nav-link text-white' }}" href="{{url('/enter_organizationstatus')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">ادخال حالة الشركة او المنظمة  </span>
          </a>
        </li>
        <li class="nav-item ">
          <a class="{{ (request()->is('/show_organizationstatus')) ? 'nav-link text-white active bg-gradient-primary' : 'nav-link text-white' }}" href="{{url('/show_organizationstatus')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">كل حالات الشركة او المنظمة  </span>
          </a>
        </li>
        <li class="nav-item ">
          <a class="{{ (request()->is('program.create')) ? 'nav-link text-white active bg-gradient-primary' : 'nav-link text-white' }}" href="{{route('program.create')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">إنشاء برنامج</span>
          </a>
        </li>
        <li class="nav-item ">
          <a class="{{ (request()->is('program.index')) ? 'nav-link text-white active bg-gradient-primary' : 'nav-link text-white' }}" href="{{route('program.index')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">البرامج</span>
          </a>
        </li>
        <li class="nav-item ">
          <a class="{{ (request()->is('/admin_showEvaluations')) ? 'nav-link text-white active bg-gradient-primary' : 'nav-link text-white' }}" href="{{url('/admin_showEvaluations')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">عرض التقييمات الذاتية المستخدمين</span>
          </a>
        </li>
        
        {{-- <li class="nav-item ">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>

            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    البرامج
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    @foreach($AllPrograms as $programs)
                    <a href="{{url('/creategroups/selectedprgram',$programs->id)}}">{{$programs->program_name}}</a>
                    @endforeach
                  </div>
                </div>
              </div>
              
            </div>  
          
        </li>  --}}
        
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        {{-- <a class="btn bg-gradient-primary mt-4 w-100" href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a> --}}
      </div>
    </div>
  </aside>