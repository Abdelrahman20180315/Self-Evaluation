<!DOCTYPE html>
<html lang="en">
    <head>
    @include('Employee.layout.header')
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
    
	@include('Employee.layout.navbar')
	

    <!--form-->
    <div style="margin-top: 100px;margin-bottom: 50px;"  class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="contact_form">
                <div id="message"></div>
                <form id="contactform" class="row" action="{{url('store_paper')}}" name="contactform" method="POST">
                        <fieldset class="row-fluid">
                            <label class="sr-only">قلم المحضرين</label>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <textarea class="form-control" name="minutes_pen" id="comments" rows="6" placeholder="قلم المحضرين" required></textarea>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="sr-only">اختراسم الموكل</label>
                            <select name="name" id="select_service" class="selectpicker form-control" data-style="btn-white" required>
                                <option value="اختر كود الموكل">اختراسم الموكل</option>
                                @foreach ($data as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="sr-only">تاريخ الاستلام</label>
                            <input type="text" name="recieve_time" id="first_name" class="form-control" placeholder="تاريخ التسليم" required>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="sr-only">تاريخ الجلسة</label>
                            <input type="text" name="session_time" id="last_name" class="form-control" placeholder="تاريخ الجلسة" required>
                        </div>
                        
                        
                        
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                            <button type="submit" value="SEND" id="submit" class="btn btn-light btn-radius btn-brd grd1 btn-block">Submit</button>
                        </div>
                    </fieldset>
                </form>
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
                            <img src="employee_css/images/logos/logo-2.png" alt="" />
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
    <script src="{{asset('employee_css/js/all.js')}}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{asset('employee_css/js/custom.js')}}"></script>
    <script src="{{asset('employee_css/js/portfolio.js')}}"></script>
    <script src="{{asset('employee_css/js/hoverdir.js')}}"></script>    

</body>
</html>