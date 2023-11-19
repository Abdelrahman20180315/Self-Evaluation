<!DOCTYPE html>
<html lang="en">
    <head>
    @include('User.layout.header')
    <title>صفحة الاسئلة التابعة للبرنامج</title>  
    {{-- <script src="http://code.jquery.com/jquery-3.4.1.js"></script> --}}

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}
    <script src="http://code.jquery.com/jquery-3.4.1.js"></script> 
    {{-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
          </script> --}}


    </head>
<body>

    <!-- LOADER -->
    <div id="preloader">
        <div class="loader">
			<div class="loader__bar"></div>
			<div class="loader__bar"></div>
			<div class="loader__bar"></div>
			<div class="loader__bar"></div>
			<div class="loader__bar"></div>
			<div class="loader__ball"></div>
		</div>
    </div><!-- end loader -->
    <!-- END LOADER -->
    
	@include('User.layout.navbar')
	

    <!--form-->
    <div style="margin-top: 100px;margin-bottom: 50px;"  class="row">
        <div class="col-md-8 col-md-offset-2">
           {{-- @livewire('evaluationquestions', ['user_id' => $user_id,'evaluatetype' => $evaluatetype,'programtype' => $programtype,'questions' => $questions]) --}}
        
           <div class="contact_form">
            
            <div id="message"></div>
                @if($evaluatetype == 1) 
                    
                        <form  class="row" action="{{url('')}}" name="contactform" method="POST">
                            @csrf
                            <fieldset class="row-fluid" >
                                @foreach($questions as $question)
                                    @if($question->question_resultstatus == 1)
                                        
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: right">
                                            <label style="text-align: right">{{$question->question_text}}</label>
                                            <select name="result_value[]" id="result_yes" style="text-align: right"  class="selectpicker form-control" data-style="btn-white"  required>
                                                <option value="" style="text-align: right">اختر نعم او لا</option>
                                                <option value="1" style="text-align: right">نعم</option>
                                                <option value="2" style="text-align: right">لا</option>
                                            </select>
                                            <input type="hidden" name="question_id" value="{{$question->id}}" id="question_yes" class="form-control"  >
                                        </div>
                                        
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: right" id="yes_divnum">
                                            <label style="text-align: right">تقييم رقمي للاجابة</label>
                                        </div>
                                         
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: right" id="yes_divtext">
                                            <label style="text-align: right">تقييم نصي للاجابة</label>
                                            <input type="text" name="evaluate_text[]" id="evaluate_text" value="" class="form-control" placeholder="" required>
                                        </div>
                                    
                                    @endif
                                    @if($question->question_resultstatus == 2)
                                        
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: right">
                                            <label style="text-align: right">{{$question->question_text}}</label>
                                            <input type="text" name="result_value[]" style="text-align: right" id="first_name" class="form-control" placeholder="ادخل رقم" required>
                                            <input type="hidden" name="question_id" value="{{$question->id}}" id="first_name" class="form-control"  >
                                        </div>
                                        {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                            <label class="sr-only">اختر نوع التقييم</label> 
                                            <select name="evaluatetype" id="select_service"  class="selectpicker form-control" data-style="btn-white"  required>
                                                <option value="" style="text-align: right">اختر نوع التقييم</option>
                                                <option value="1" style="text-align: right">تقييم ذاتي</option>
                                                <option value="2" style="text-align: right">تقييم فعلي</option>
                                            </select>
                                        </div> --}}
                                        {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                            <label class="sr-only">اختر البرنامج</label> 
                                            <select name="programtype" id="select_service"  class="selectpicker form-control" data-style="btn-white"  required>
                                                <option value="" style="text-align: right">اختر برنامج</option>
                                                @foreach ($programs as $program)
                                                <option value="{{$program->id}}" style="text-align: right">{{$program->program_name}}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div> --}}
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: right">
                                            <label style="text-align: right">تقييم رقمي للاجابة</label>
                                            <input type="text" name="evaluate_num[]" id="first_name" class="form-control" placeholder="" required>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: right">
                                            <label style="text-align: right">تقييم نصي للاجابة</label>
                                            <input type="text" name="evaluate_text[]" id="first_name" class="form-control" placeholder="" required>
                                        </div>
                                    
                                    @endif
                                    @if($question->question_resultstatus == 3)
                                        
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: right">
                                            <label style="text-align: right">{{$question->question_text}}</label>
                                            <select name="result_value[]" id="select_service"  class="selectpicker form-control" data-style="btn-white"  required>
                                                @foreach($question->result as $result)
                                                <option value="" style="text-align: right">اختر نص</option>
                                                <option value="{{$result->id}}" style="text-align: right">{{$result->result_value}}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="question_id" value="{{$question->id}}" id="first_name" class="form-control"  >
                                        </div>
                                        {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                            <label class="sr-only">اختر نوع التقييم</label> 
                                            <select name="evaluatetype" id="select_service"  class="selectpicker form-control" data-style="btn-white"  required>
                                                <option value="" style="text-align: right">اختر نوع التقييم</option>
                                                <option value="1" style="text-align: right">تقييم ذاتي</option>
                                                <option value="2" style="text-align: right">تقييم فعلي</option>
                                            </select>
                                        </div> --}}
                                        {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                            <label class="sr-only">اختر البرنامج</label> 
                                            <select name="programtype" id="select_service"  class="selectpicker form-control" data-style="btn-white"  required>
                                                <option value="" style="text-align: right">اختر برنامج</option>
                                                @foreach ($programs as $program)
                                                <option value="{{$program->id}}" style="text-align: right">{{$program->program_name}}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div> --}}
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: right">
                                            <label style="text-align: right">تقييم رقمي للاجابة</label>
                                            <input type="text" name="evaluate_num[]" id="first_name" class="form-control" placeholder="" required>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: right">
                                            <label style="text-align: right">تقييم نصي للاجابة</label>
                                            <input type="text" name="evaluate_text[]" id="first_name" class="form-control" placeholder="" required>
                                        </div>
                                    
                                    @endif
                                       
                                @endforeach  
                                <input type="hidden" name="user_id" value="{{$user_id}}" id="first_name" class="form-control"  >
                                <input type="hidden" name="programtype" value="{{$programtype}}" id="first_name" class="form-control"  >
                                <input type="hidden" name="evaluatetype" value="{{$evaluatetype}}" id="first_name" class="form-control" >
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                                    <button type="submit" value="SEND" id="submit" class="btn btn-light btn-radius btn-brd grd1 btn-block">Submit</button>
                                </div>                         
                            </fieldset>
                        </form>
                    
                @endif    
           </div>
        </div><!-- end col -->
    </div><!-- end row -->
	<!--end form-->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <img src="user_front/images/logos/logo-2.png" alt="" />
                        </div>
                        <p> Integer rutrum ligula eu dignissim laoreet. Pellentesque venenatis nibh sed tellus faucibus bibendum. Sed fermentum est vitae rhoncus molestie. Cum sociis natoque penatibus et magnis dis montes.</p>
                        <p>Sed fermentum est vitae rhoncus molestie. Cum sociis natoque penatibus et magnis dis montes.</p>
                    </div><!-- end clearfix -->
                </div><!-- end col -->

				<div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Pages</h3>
                        </div>

                        <ul class="footer-links hov">
                            <li><a href="#">Home <span class="icon icon-arrow-right2"></span></a></li>
							<li><a href="#">Blog <span class="icon icon-arrow-right2"></span></a></li>
							<li><a href="#">Pricing <span class="icon icon-arrow-right2"></span></a></li>
							<li><a href="#">About <span class="icon icon-arrow-right2"></span></a></li>
							<li><a href="#">Faq <span class="icon icon-arrow-right2"></span></a></li>
							<li><a href="#">Contact <span class="icon icon-arrow-right2"></span></a></li>
                        </ul><!-- end links -->
                    </div><!-- end clearfix -->
                </div><!-- end col -->
				
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="footer-distributed widget clearfix">
                        <div class="widget-title">
                            <h3>Subscribe</h3>
							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which one know this tricks.</p>
                        </div>
						
						<div class="footer-right">
							<form method="get" action="#">
								<input placeholder="Subscribe our newsletter.." name="search">
								<i class="fa fa-envelope-o"></i>
							</form>
						</div>                        
                    </div><!-- end clearfix -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </footer><!-- end footer -->

    <div class="copyrights">
        <div class="container">
            <div class="footer-distributed">
                <div class="footer-left">                   
                    <p class="footer-company-name">All Rights Reserved. &copy; 2018 <a href="#">GoodWEB</a> Design By : 
					<a href="https://html.design/">html design</a></p>
                </div>

                
            </div>
        </div><!-- end container -->
    </div><!-- end copyrights -->

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    <!-- ALL JS FILES -->
    <script src="{{asset('user_front/js/all.js')}}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{asset('user_front/js/custom.js')}}"></script>
    <script src="{{asset('user_front/js/portfolio.js')}}"></script>
    <script src="{{asset('user_front/js/hoverdir.js')}}"></script> 
    


     {{-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
           </script>   --}}
    <script>
                $(document).ready(function () {
                $('#result_yes').on('change', function () {
                let filter_type = $(this).val();
                let question_id =  $('#question_yes').val();
                // let evaluate_numvalue;
                // let evaluate_textvalue;

                $.ajax({
                type: 'GET',
                url: 'GetVoltsRelatedToSpecificType/{type}/{questionid}',
                data: {type:filter_type , questionid:question_id}
                success: function (response) {
                var response = JSON.parse(response);
                console.log(response);                   
                response.forEach(element => {
                //    $("#evaluate_num").val(`${element['result_numrate']}`);
                //    $("#evaluate_text").val(`${element['result_textrate']}`);
                $('#yes_divnum').append(`<input type="text" value="${element['result_numrate']}" class="form-control" required>`);
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