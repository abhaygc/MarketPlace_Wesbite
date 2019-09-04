<?php
require_once "config.php";
$sent=false;
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$today = date("d/m/Y");
        // Prepare an insert statement
        $sql = "INSERT INTO feedback (fid,name,email,phone_number,description,date_added,status) VALUES (?, ?, ?, ?, ?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql))
        {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_fid, $param_name,$param_email,$param_phone,$param_message,$param_date,$param_status);
            
            // Set parameters
            $param_fid = uniqid();
            $param_name = trim($_POST['name']);
            $param_email = trim($_POST['email']);
            $param_phone=trim($_POST['mobile']);
            $param_message=trim($_POST['message']);
            $param_date=$today;
            $param_status="SENT";

            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
            {
                // Redirect to login page
                
                $sent=true;
            } 
            else
            {
                echo "Something went wrong. Please try again later.";
                
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    
    
	}
?>
<html>

<head>
	<title>Shraddha Enterprises</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="Machined a Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
	<!-- Slider -->
	<link rel="stylesheet" href="css/mainStyles.css" />
	<!-- //Slider -->
	<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css' />
	<link href='css/simplelightbox.min.css' rel='stylesheet' type='text/css'>
	<link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Raleway:400,500,700,800,900" rel="stylesheet">
	<script src="js/sweetalert2.all.min.js"></script>
</head>

<body>
<?php

	if ($sent)
	{
		
          echo "<script type='text/JavaScript'>swal({
                      type: 'success',
                      title: 'FeedBack Sent!',
                      showConfirmButton: true,
                      confirmButtonText: 'Okay',
                      
                    });</script>";
      

	}

?>


	<!-- banner -->
	<div class="header">

		<div class="w3layouts_header_right">
			<div class="detail-w3l">
				<ul>
					<li>
						<i class="fas fa-phone"></i>+91 98765 43210</li>

				</ul>
			</div>

		</div>

		<div class="agileits-social top_content">
			<ul>
				<li>
					<a href="#">
						<i class="fab fa-facebook-f"></i>
					</a>
				</li>
				<li>
					<a href="#">
						<i class="fab fa-twitter"></i>
					</a>
				</li>
				
				
			</ul>
		</div>
		

		<div class="clearfix"> </div>
	</div>

	<div class="top_heder_agile_info">
		<div class="w3ls_agile_header_inner">
			<nav class="navbar navbar-default">
				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<nav class="menu menu--juliet">
						<ul class="nav navbar-nav">
							<li>
								<a href="index.html">Home</a>
							</li>
							<li>
								<a href="services.html">Services</a>
							</li>
							<li>
								<a href="projects.html">Products</a>
							</li>
							
							<li class="active">
								<a href="contact.html">Contact</a>
							</li>

						</ul>

					</nav>
				</div>
			</nav>

		</div>
		<div class="w3_logo">

			<h1><a class="navbar-brand" href="index.html" style="font-size:22px">SHRADDHA ENTERPRISES</a></h1>
		</div>
		<div class="agileinfo_social_icons">
			

<a href="login.php"><button type="button" class="btn btn-primary btn-lg" >LOGIN</button></a>

