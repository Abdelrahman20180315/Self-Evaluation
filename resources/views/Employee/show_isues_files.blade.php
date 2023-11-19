<!DOCTYPE html>
<html lang="en">
    <head>
    @include('Employee.layout.header')
    <style>
        #customers {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
         
        }
        
        #customers td, #customers th {
          border: 1px solid #ddd;
          padding: 8px;
          border-radius: 70px 30px ;
        }
        
        #customers tr:nth-child(even){background-color: #f2f2f2;}
        
        #customers tr:hover {background-color: #ddd;}
        
        #customers th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          
          background-color: rgb(255, 115, 0);
          color: white;
        }
        </style>
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
                <table id="customers">
                    <tr>
                        <th style="text-align: center" >المحكمة-الدائرة-رقم الدعوة</th>
                        <th style="text-align: center" >كود الموكل</th>
                        <th style="text-align: center" >اسم الموكل</th>
                        <th style="text-align: center" >صفة الموكل</th>
                        <th style="text-align: center" >الخصم وصفتة</th>
                        <th style="text-align: center" >الجلسة السابقة</th>
                        <th style="text-align: center" >القرار</th>
                        <th style="text-align: center" >اكشن</th>
                    </tr>
                    @if ($data)
                        @foreach ($data as $item)
                            <tr>
                                <td>{{$item->court}}</td>
                                <td>{{$item->user_code}}</td>
                                <td>{{$item->user_name}}</td>
                                <td>{{$item->user_details}}</td>
                                <td>{{$item->enemy_details}}</td>
                                <td>{{$item->last_session}}</td>
                                <td>{{$item->decision}}</td>
                                <td><a href="{{url('issue_delet/'.$item->id)}}" > <button style="background-color: rgb(255, 60, 0)" class="btn btn-primary" >حذف</button> </a></td>
                                
                            </tr>
                        @endforeach
                    @endif
                
                    
                  </table>
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