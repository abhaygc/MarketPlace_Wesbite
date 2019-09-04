<?php
	require_once "config.php";
  $sent=false;
	session_start();
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
	{
	    
	   
	}
	else
	{
		header("location: login.php");
	    exit;
	}
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $today = date("d/m/Y");
        // Prepare an insert statement
        $sql = "INSERT INTO query (qid,cid,name,email,phone_number,subject,description,date_added,status) VALUES (?,?,?,?,?, ?, ?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql))
        {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_fid,$param_uid,$param_name,$param_email,$param_phone,$param_subject,$param_message,$param_date,$param_status);
            
            // Set parameters
            $param_fid = uniqid();
            $param_uid = $_SESSION["user_id"] ;
            $param_name = trim($_POST['name']);
            $param_email = trim($_POST['email']);
            $param_phone=trim($_POST['mobile']);
            $param_subject=trim($_POST['subject']);
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
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="user_home.css?<?=filemtime("user_home.css")?>" rel="stylesheet" type="text/css" />
	<script src="js/sweetalert2.all.min.js"></script>

	
	<link href="//fonts.googleapis.com/css?family=Raleway:400,500,700,800,900" rel="stylesheet">
	<style type="text/css">
		:focus::placeholder{
			opacity: 0;
		 }
		 ::placeholder{
		 	color: grey !important;
		 	font-size: 20px;
		 	opacity: 0;
		 }

  
	    .nav-item > a > span 
	    {
	        color: #212121;
	        
	    }
	    .nav-item > a > span:hover 
	    {
	        color: #b06010;
	        outline:none;
	    }
	</style>
	

	<title>Query</title>
</head>
<body>
  <?php

  if ($sent)
  {
    
          echo "<script type='text/JavaScript'>swal({
                      type: 'success',
                      title: 'Query Sent!',
                      showConfirmButton: true,
                      confirmButtonText: 'Okay',
                      
                    });</script>";
      

  }

?>

<nav class="navbar navbar-expand-md  fixed-top navbar-light header" style="background-color: white;border-bottom-style: solid;border-bottom-color: rgba(0,0,0,.5);border-bottom-width: 1px;font-size: 1em;height: 3.125emem;padding-top: 12px;padding-bottom: 12px" >
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link py-0" href="user_home.php" style="font-weight: 600;letter-spacing: 1px;"><span>Home</span></a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link py-0" href="user_orders.php" style="font-weight: 600;letter-spacing: 1px;"><span>Ongoing Orders</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-0" href="#" style="font-weight: 600;letter-spacing: 1px;"><span style="color: #b06010;">Query</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-0" href="feedback.php" style="font-weight: 600;letter-spacing: 1px;"><span>Feedback</span></a>
            </li>
            
        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto py-0" href="#" style="font-weight: 600;font-size: 1.5em;line-height: 22px;letter-spacing: 2px;padding: 16px 0 0 0;">SHRADDHA ENTERPRISE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link py-0" href="cart.php" style="font-weight: 600;letter-spacing: 1px;"><span>Cart <span class="badge badge-primary" id="cart_count" ><?php if (isset($_SESSION['cart_count'])) {echo $_SESSION['cart_count'];} ?></span></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-0" href="user_prev_orders.php" style="font-weight: 600;letter-spacing: 1px;"><span>Previous Orders</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-0" href="account_details.php" style="font-weight: 600;letter-spacing: 1px;"><span>Account</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-0" href="logout.php" style="font-weight: 600;letter-spacing: 1px;"><span>Logout</span></a>
            </li>
        </ul>
    </div>
</nav>

<br/>
<!----------------------------------------------------------------------------------------------------------------------------------->
<div class="row w-100" style="padding-left: 4em;">
          

<!-- contact -->
  <div class="container-fluid w-100 mx-auto" id="contact" style="margin-top: 2em;">
    <h3 class="text-center mx-auto">Query Form</h3>
    <p class="text-center mx-auto">To Know More About Our Services Please Contact Us Directly Or Fill The Form Below</p>
    <div class="container">

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-input font-weight-bold">
          <label>Name
            <span style="color: red;"> * </span>
          </label>
          <input type="text" class="form-control col-5" name="name" placeholder="Your Name" required>
        </div>
        <div class="form-input font-weight-bold">
          <label>Email
            <span style="color: red;"> * </span>
          </label>
          <input type="email" class="form-control col-5" name="email" placeholder="Your Email" required>
        </div>
        <div class="form-input font-weight-bold">
          <label>Phone
            <span style="color: red;"> * </span>
          </label>
          <input type="text" class="form-control col-5" name="mobile" placeholder="Phone Number" required>
        </div>
        <div class="form-input font-weight-bold">
          <label>Subject
            <span style="color: red;"> * </span>
          </label>
          <input type="text" class="form-control col-5" name="subject" placeholder="Subject" required>
        </div>
        <div class="form-textarea font-weight-bold">
          <label>Message
            <span style="color: red;"> * </span>
          </label>
          <textarea name="message" class="form-control col-8" placeholder="Your Message" rows="5" cols="10" required></textarea>
        </div>

        <div class="w3_ip" style="margin-top: 1.2em;">
          <button type="Submit" class="btn btn-primary">Submit Message</button>
        </div>
      </form>

    </div>

  </div>
  </div>
  <!-- //contact -->
  </div>
</body>
<script type='text/JavaScript' src='user_home.js?<?=filemtime("user_home.js")?>'></script>
</html>  