<a href="register.php"><button type="button" class="btn btn-primary btn-lg" >REGISTER</button></a>
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">Please Login Here</h4>
						</div>
						<div class="modal hide" id="myModal">

							<button type="button" class="close" data-dismiss="modal">x</button>
						</div>
						<div class="modal-body" align="center">
							<form method="post" action='' name="login_form" align="center">
								<label>User Name
									<span class="w3-star"> * </span>
								</label>
								<p>
									<input type="text" class="span3" name="Name" id="text" placeholder="Name" required="">
								</p>
								<label>PassWord
									<span class="w3-star"> * </span>
								</label>
								<p>
									<input type="password" class="span3" name="password" placeholder="password" required="">
								</p>
								<input type="submit" value="login">

							</form>
						</div>

					</div>

				</div>
			</div>
					<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
	
		
	</div>

	<!-- //banner -->

	<!-- Slider-->
	<div class="banner1">

	</div>
	<!-- /Slider-->

	<!-- short -->
	<div class="services-breadcrumb">
		<div class="inner_breadcrumb">
			<ul class="short_ls">
				<li>
					<a href="index.html">Home</a>
					<span>| |</span>
				</li>
				<li><b>Contact</b></li>
			</ul>
		</div>
	</div>
	<!-- //short-->





	<!-- contact -->
	<div class="w3ls-contact" id="contact">
		<h3>Any FeedBack</h3>
		<p>To Know More About Our Services Please Contact Us Directly Or Fill The Form Below</p>
		<div class="container">

			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<div class="form-input">
					<label>Name
						<span class="w3-star"> * </span>
					</label>
					<input type="text" name="name" placeholder="Your Name" required>
				</div>
				<div class="form-input">
					<label>Email
						<span class="w3-star"> * </span>
					</label>
					<input type="email" name="email" placeholder="Your Email" required>
				</div>
				<div class="form-input">
					<label>Phone
						<span class="w3-star"> * </span>
					</label>
					<input type="numeric" name="mobile" placeholder="Phone Number" required>
				</div>
				<div class="form-textarea">
					<label>Message
						<span class="w3-star"> * </span>
					</label>
					<textarea name="message" placeholder="Your Message" rows="5" cols="20" required></textarea>
				</div>
				<div class="w3_ip">
					<input type="Submit" name="submit" value="Submit Message">
				</div>
			</form>

		</div>

	</div>
	</div>
	<!-- //contact -->

	<!-- footer -->
	<div class="footer_top_agileits">
		<div class="container">
			<div class="col-md-4 col-sm-4 footer_grid">
				<h3>About Us</h3>
				<p>No matter how time may change, machines will never have creativity. Creativity only exists in people who can be fascinated and can grow.
				</p>
				<div class="map">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.30591910525!2d-74.25986432970718!3d40.697149422113014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1518176526743"
					    allowfullscreen></iframe>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 footer_grid">
				<h3>Contact Info</h3>
				<ul class="address">
					<li>
						<i class="fa fa-map-marker" aria-hidden="true"></i><br><br>Shraddha Enterprises,<br> B-4 Patil Industrial Estate near Sagar Engineering Works,<br> Pokhran Road no.1,<br> Upvan Thane-West<br>
						<span></span>
					</li>
					<li>
						<i class="fa fa-envelope" aria-hidden="true"></i><br><br>
						<a href="mailto:anilgadling@gmail.com">anilgadling@gmail.com</a>
					</li>
					<li>
						<i class="fa fa-phone" aria-hidden="true"></i><br><br>+91 87808 89436</li>
				</ul>

			</div>
			<div class="col-md-4 col-sm-4 footer_grid">
				<h3>Follow Us</h3>
				<div class="wrapper">
					<ul class="social-icons icon-circle icon-zoom list-unstyled list-inline">
						<li>
							<a href="#">
								<i class="fab fa-facebook-f"></i>
							</a>
						</li>
						
						<li>
							<a href="#">
								<i class="fab fa-google-plus-g"></i>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fab fa-twitter"></i>
							</a>
						</li>
					</ul>
				</div>
				<div class="w3ls_links">
					<h3>Quick Links</h3>
					<ul>
						<li class="active">
							<a href="index.html">Home</a>
						</li>
						<li>
							<a href="services.html">Services</a>
						</li>
						<li>
							<a href="projects.html">Products</a>
						</li>
						<li>
							<a href="contact.html">Contact</a>
						</li>
						
						<li>
							<a href="about.html">About</a>
						</li>
					</ul>
				</div>
			</div>



			<div class="clearfix"> </div>


		</div>
		<div class="footer_w3ls">

			<div class="footer_bottom1">
				<br><br><p>© 2018 Shraddha Enterprises. All rights reserved | Design by Rohit Thombre
				</p>
			</div>

		</div>
		<!-- //footer -->

		<script src="js/jquery.min.js"></script>
				<script src="js/bootstrap.min.js"></script>
		<script src="js/move-top.js"></script>
		<script src="js/easing.js"></script>
		<script src="js/SmoothScroll.min.js"></script>

		<!-- Slider Script-->
		<script src="js/rgbSlide.min.js"></script>
		<script src="js/mainScript.js"></script>
		<!--/ Slider Script-->
		<!--tabs-->
		<script src="js/easy-responsive-tabs.js"></script>
		<script>
			$(document).ready(function () {
				$('#horizontalTab').easyResponsiveTabs({
					type: 'default', //Types: default, vertical, accordion           
					width: 'auto', //auto or any width like 600px
					fit: true, // 100% fit in a container
					closed: 'accordion', // Start closed if in accordion view
					activate: function (event) { // Callback function if tab is switched
						var $tab = $(this);
						var $info = $('#tabInfo');
						var $name = $('span', $info);
						$name.text($tab.text());
						$info.show();
					}
				});
				$('#verticalTab').easyResponsiveTabs({
					type: 'vertical',
					width: 'auto',
					fit: true
				});
			});
		</script>
		<!--//tabs-->
		<!-- Testimonials-->
		<marquee behavior="scroll" direction="up" onmouseover="this.stop();" onmouseout="this.start();">
			<!-- /Testimonials-->
			<script type="text/javascript" src="js/simple-lightbox.min.js"></script>
			<script>
				$(function () {
					var gallery = $('.agileinfo-gallery-row a').simpleLightbox({
						navText: ['&lsaquo;', '&rsaquo;']
					});
				});
			</script>
			<!-- start-smoth-scrolling -->
			<script type="text/javascript">
				$(document).ready(function () {
					/*
						var defaults = {
						containerID: 'toTop', // fading element id
						containerHoverID: 'toTopHover', // fading element hover id
						scrollSpeed: 1200,
						easingType: 'linear' 
						};
					*/

					$().UItoTop({
						easingType: 'easeOutQuart'
					});

				});
			</script>
			<!-- scrolling script -->
			<script type="text/javascript">
				jQuery(document).ready(function ($) {
					$(".scroll").click(function (event) {
						event.preventDefault();
						$('html,body').animate({
							scrollTop: $(this.hash).offset().top
						}, 1000);
					});
				});
			</script>
			<!-- //scrolling script -->
			<!--//start-smoth-scrolling -->

</body>

</html>