<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>صفحة الاسئلة الخاصة بالبرنامج المختار</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="UserFront/css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="UserFront/css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="UserFront/css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="UserFront/images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="UserFront/css/jquery.mCustomScrollbar.min.css">
      <link id="pagestyle" href="../Admin/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="UserFront/images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      @include('User.layout.user_header')
      <!-- end header inner -->
      <!-- end header -->
      <!-- banner -->
      <section class="banner_main">
        <div id="banner1" class="carousel slide" data-ride="carousel">
           {{-- <ol class="carousel-indicators">
              <li data-target="#banner1" data-slide-to="0" class="active"></li>
              <li data-target="#banner1" data-slide-to="1"></li>
              <li data-target="#banner1" data-slide-to="2"></li>
           </ol> --}}
           <div class="carousel-inner">
              <div class="carousel-item active">
                 <div class="container">
                    <div class="carousel-caption">
                       <div class="text-bg">
                          <h1> <span class="blu">Welcome <br></span>To Our Self Evaluation System</h1>
                          {{-- <figure><img src="images/banner_img.png" alt="#"/></figure>
                          <a class="read_more" href="#">Shop Now</a> --}}
                       </div>
                    </div>
                 </div>
              </div>
              {{-- <div class="carousel-item">
                 <div class="container">
                    <div class="carousel-caption">
                       <div class="text-bg">
                          <h1> <span class="blu">Welcome <br></span>To Our Sunglasses</h1>
                          <figure><img src="images/banner_img.png" alt="#"/></figure>
                          <a class="read_more" href="#">Shop Now</a>
                       </div>
                    </div>
                 </div>
              </div>
              <div class="carousel-item">
                 <div class="container">
                    <div class="carousel-caption">
                       <div class="text-bg">
                          <h1> <span class="blu">Welcome <br></span>To Our Sunglasses</h1>
                          <figure><img src="images/banner_img.png" alt="#"/></figure>
                          <a class="read_more" href="#">Shop Now</a>
                       </div>
                    </div>
                 </div>
              </div> --}}
           </div>
           
        </div>
      </section>
      <!-- end banner -->
      <!-- about section -->
      
      <!-- end clients section -->
      <!-- contact section -->
      
      <br>
      <br>
      <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <div class="card" style="width: 80%;margin-left:10%;">  
            <div style="text-align:right;" class="card-header">
                <h4>إجراء تقييم</h4>
            </div>
            <div class="card-body" >
                @if($evaluatetype == 1)
                    <form action="{{url('/evaluatetype_redirect')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        

                            @foreach($questions as $question)
                                @if($question->question_resultstatus == 1)
                                    
                                        {{-- <div style="text-align:right;" class="col-md-12 mb-3">
                                        <label>اسم البرنامج</label>
                                            <input  type="text" style="background-color:OldLace;text-align:right" class="form-control"  name="program_name" />
                                            @error('program_name')
                                            <div class="alert alert-danger">
                                            {{$message}}
                                            </div>
                                            @enderror
                                        </div> --}}    
                                    <div class="row">    
                                        <div style="text-align:right;" class="col-md-12 mb-3" >
                                            <label>{{$question->question_text}}</label>
                                            <select style="background-color:OldLace;text-align:right"  name="result_value[]" id="result_yesno" class="form-select" aria-label="Default select example" style="text-align: right" required>
                                                <option value="">اختر اجابتك نعم او لا</option>
                                                <option value="1" style="text-align: right">نعم</option>
                                                <option value="2" style="text-align: right">لا</option>
                                            </select>
                                            @error('program_id')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            <input  type="text" style="background-color:OldLace;text-align:right" class="form-control" value="{{$question->id}}"  name="question_id" id="question_yes" hidden/>
                                        </div>
                                        <div style="text-align:right;" class="col-md-12 mb-3">
                                        <label>تقييم رقمي للاجابة</label>
                                            <input  type="text" style="background-color:OldLace;text-align:right" name="evaluate_num[]" id="evaluate_numyesno" class="form-control"  required />
                                            @error('program_name')
                                            <div class="alert alert-danger">
                                            {{$message}}
                                            </div>
                                            @enderror
                                        </div>   
                                        <div style="text-align:right;" class="col-md-12 mb-3">
                                            <label>تقييم نصي للاجابة</label>
                                            <input  type="text" style="background-color:OldLace;text-align:right" name="evaluate_text[]" id="evaluate_textyesno" class="form-control"  required />
                                            @error('program_name')
                                            <div class="alert alert-danger">
                                            {{$message}}
                                            </div>
                                            @enderror
                                        </div>   
                                        {{-- <div style="text-align:right;" class="col-md-12 mb-3" >
                                            <label>اختر اسم البرنامج</label>
                                            <select style="background-color:OldLace;text-align:right"  name="programtype" class="form-select" aria-label="Default select example" style="text-align: right" required>
                                            <option value="">اختر برنامج</option>
                                            @foreach ($programs as $program)
                                                <option value="{{$program->id}}" >{{$program->program_name}}</option>
                                            @endforeach
                                            
                                            </select>
                                            @error('program_id')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>   --}}
                                        
                                        
                                        
                                                
                                    </div>
                                @endif
                                @if($question->question_resultstatus == 2)
                                    <div class="row">
                                        <div style="text-align:right;" class="col-md-12 mb-3">
                                        <label>{{$question->question_text}}</label>
                                        <input  type="text" style="background-color:OldLace;text-align:right" class="form-control"  name="result_value[]" id="resultnum" placeholder="ضع اجابتك برقم "/>
                                        @error('program_name')
                                        <div class="alert alert-danger">
                                        {{$message}}
                                        </div>
                                        @enderror
                                        </div>
                                        <div style="text-align:right;" class="col-md-12 mb-3">
                                            <label>تقييم رقمي للاجابة</label>
                                                <input  type="text" style="background-color:OldLace;text-align:right" name="evaluate_num[]" id="evaluate_numvaluenum" class="form-control"  required />
                                                @error('program_name')
                                                <div class="alert alert-danger">
                                                {{$message}}
                                                </div>
                                                @enderror
                                        </div>   
                                        <div style="text-align:right;" class="col-md-12 mb-3">
                                                <label>تقييم نصي للاجابة</label>
                                                <input  type="text" style="background-color:OldLace;text-align:right" name="evaluate_text[]" id="evaluate_textvaluenum" class="form-control"  required />
                                                @error('program_name')
                                                <div class="alert alert-danger">
                                                {{$message}}
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                @endif
                                @if($question->question_resultstatus == 3)
                                    <div class="row">   
                                        <div style="text-align:right;" class="col-md-12 mb-3" >
                                            <label>{{$question->question_text}}</label>
                                            <select style="background-color:OldLace;text-align:right"  name="result_value[]" id="result_text" class="form-select" aria-label="Default select example" style="text-align: right" required>
                                                @foreach($question->result as $result)
                                                <option value="" >اختر اجابتك نص</option>
                                                <option value="{{$result->id}}" >{{$result->result_value}}</option>
                                                @endforeach
                                            </select>
                                            <input  type="text" style="background-color:OldLace;text-align:right" class="form-control" value="{{$question->id}}"  name="question_id" id="question_text" hidden/>
                                        </div>    
                                        <div style="text-align:right;" class="col-md-12 mb-3">
                                            <label>تقييم رقمي للاجابة</label>
                                            <input  type="text" style="background-color:OldLace;text-align:right" name="evaluate_num[]" id="evaluate_numvaluetextnum" class="form-control"  required />
                                            @error('program_name')
                                            <div class="alert alert-danger">
                                            {{$message}}
                                            </div>
                                            @enderror
                                        </div>   
                                        <div style="text-align:right;" class="col-md-12 mb-3">
                                            <label>تقييم نصي للاجابة</label>
                                            <input  type="text" style="background-color:OldLace;text-align:right" name="evaluate_text[]" id="evaluate_textvaluetexttext" class="form-control"  required />
                                            @error('program_name')
                                            <div class="alert alert-danger">
                                            {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    
                                        
                                    </div>            
                                @endif  
                            @endforeach 
                        </div>   
                        <input  type="text" style="background-color:OldLace;text-align:right" name="user_id" value="{{$user_id}}"  class="form-control" hidden />
                        <input  type="text" style="background-color:OldLace;text-align:right" name="programtype" value="{{$programtype}}"  class="form-control" hidden />
                        <input  type="text" style="background-color:OldLace;text-align:right" name="evaluatetype" value="{{$evaluatetype}}"  class="form-control" hidden />
                        <div style="text-align:right;" class="col-md-12 mb-3">
                            <input value="اتمام" style="background-color: crimson" type="submit" class="btn btn-primary"  name="image" />
                        </div>
                    </form>
                @endif
            </div>
        </div> 
      </main>   
      <br>
      <br>
      <!-- end contact section -->
      <!--  footer -->
      @include('User.layout.user_footer')
      <!-- end footer -->
      <!-- Javascript files-->
      @include('User.layout.user_script')
      <!-- google map js -->
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script>
      <!-- end google map js --> 
      <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
      <script>
        $(document).ready(function () {
        $('#result_yesno').on('change', function () {
        let filter_type = $(this).val();
        let question_id =  $('#question_yes').val();
    

        $.ajax({
        type: 'GET',
        url: 'GetVoltsRelatedToSpecificType/{type}/{questionid}',
        data: {type:filter_type , questionid:question_id}
        success: function (response) {
        var response = JSON.parse(response);
        console.log(response);                   
        response.forEach(element => {
           $("#evaluate_numyesno").val(`${element['result_numrate']}`);
           $("#evaluate_textyesno").val(`${element['result_textrate']}`);
       // $('#yes_divnum').append(`<input type="text" value="${element['result_numrate']}" class="form-control" required>`);
        //    $("#evaluate_num").val(${element['result_numrate']});
        //    $("#evaluate_text").val(${element['result_textrate']});
            // $('#evaluate_num').val() = ${element['result_numrate']};
            // $('#evaluate_text').val()= ${element['result_textrate']};
            });
        }
    });
});
});
</script> 
<script>
    $(document).ready(function () {
    $('#result_text').on('change', function () {
    let filter_type = $(this).val();
    let question_id =  $('#question_text').val();


    $.ajax({
    type: 'GET',
    url: 'GetResultsRelatedTotext/{type}/{questionid}',
    data: {type:filter_type , questionid:question_id}
    success: function (response) {
    var response = JSON.parse(response);
    console.log(response);                   
    response.forEach(element => {
       $("#evaluate_numvaluetextnum").val(`${element['result_numrate']}`);
       $("#evaluate_textvaluetexttext").val(`${element['result_textrate']}`);
   // $('#yes_divnum').append(`<input type="text" value="${element['result_numrate']}" class="form-control" required>`);
    //    $("#evaluate_num").val(${element['result_numrate']});
    //    $("#evaluate_text").val(${element['result_textrate']});
        // $('#evaluate_num').val() = ${element['result_numrate']};
        // $('#evaluate_text').val()= ${element['result_textrate']};
        });
    }
});
});
});
</script> 
   </body>
</html>

