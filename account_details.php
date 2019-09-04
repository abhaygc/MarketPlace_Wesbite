<?php
	require_once "config.php";
	session_start();
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
	{
	    
	   $id = $_SESSION["user_id"];
	}
	else
	{
		header("location: login.php");
	    exit;
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
	

	<title>Account</title>
</head>
<body>
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
                <a class="nav-link py-0" href="query.php" style="font-weight: 600;letter-spacing: 1px;"><span>Query</span></a>
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
                <a class="nav-link py-0" href="account_details.php" style="font-weight: 600;letter-spacing: 1px;"><span style="color: #b06010;">Account</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-0" href="logout.php" style="font-weight: 600;letter-spacing: 1px;"><span>Logout</span></a>
            </li>
        </ul>
    </div>
</nav>

<br/>
<!----------------------------------------------------------------------------------------------------------------------------------->
<div class="row w-100" style="padding-left: 4em;padding-bottom: 5em; ">

  <?php

          $sql = "select * from accounts where user_id='".$id."'";

          $result = mysqli_query($link,$sql);

          $row = mysqli_fetch_assoc($result);

  ?>
   <h1 class="mx-auto" style="margin-top:1em">Account</h1>
      <div class="details container-fluid w-100" style="margin-top: 1em; margin-left: 3em;margin-bottom: 2em;">
            <div class="row mx-auto">
                <div class="col ">
                   <form class="form">
                  <label >User ID</label>
                  <input class="box form-control col-3" type="text" value="<?php echo $row["user_id"];?>" disabled/>
                    </form>
                  </div>
            </div>
           
      <div class="row mx-auto">
        <div class="col">
           <form class="form">
          <label >Owner Name</label>
          <input class="box form-control col-6" type="text" value="<?php echo $row["owner"];?>" disabled />
            </form>
          </div>
          

      <div class="col">
        <form class="form">
     
      
          <label >Organisation Name</label>
          <input class="box form-control col-6"  type="text" value="<?php echo $row["org"];?>" disabled/>
        </form>        
      </div>  
      </div>

      <div id="clear"></div>

      <div class="row mx-auto">
        <div class="col">
           <form class="form">
          <label >Email</label>
          <input class="box form-control col-6" type="text" value="<?php echo $row["email"];?>" disabled/>
            </form>
          </div>
          

      <div class="col">
        <form class="form">
     
      
          <label>Phone</label>
          <input class="box form-control col-6"  value="<?php echo $row["phone"];?>" disabled/>
        </form>        
      </div>  
      </div>
      <div id="clear"></div>

      <div class="row mx-auto">
                

          <div class="col">
            <form class="form">
         
          
              <label>Address</label>
              <textarea class="box form-control col-6" disabled><?php echo $row["address"];?></textarea> 
            </form>        
          </div>  
      </div>

      <div id="clear"></div>
      <div class="row mx-auto">
        <div class="col">
           <form class="form">
          <label >State</label>
          <input class="box form-control col-6" type="text" value="<?php echo $row["state"];?>" disabled/>
            </form>
          </div>
          

      <div class="col">
        <form class="form">
     
      
          <label>City</label>
          <input class="box form-control col-6"  value="<?php echo $row["city"];?>" disabled/>
        </form>        
      </div>  
      <div class="col">
        <form class="form">
     
      
          <label>Pin code</label>
          <input class="box form-control col-6"  value="<?php echo $row["pin"];?>" disabled/>
        </form>        
      </div>  



      </div>

      <div id="clear"></div>

      

      <div id="clear"></div>
</div>
</div>
</div>
</body>
<script type='text/JavaScript' src='user_home.js?<?=filemtime("user_home.js")?>'></script>
</html>  