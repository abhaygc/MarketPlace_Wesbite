<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["aloggedin"]) && $_SESSION["aloggedin"] === true){
    header("location: admin.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $password = "";
$email_error = $password_error = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        $email_error = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_error = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_error) && empty($password_error)){
        // Prepare a select statement
        $sql = "SELECT id, email, password FROM admin WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $user_id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        
                        if($password==$hashed_password){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["aloggedin"] = true;
                                                    
                            
                            // Redirect user to welcome page
                            header("location: admin.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_error = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $email_error = "No account found with that Email-ID.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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
    <meta charset="utf-8"/>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="login.css?<?=filemtime("login.css")?>" rel="stylesheet" type="text/css" />
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
    </style>
    <title>Admin Login</title>
</head>
<body>
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
                    
                </div>
        </nav>
        
</div>
<div class="w3_logo" style="position: relative;float: left;left: 25%;">
                        
                        <h1><a class="navbar-brand" href="index.html">SHRADDHA ENTERPRISE</a></h1>
</div>

<div id="clear"></div>
</div>
<div class="content">
    <div class="login-details">
        <form name="LogForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="application/x-www-form-urlencoded">
            <span style="display:block;text-align:center;font-size: 25px;margin-top: 5px;">Admin Login</span><br/>
            <div class="email">
                <label id="email-id" style="font-weight: 300;">Email-ID</label>
                <br/>
                <input class="box" type="email" id="eid" name="email" placeholder="Email-ID" onfocusin="hide(id,'email-id')" onfocusout="show(id,'email-id')" value="<?php if(isset($_POST['login'])) { echo $_POST["email"];} ?>" />
                    <br/>
                    <label class='php_error' id='php_email_error'>
                        <?php
                            echo $email_error;
                        ?>
                    </label>
                    <label class='error' id='email_error'></label>
            </div>
            <div class="password">
                <label id="password" style="font-weight: 300;">Password</label>
                <br/>
                <input class="box" type="password" id="pwd" name="password" placeholder="Password" onfocusin="hide(id,'password')" onfocusout="show(id,'password')" value="<?php if(isset($_POST['login'])) { echo $_POST["password"];} ?>" />
                    <br/>
                    <label class='php_error' id='php_password_error'>
                        <?php
                            echo $password_error;
                        ?>
                    </label>
                    <label class='error' id='password_error'></label>               
            </div>
            <div clear="both"></div>
            <div class="create-account">
            
            </div>
            <div clear="both"></div>
            <div class="submit">
                <button id="btn" name="login" onclick="return FormValidate()">Login</button>
            </div>
            <br/>
        </form>
    </div>
</div>
</body>
<script type='text/JavaScript' src='login.js?<?=filemtime("login.js")?>'></script>

</html>