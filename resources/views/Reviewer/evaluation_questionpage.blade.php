<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../Userfront/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../Userfront/img/favicon.png">
  <title>
    صفحة الاسئلة التابعة للبرنامج
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
          <h4>صفحة الاسئلة التابعة للبرنامج</h4>
        </div>
        <div class="card-body" >
            @if($evaluatetype == 1)
                <form action="{{url('/Add_SelfEvaluation')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @foreach($questions as $question)
                        @if($question->question_resultstatus == 1)
                            <div class="row">

                                
                                <div style="text-align: right" class="col-md-12 mb-3">
                                {{-- <h3>HIIIIIIII<span class="gcolor"></span> </h3> --}}
                                <div class="form-s2">
                                    <div>
                                        <label >{{$question->question_text}}</label>
                                        <select onchange="senddata(event,{{$question->id}})" class="form-control formselect required" placeholder="Select Bar Type" style="text-align: right"
                                            id="result_yesno_{{$question->id}}" name="bar_type" required>
                                            <option value="">اختراجابتك نعم او لا</option>
                                            <option  value="1">نعم</option>
                                            <option  value="2">لا</option>     
                                        </select>
                                        <input type="hidden" id="question_id_{{$question->id}}" name="question_id" value="{{$question->id}}">
                                    </div>
                                </div>
                                </div>  

                                <div style="text-align: right" class="col-md-12 mb-3" id="evaluate">
                               
                                        <label >تقييم رقمي للاجابة</label>
                                        <input type="text" id="evaluate_numyesno_{{$question->id}}" style="background-color:OldLace;text-align:right" class="form-control"  name="evaluate_numyesno[]" required>
                                        <label >تقييم نصي للاجابة</label>
                                        <input type="text" id="evaluate_textyesno_{{$question->id}}" style="background-color:OldLace;text-align:right" class="form-control"  name="evaluate_text[]" required>
                                
                                </div>  

                                
                                        
                            </div>
                        @endif   
                        @if($question->question_resultstatus == 2)
                            <div class="row">

                                <div style="text-align: right" class="col-md-12 mb-3">
                                <div class="form-s2">
                                    <div>
                                        <label >{{$question->question_text}}</label>
                                        <input onkeyup="sendnumdata(event,{{$question->id}})"  type="text" id="result_valuenum_{{$question->id}}"  style="background-color:OldLace;text-align:right" class="form-control"  name="result_value" placeholder="ادخل اجابتك رقم"  required/>
                                        <input type="hidden" id="question_idnum_{{$question->id}}" name="question_id" value="{{$question->id}}">

                                        
                                    </div>
                                </div>
                                </div>  

                                <div style="text-align: right" class="col-md-12 mb-3" id="evaluate">
                               
                                    <label >تقييم رقمي للاجابة</label>
                                    <input type="text" id="evaluate_numvaluenum_{{$question->id}}" style="background-color:OldLace;text-align:right" class="form-control"  name="evaluate_numnumber[]" required>
                                    <label >تقييم نصي للاجابة</label>
                                    <input type="text" id="evaluate_numvaluetext_{{$question->id}}" style="background-color:OldLace;text-align:right" class="form-control"  name="evaluate_text[]" required>
                            
                                </div>  

                                    
                            </div>
                        @endif  
                        @if($question->question_resultstatus == 3)
                            <div class="row">

                                
                                <div style="text-align: right" class="col-md-12 mb-3">
                                
                                <div class="form-s2">
                                    <div>
                                        <label >{{$question->question_text}}</label>
                                        <select onchange="sendtextdata(event,{{$question->id}})" class="form-control formselect required" placeholder="Select Bar Type" style="text-align: right"
                                            id="result_text" name="result_value[]" required>
                                            <option value="">اختراجابتك نص</option>
                                            @foreach($question->result as $result)
                                            <option  value="{{$result->id}}">{{$result->result_value}}</option>
                                            @endforeach   
                                        </select>
                                        <input type="hidden" id="question_idtext_{{$question->id}}" name="question_id" value="{{$question->id}}">

                                    </div>
                                </div>
                                </div>  

                                <div style="text-align: right" class="col-md-12 mb-3" id="evaluate">
                                
                                        <label >تقييم رقمي للاجابة</label>
                                        <input type="text" id="evaluate_textn_{{$question->id}}" style="background-color:OldLace;text-align:right" class="form-control"  name="evaluate_numtext[]" required>
                                        <label >تقييم نصي للاجابة</label>
                                        <input type="text" id="evaluate_textt_{{$question->id}}" style="background-color:OldLace;text-align:right" class="form-control"  name="evaluate_text[]" required>
                                
                                </div>  

                               
                                        
                            </div>
                        @endif 
                    @endforeach
                    <input type="hidden" name="user_id" value="{{$user_id}}" >
                    <input type="hidden" name="programtype" value="{{$programtype}}" >
                    <input type="hidden" name="evaluatetype" value="{{$evaluatetype}}" >
  
                    <div style="text-align:right;" class="col-md-12 mb-3">
                        <input value="اتمام التقييم" style="background-color: crimson" type="submit" class="btn btn-primary"  />
                    </div>     
                </form>
            @endif
            @if($evaluatetype == 2)
                <form action="{{url('/Add_ActualEvaluation')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @foreach($questions as $question)
                        @if($question->question_resultstatus == 1)
                            <div class="row">

                                
                                <div style="text-align: right" class="col-md-12 mb-3">
                                {{-- <h3>HIIIIIIII<span class="gcolor"></span> </h3> --}}
                                <div class="form-s2">
                                    <div>
                                        <label >{{$question->question_text}}</label>
                                        <select  class="form-control formselect required" placeholder="Select Bar Type" style="text-align: right"
                                             name="result_value[]" required>
                                            <option value="">اختراجابتك نعم او لا</option>
                                            <option  value="نعم">نعم</option>
                                            <option  value="لا">لا</option>     
                                        </select>
                                        <input type="hidden"  name="question_id[]" value="{{$question->id}}">
                                        <input type="hidden"  name="question_status[]" value="{{$question->question_resultstatus}}">

                                    </div>
                                </div>
                                </div>  

                                {{-- <div style="text-align: right" class="col-md-12 mb-3" id="evaluate">
                               
                                        <label >تقييم رقمي للاجابة</label>
                                        <input type="text"  style="background-color:OldLace;text-align:right" class="form-control"  name="evaluate_num[]" required>
                                        <label >تقييم نصي للاجابة</label>
                                        <input type="text"  style="background-color:OldLace;text-align:right" class="form-control"  name="evaluate_text[]" required>
                                
                                </div>   --}}

                                
                                        
                            </div>
                        @endif   
                        @if($question->question_resultstatus == 2)
                            <div class="row">

                                <div style="text-align: right" class="col-md-12 mb-3">
                                <div class="form-s2">
                                    <div>
                                        <label >{{$question->question_text}}</label>
                                        <input   type="text"   style="background-color:OldLace;text-align:right" class="form-control"  name="result_value[]" placeholder="ادخل اجابتك رقم"  required/>
                                        <input type="hidden"  name="question_id[]" value="{{$question->id}}">
                                        <input type="hidden"  name="question_status[]" value="{{$question->question_resultstatus}}">

                                        
                                    </div>
                                </div>
                                </div>  

                                {{-- <div style="text-align: right" class="col-md-12 mb-3" id="evaluate">
                               
                                    <label >تقييم رقمي للاجابة</label>
                                    <input type="text" id="evaluate_numvaluenum_{{$question->id}}" style="background-color:OldLace;text-align:right" class="form-control"  name="evaluate_numnumber[]" required>
                                    <label >تقييم نصي للاجابة</label>
                                    <input type="text" id="evaluate_numvaluetext_{{$question->id}}" style="background-color:OldLace;text-align:right" class="form-control"  name="evaluate_text[]" required>
                            
                                </div>   --}}

                                    
                            </div>
                        @endif  
                        @if($question->question_resultstatus == 3)
                            <div class="row">

                                
                                <div style="text-align: right" class="col-md-12 mb-3">
                                
                                <div class="form-s2">
                                    <div>
                                        <label >{{$question->question_text}}</label>
                                        <select  class="form-control formselect required"  style="text-align: right"
                                             name="result_value[]" required>
                                            <option value="">اختراجابتك نص</option>
                                            @foreach($question->result as $result)
                                            <option  value="{{$result->result_value}}">{{$result->result_value}}</option>
                                            @endforeach   
                                        </select>
                                        <input type="hidden"  name="question_id[]" value="{{$question->id}}">
                                        <input type="hidden"  name="question_status[]" value="{{$question->question_resultstatus}}">

                                    </div>
                                </div>
                                </div>  

                                {{-- <div style="text-align: right" class="col-md-12 mb-3" id="evaluate">
                                
                                        <label >تقييم رقمي للاجابة</label>
                                        <input type="text" id="evaluate_textn_{{$question->id}}" style="background-color:OldLace;text-align:right" class="form-control"  name="evaluate_numtext[]" required>
                                        <label >تقييم نصي للاجابة</label>
                                        <input type="text" id="evaluate_textt_{{$question->id}}" style="background-color:OldLace;text-align:right" class="form-control"  name="evaluate_text[]" required>
                                
                                </div>   --}}

                               
                                        
                            </div>
                        @endif 
                        @if($question->question_resultstatus == 4)
                            <div class="row">

                                
                                <div style="text-align: right" class="col-md-12 mb-3">
                                
                                <div class="form-s2" style="text-align:right">
                                    <div>
                                        <label >{{$question->question_text}}</label>
                                        <input   type="file"   style="background-color:OldLace;text-align:right" class="form-control"  name="result_file"   required/>

                                        <input type="hidden"  name="question_id[]" value="{{$question->id}}">
                                        <input type="hidden"  name="question_status[]" value="{{$question->question_resultstatus}}">

                                    </div>
                                </div>
                                </div>  

                                {{-- <div style="text-align: right" class="col-md-12 mb-3" id="evaluate">
                                
                                        <label >تقييم رقمي للاجابة</label>
                                        <input type="text" id="evaluate_textn_{{$question->id}}" style="background-color:OldLace;text-align:right" class="form-control"  name="evaluate_numtext[]" required>
                                        <label >تقييم نصي للاجابة</label>
                                        <input type="text" id="evaluate_textt_{{$question->id}}" style="background-color:OldLace;text-align:right" class="form-control"  name="evaluate_text[]" required>
                                
                                </div>   --}}

                               
                                        
                            </div>
                        @endif
                    @endforeach
                    <input type="hidden" name="user_id" value="{{$user_id}}" >
                    <input type="hidden" name="programtype" value="{{$programtype}}" >
                    <input type="hidden" name="evaluatetype" value="{{$evaluatetype}}" >
  
                    <div style="text-align:right;" class="col-md-12 mb-3">
                        <input value="اتمام التقييم" style="background-color: crimson" type="submit" class="btn btn-primary"  />
                    </div>     
                </form>
            @endif
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
            function senddata(data,id){
              var filter_type = data.target.value;
              var questionid = data.target.nextElementSibling.value;
              $.ajax({
                type: 'GET',
                url: 'GetVoltsRelatedToSpecificType/{type}/{z}',
                data: { type: filter_type , z:questionid  },
                success: function (response) {
                var response = JSON.parse(response);
                console.log(response);   
              //   $('#filtered_volt').empty();
              //   $('#filtered_volt').append(`<option value="0" disabled selected>Select Volt*</option>`);
                response.forEach(element => {
                  //   $('#evaluate_numyesno').append(`<option value="${element['id']}">${element['volt_name']}</option>`);
                      $('#evaluate_numyesno_'+ id).val(`${element['result_numrate']}`);
                      $('#evaluate_textyesno_'+ id).val(`${element['result_textrate']}`);
                  });
                }
              });
            }
              $(document).ready(function () {

      //         $('#result_yesno').on('change', function () {
      //         let filter_type = $(this).val();
      //         let questionid = $('#question_id').val();              
      //       //   $('#filtered_volt').empty();
      //       //   $('#filtered_volt').append(`<option value="0" disabled selected>Processing...</option>`);
      //         $.ajax({
      //           type: 'GET',
      //           url: 'GetVoltsRelatedToSpecificType/{type}/{z}',
      //           data: { type: filter_type , z:questionid  },
      //           success: function (response) {
      //           var response = JSON.parse(response);
      //           console.log(response);   
      //         //   $('#filtered_volt').empty();
      //         //   $('#filtered_volt').append(`<option value="0" disabled selected>Select Volt*</option>`);
      //           response.forEach(element => {
      //             //   $('#evaluate_numyesno').append(`<option value="${element['id']}">${element['volt_name']}</option>`);
      //                 $('#evaluate_numyesno').val(`${element['result_numrate']}`);
      //                 $('#evaluate_textyesno').val(`${element['result_textrate']}`);
      //             });
      //           }
      //         });
      // });
  });
  </script>
  <script>
    function sendnumdata(data,id){
      var filter_type = data.target.value;
      var questionid = data.target.nextElementSibling.value;
      $.ajax({
      type: 'GET',
      url: 'GetResultsRelatedTonumber/{type}/{z}',
      data: { type: filter_type , z:questionid  },
      success: function (response) {
      var response = JSON.parse(response);
      console.log(response);   
    //   $('#filtered_volt').empty();
    //   $('#filtered_volt').append(`<option value="0" disabled selected>Select Volt*</option>`);
      response.forEach(element => {
        //   $('#evaluate_numyesno').append(`<option value="${element['id']}">${element['volt_name']}</option>`);
            $('#evaluate_numvaluenum_'+ id).val(`${element['result_numrate']}`);
            $('#evaluate_numvaluetext_'+ id).val(`${element['result_textrate']}`);
        });
      }
      });
    }
    $(document).ready(function () {
//     $('#result_valuenum').on('input', function () {
//     let filter_type = $(this).val();
//     let questionid = $('#question_idnum').val();

//   //   $('#filtered_volt').empty();
//   //   $('#filtered_volt').append(`<option value="0" disabled selected>Processing...</option>`);
//     $.ajax({
//     type: 'GET',
//     url: 'GetResultsRelatedTonumber/{type}/{z}',
//     data: { type: filter_type , z:questionid  },
//     success: function (response) {
//     var response = JSON.parse(response);
//     console.log(response);   
//   //   $('#filtered_volt').empty();
//   //   $('#filtered_volt').append(`<option value="0" disabled selected>Select Volt*</option>`);
//     response.forEach(element => {
//       //   $('#evaluate_numyesno').append(`<option value="${element['id']}">${element['volt_name']}</option>`);
//           $('#evaluate_numvaluenum').val(`${element['result_numrate']}`);
//           $('#evaluate_numvaluetext').val(`${element['result_textrate']}`);
//       });
//     }
// });
// });
});
</script>
<script>
    function sendtextdata(data,id){
      var filter_type = data.target.value;
      var questionid = data.target.nextElementSibling.value;
      $.ajax({
      type: 'GET',
      url: 'GetResultsRelatedTotext/{type}/{z}',
      data: { type: filter_type , z:questionid  },
      success: function (response) {
      var response = JSON.parse(response);
      console.log(response);   
    //   $('#filtered_volt').empty();
    //   $('#filtered_volt').append(`<option value="0" disabled selected>Select Volt*</option>`);
      response.forEach(element => {
      //   $('#evaluate_numyesno').append(`<option value="${element['id']}">${element['volt_name']}</option>`);
          $('#evaluate_textn_'+ id).val(`${element['result_numrate']}`);
          $('#evaluate_textt_'+ id).val(`${element['result_textrate']}`);
      });
    }
    });
    }
    $(document).ready(function () {
//     $('#result_text').on('change', function () {
//     let filter_type = $(this).val();
//     let questionid = $('#question_idtext').val();              
//   //   $('#filtered_volt').empty();
//   //   $('#filtered_volt').append(`<option value="0" disabled selected>Processing...</option>`);
//     $.ajax({
//     type: 'GET',
//     url: 'GetResultsRelatedTotext/{type}/{z}',
//     data: { type: filter_type , z:questionid  },
//     success: function (response) {
//     var response = JSON.parse(response);
//     console.log(response);   
//   //   $('#filtered_volt').empty();
//   //   $('#filtered_volt').append(`<option value="0" disabled selected>Select Volt*</option>`);
//     response.forEach(element => {
//       //   $('#evaluate_numyesno').append(`<option value="${element['id']}">${element['volt_name']}</option>`);
//           $('#evaluate_textn').val(`${element['result_numrate']}`);
//           $('#evaluate_textt').val(`${element['result_textrate']}`);
//       });
//     }
// });
// });
});
</script>




</body>
</html>
