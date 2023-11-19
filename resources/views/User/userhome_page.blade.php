<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../Userfront/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../Userfront/img/favicon.png">
  <title>
    الصفحة الرئيسية
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../Userfront/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../Userfront/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../Userfront/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />

</head>

<body class="g-sidenav-show  bg-gray-200">
  @include('User.layout.usersidenav')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('User.layout.usernav')
    <div class="card" style="width: 80%;margin-left:10%;">
        <div style="text-align:center;" class="card-header">
          <h4>اجراء تقييم</h4>
        </div>
        @if(Session()->has('failure'))
                <div class="alert alert-danger" style="text-align: right">{{Session('failure')}}</div>
            @endif
        <div class="card-body" >
            <form action="{{url('/evaluatetype_redirect')}}" method="GET" enctype="multipart/form-data">

              <div class="row">

                    {{-- <div style="text-align:right;" class="col-md-12 mb-3">
                      <label>Bar Serial Number</label>
                      <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  name="bar_serialnumber" required />
                    class="form-select formselect required"
                    </div> --}}

                    <div style="text-align:right;" class="col-md-12 mb-3">
                      <label style="text-align: right">اختر نوع التقييم</label>
                      <select class="form-select" name="evaluatetype" aria-label="Default select example" style="text-align: right" required>
                        <option value="">اختر نوع التقييم</option>
                        <option value="1" >تقييم ذاتي</option>
                        <option value="2" >تقييم فعلي</option>
                      </select>
                    </div>

                    <div style="text-align:right;" class="col-md-12 mb-3">
                      <label style="text-align: right">اختر نوع التقييم</label>
                      <select class="form-select" name="organization_status" id="org_filter" aria-label="Default select example" style="text-align: right" required>
                        <option value="">حالة المنظمة او الشركة</option>
                        @foreach($organizations as $organization)
                          <option value="{{$organization->organization_status}}">{{$organization->organization_status}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div style="text-align:right;" class="col-md-12 mb-3">
                        <label style="text-align: right">اختر برنامج</label>
                        <select class="form-select" name="programtype" id="prog_name" aria-label="Default select example" style="text-align: right" required>

                        </select>
                    </div>



                    <div style="text-align:right;" class="col-md-12 mb-3">
                      <input value="اتمام" style="background-color: crimson" type="submit" class="btn btn-primary"  />
                    </div>

                </div>
            </form>
        </div>

    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Material UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn btn-outline-dark w-100" href="">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  @include('User.layout.userjs')


  <script src="http://code.jquery.com/jquery-3.4.1.js"></script>

  <script>
              $(document).ready(function () {
              $('#org_filter').on('change', function () {
              let filter_type = $(this).val();
              $('#prog_name').empty();
              $('#prog_name').append(`<option value="0" disabled selected>Processing...</option>`);
              $.ajax({
              type: 'GET',
              url: 'GetProgramsRelatedToSpecificType/' + filter_type,
              success: function (response) {
              var response = JSON.parse(response);
              console.log(response);
              $('#prog_name').empty();
              $('#prog_name').append(`<option value="0" disabled selected>اسم البرنامج</option>`);
              response.forEach(element => {
                  $('#prog_name').append(`<option value="${element['id']}">${element['program_name']}</option>`);
                  });
              }
          });
      });
  });
  </script>


</body>
</html>
