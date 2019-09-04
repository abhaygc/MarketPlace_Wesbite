<?php

session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: user_home.php");
    exit;
}



// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$big_error="Nothing";
$ownername = $orgname = $email = $phone = $password = $confirm_password = "";
$address = $state = $city =$pin_code ="";
$ownername_error = $orgname_error = $email_error = $phone_error = $password_error = $confirm_password_error = "";
$address_error = $state_error = $city_error =$pin_code_error ="";
$error = False;
//Variables done
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
//Validate owner
	/*
	$data = file_get_contents('php://input');
	echo var_dump($data);
	echo var_dump($_POST);
	echo " OLA456 ";
	echo trim($_POST["phone"]);
	*/
	if(empty(trim($_POST["owner_name"]))){
	        $phone_error = "Please enter Owner Name.";
	        $error = True;
	    } 
	 else
	 {
	 	$ownername = trim($_POST["owner_name"]);
	 	//echo $ownername;
	 }
//Validate owner complete 	
//Validate Org
	if(empty(trim($_POST["org_name"]))){
	        $orgname_error = "Please enter Organisation Name.";
	        $error = True;
	    } 
	 else
	 {
	 	$orgname = trim($_POST["org_name"]);
	 	//echo $orgname;
	 }
//Validate Org complete 	
// Validate EMAIL
    if(empty(trim($_POST["email"]))){
        $email_error = "Please enter Email ID.";
        $error = True;
    } else{
        // Prepare a select statement
        $sql = "SELECT user_id FROM accounts WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_error = "This Email ID is already taken.";
                    
                    $error = True;
                } else{
                    $email = trim($_POST["email"]);
                    //echo $email;
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
                $error = True;
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
//EMAIL COMPLETE
//VALIDATE PHONE

    if(empty(trim($_POST["phone"]))){
        $phone_error = "Please enter Phone Number.";
        $error = True;
        
    } 
    elseif (strlen(trim($_POST["phone"]))!=10) {
    	$phone_error = "Please enter a Valid Phone Number.";

    	$error = True;
    	
    }
    else{
        // Prepare a select statement
        $sql = "SELECT user_id FROM accounts WHERE phone = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_phone);
            
            // Set parameters
            $param_phone = trim($_POST["phone"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $phone_error = "This Phone Number is already taken.";
                    $error = True;
                } else{
                    $phone = trim($_POST["phone"]);
                    //echo $phone;
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
                $error = True;
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
//PHONE COMPLETE
//PASSWORD validate  
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_error = "Please enter a password.";     
        $error = True;
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_error = "Password must have atleast 6 characters.";
        $error = True;
    } else{
        $password = trim($_POST["password"]);
        //echo $password;

    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_error = "Please confirm password.";  
        $error = True;   
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_error) && ($password != $confirm_password)){
            $confirm_password_error = "Password did not match.";
            
            $error = True;
        }

    }
 //PASSWORD validate done
 //ADDRESS Validate
    if(empty(trim($_POST["address"]))){
	        $address_error = "Please enter Address.";
	        $error = True;
	    } 
	 else
	 {
	 	$address = trim($_POST["address"]);
	 	//echo $address;
	 }
 //ADDRESS complete
 //Pin Validate
    if(empty(trim($_POST["pin_code"]))){
	        $pin_code_error = "Please enter Pin Code.";
	        $error = True;
	    } 
	 else
	 {
	 	$pin_code = trim($_POST["pin_code"]);
	 	//echo $pin_code;
	 }
 //Pin complete 
 //STATE Validate
    if(empty(trim($_POST["state"]))){
	        $state_error = "Please select State.";
	        $error = True;
	    } 
	 else
	 {
	 	$state = trim($_POST["state"]);
	 	//echo $state;
	 }
 //STATE complete   
 //City Validate
    if(empty(trim($_POST["city"]))){
	        $city_error = "Please select City.";
	        $error = True;
	    } 
	 else
	 {
	 	$city = trim($_POST["city"]);
	 	//echo $city;
	 }
 //City complete     
    // Check input errors before inserting in database
    if(!($error)){
    	
        $user_id = uniqid();
        $today = date("d/m/Y");
        // Prepare an insert statement
        $sql = "INSERT INTO accounts (user_id,owner,org,email,password,phone,address,pin,state,city,acc_date) VALUES (?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssss", $param_userid, $param_owner,$param_org,$param_email,$param_password,$param_phone,$param_address,$param_pin,$param_state,$param_city,$param_acc_date);
            
            // Set parameters
            $param_userid = $user_id;
            $param_owner = $ownername;
            $param_org= $orgname;
            $param_email=$email;
            //$param_password = $password;
            $param_phone=$phone;
            $param_address=$address;
            $param_pin=$pin_code;
            $param_state=$state;
            $param_city=$city;
            $param_acc_date=$today;

            $param_password = password_hash($password, PASSWORD_BCRYPT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                
                header("location: login.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
                
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 

<html>
<head>
	<meta charset="UTF-8"/>
	<title>Registeration</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<link href="register.css?<?=filemtime("register.css")?>" rel="stylesheet" type="text/css" />

	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
	<!-- Slider -->
	<link rel="stylesheet" href="css/mainStyles.css" />
	<!-- //Slider -->
	<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
	<link href='css/simplelightbox.min.css' rel='stylesheet' type='text/css'> 
	<link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
	<link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
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
		 label{
		 	 font-weight: 300;
		 }
	</style>

</head>
<body id="body">
<div class="top_heder_agile_info" style="background-color: white;border-bottom-style: solid;border-bottom-color: black;border-bottom-width: 1px;box-sizing: border-box;">
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
							<li class="active"><a href="index.html">Home</a></li>
							<li><a href="services.html" >Services</a></li>
							<li><a href="projects.html">Projects</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Short Codes <b class="caret"></b></a>
								<ul class="dropdown-menu agile_short_dropdown">
									<li><a href="index.html">About</a></li>
									<li><a href="typography.html">Typography</a></li>
								</ul>
							</li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
						
					</nav>
				</div>
		</nav>
		
</div>
<div class="w3_logo">
						
						<h1><a class="navbar-brand" href="index.html">MACHINED</a></h1>
</div>
<div class="agileinfo_social_icons">
	<a href="login.php"><button type="button" class="btn btn-primary btn-lg" >LOGIN</button></a>
	<a href="register.php"><button type="button" class="btn btn-primary btn-lg" >REGISTER</button></a>
	<div id="clear"></div>
</div>
<div id="clear"></div>
</div>
<div id="clear"></div>
	<div class="content" style="min-height: 100%;">
	<form name="RegForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<div class="details">
			<span style="display:block;text-align:center;font-size: 25px;margin-top: 5px;">Register</span><br/>
			<div class="name">
					<label id="owner_name">Owner Name</label><br/>
					<input class="box" name="owner_name" id="owner_name_box" type="text" placeholder="Owner Name" onfocusin="hide(id,'owner_name')" onfocusout="show(id,'owner_name')" value="<?php if(isset($_POST['register'])) {echo $_POST["owner_name"]; }?>" />
					<br/>
					<label class='php_error' id='php_owner_error'>
						<?php
						    echo $ownername_error;
						?>
					</label>
					<label class='error' id='owner_error'></label>
			</div>

			<div id="clear"></div>

			<div class="org">
				<br/>
				<label id="org">Organisation Name</label>
				<br/>
				<input class="box" name="org_name" id="cllg_org_box" style="width: 70%;" type="text" placeholder="Organisation Name" onfocusin="hide(id,'org')" onfocusout="show(id,'org')" value="<?php if(isset($_POST['register'])) {echo $_POST["org_name"];} ?>"/>
				<br/>
				<label class='php_error' id='php_org_error'>
					<?php
						echo $orgname_error;
					?>
				</label>
				<label class='error' id='org_error'></label>
			</div>	

			<div id="clear"></div>

			<div class="email_phone">
				
				<div class="email" >
					<br/>
					<label id="email-id">Email ID</label>
					<br/>
					<input class="box" name="email" id="email_box" style="width: 70%;" type="email" placeholder="EMAIL-ID" onfocusin="hide(id,'email-id')" onkeyup="chkMail(this);" onfocusout="show(id,'email-id')" value="<?php if(isset($_POST['register'])) { echo $_POST["email"];} ?>" />
					<br/>
					<label class='php_error' id='php_email_error'>
						<?php
							echo $email_error;
						?>
					</label>
					<label class='error' id='email_error'></label>
				</div>

				<div class="phone" >
					<br/>
					<label id="phn">Phone Number</label>
					<br/>
					<input class="box" id="country_code" type="text" value="+91" readonly/>
					<input class="box" name="phone" id="phn_box" type="tel" style="width:200px;" placeholder="Phone No." onfocusin="hide(id,'phn')" onfocusout="show(id,'phn')" value="<?php  if(isset($_POST['register'])) {echo $_POST["phone"];} ?>"/>
					<br/>
					<label class='php_error' id='php_phone_error'>
						<?php
							echo $phone_error;
						?>
					
					<label class="error" id="phone_error"></label>
				</div>
			
			</div>
			<div id="clear"></div>

			<div class="address" >
				<br/>
				<label style="visibility: visible;font-size:20px">Address</label>
				<br/>
				<textarea class="box" name="address" id="address_box" style="height: 40px;width: 80% "><?php if(isset($_POST['register'])) {echo trim($_POST["address"]);} ?></textarea>
				<label class='php_error' id='php_address_error'>
					<?php
							echo $address_error;
					?>
				</label>
				<label class="error" id="address_error"></label>			
			</div>

			<div id="clear"></div>
			<div class="pincode">
				
				<label id="pin">Pin Code</label>
				<br/>
				<input class="box" type="tel" name="pin_code" style="width:100px;" id="pin_code" placeholder="Pin Code" onfocusin="hide(id,'pin')" onfocusout="show(id,'pin')" value="<?php if(isset($_POST['register'])) {echo $_POST["pin_code"];} ?>"/>
				<br/>
				<label class='php_error' id='php_pin_code_error'>
					<?php
							echo $pin_code_error;
					?>
				</label>
				<label class="error" id="pin_code_error"></label>
				
			</div>
			<div id="clear"></div>

			<div class="select city_state">
				<div class="state">
					<br/>
					<label style="visibility:visible;font-size:20px">State</label>
					<br/>
					<select class="select_box" name="state" id="state_box" onchange="StateCity();" >
						<option value="0">Select State</option>
						<option value="Maharashtra">Maharashtra</option>
						<option value="Karnataka">Karnataka</option>
						<option value="Rajasthan">Rajasthan</option>
						<option value="Uttar Pradesh">Uttar Pradesh</option>
						<option value="Gujarat">Gujarat</option>
						<option value="Madhya Pradesh">Madhya Pradesh</option>
					</select>
					<br/>
					<label class='php_error' id='php_state_error'>
						<?php
							echo $state_error;
						?>
					</label>
				    <label class="error" id="state_error"></label>	
				</div>
				<div class="city">
					<br/>
					<label style="visibility:visible;font-size:20px">City</label>
					<br/>
					<select class="select_box"  name="city" id="city_box">
						<option>Select State first.</option>
						
					</select>
					<br/>
					<label class='php_error' id='php_city_error'>
						<?php
							echo $city_error;
						?>
					</label>
				    <label class="error" id="city_error"></label>	
				</div>

			</div>

			<div id="clear"></div>

			<div class="passwords">
				<div class="password">
					<br/>
					<label id="pwd">Password</label>
					<br/>
					<input class="box" name="password" id="pwd_box" type="password" placeholder="Password" onfocusin="hide(id,'pwd')" onfocusout="show(id,'pwd')"/>
					<br/>
					<label class='php_error' id='php_password_error'>
						<?php
							echo $password_error;
						?>
					</label>
				    <label class="error" id="password_error"></label>
				</div>
				<div class="re-password">
					<br/>
					<label id="re-pwd">Confirm Password</label>
					<br/>
					<input class="box" name="confirm_password" id="re-pwd_box" type="password" placeholder="Confirm Password" onfocusin="hide(id,'re-pwd')" onfocusout="show(id,'re-pwd')"/>
					<br/>
					<label class='php_error' id='php_confirm_password_error'>
						<?php
							echo $confirm_password_error;
						?>
					</label>
				    <label class="error" id="confirm_password_error"></label>
				</div>
				<br/>
				<label class="error" id="passwords_error" style="position:relative;left: 50px;"></label>
			</div>

			<div id="clear"></div>

			<div class="submit">
				<br/>
				<button id="btn" name="register" onclick="return FormValidate();">Register</button>
			</div>
			<br/>
			<!-- End.-->
		</div>
		
	</form>
	<?php
		echo $big_error;
	?>
	</div>
</body>
<script type='text/JavaScript' src='register.js?<?=filemtime("register.js")?>'></script>
</html>
			