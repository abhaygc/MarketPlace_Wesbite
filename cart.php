<html>
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
  <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="cart.css?<?=filemtime("cart.css")?>" rel="stylesheet" type="text/css" />
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
  

  <title>Cart</title>
</head>





<?php
	require_once "config.php";
	session_start();
  $post=false;
  $placed=false;
  //echo "<script>console.log('start ".$post."')</script>";
  echo "<script>console.log('start ".$_SERVER['SERVER_NAME']."')</script>";
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
    $post = true;
  }
  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['placeorder']))
  {

    /************************************   PLACING ORDER *********************************************/
      $cartitems=$_SESSION['cartitems'];
      if ($_SESSION['cart_count' ]==1) 
      {
				//echo "<script>console.log(' Cart count 1 detected')</script>";
                  $id = $_SESSION['cartitems'];
                  $sql ="select name,cid,image,description,price,profit,unit from products where id='".$id."'";
                  
                  $result=mysqli_query($link,$sql);
                  $rowcount=mysqli_num_rows($result);
                  $row = mysqli_fetch_assoc($result); 
                  
                  $quantity=trim($_POST['quantities'][0]);
                  $_POST['quantity']=$quantity;
                  $order_id=uniqid();
                  $today = date("d/m/Y");


                  $sql2 = "INSERT INTO orders (order_id,product_id,cid,product_name,quantity,user_id,status,i_price,total_price,profit,total_profit,order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql2))
        {
           // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $param_orderid,$param_pid,$param_cid,$param_pname,$param_quantity,$param_userid,$param_status,$param_price,$param_total,$param_profit,$param_total_profit,$param_order_date);
            
            // Set parameters
			echo "<script>console.log('".trim($_POST['quantities'][0])."')</script>";
            $param_orderid = $order_id;
            $param_pid = $id;
            $param_cid= $row['cid'];
            $param_pname=$row['name'];
            $param_quantity = $quantity;
            $param_userid = $_SESSION["user_id"];
            $param_status="SENT";
            $param_price=$row['price'];
            
            $param_total=$quantity*$row['price'];
            $param_profit=$row['profit'];
            $param_total_profit=$quantity*$row['profit'];
            $param_order_date=$today;

          
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                
                $placed=true;
                unset($_SESSION['cart']);
                unset($_SESSION['cartitems']);
                unset($_SESSION['cart_count']);
                
            } 
        }
         else{
                /*echo "<script type='text/JavaScript'>swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Something went wrong!',
                      })</script>
                    ";*/
				echo "<script>console.log('".mysqli_error($link)."')</script>";
                
            }
         
        // Close statement
        mysqli_stmt_close($stmt);







                  

      }
      else
      {
              foreach ($cartitems as $key => $id) 
              {
                  $sql ="select * from products where id='".$id."'";
                  
                  $result=mysqli_query($link,$sql);
                  $rowcount=mysqli_num_rows($result);
                  $row = mysqli_fetch_assoc($result); 
                  $quantity=trim($_POST['quantities'][$key]);
                  $_POST['quantity'][$key]=$quantity;
                  $order_id=uniqid();
                  $today = date("d/m/Y");
                  $sql2 = "INSERT INTO orders (order_id,product_id,cid,product_name,quantity,user_id,status,i_price,total_price,profit,total_profit,order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql2))
        {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $param_orderid,$param_pid,$param_cid,$param_pname,$param_quantity,$param_userid,$param_status,$param_price,$param_total,$param_profit,$param_total_profit,$param_order_date);
            
            // Set parameters
            $param_orderid = $order_id;
            $param_pid = $id;
            $param_cid= $row['cid'];
            $param_pname=$row['name'];
            $param_quantity = $quantity;
            $param_userid = $_SESSION["user_id"];
            $param_status="SENT";
            $param_price=$row['price'];
            
            $param_total=$quantity*$row['price'];
            $param_profit=$row['profit'];
            $param_total_profit=$quantity*$row['profit'];
            $param_order_date=$today;

          
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                
                $placed=true;
                unset($_SESSION['cart']);
                unset($_SESSION['cartitems']);
                unset($_SESSION['cart_count']);
                
                
            }
        }
         else{
                echo "<script type='text/JavaScript'>swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Something went wrong!',
                      })</script>
                    ";
                
            }
         
        // Close statement
        mysqli_stmt_close($stmt);
                  
                  
              }
      }




		//echo "<script>console.log('last ".$post."')</script>";
		//echo "<script>console.log('last ".$placed."')</script>";



   /************************************ PLACING ORDER ***********************************************/
  }
?>

<body>

<?php

      if($placed)
      {
          echo "<script type='text/JavaScript'>swal({
                      type: 'success',
                      title: 'Order Placed!',
                      text: 'Thanks for choosing us! Your order will be delivered soon!',
                      showConfirmButton: true,
                      confirmButtonText:
                        'Goto Orders!',
                      
                    }).then((result) => {
                      if (result.value) {
                        window.location.assign('user_orders.php');
                        
                      }
                    })</script>";
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
                <a class="nav-link py-0" href="query.php" style="font-weight: 600;letter-spacing: 1px;"><span>Query</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-0" href="feedback.php" style="font-weight: 600;letter-spacing: 1px;"><span>Feedback</span></a>
            </li>
            
        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto py-0" href="#" style="font-weight: 600;font-size: 1.5em;line-height: 22px;letter-spacing: 2px;padding: 16px 0 0 0;">Shraddha Enterprise</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
                <a class="nav-link py-0" href="user_prev_orders.php" style="font-weight: 600;letter-spacing: 1px;"><span>Previous Orders</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-0" href="cart.php" style="font-weight: 600;letter-spacing: 1px;"><span style="color: #b06010;">Cart <span class="badge badge-primary" id="cart_count" ><?php if (isset($_SESSION['cart_count'])) {echo $_SESSION['cart_count'];} ?></span></span></a>
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
<div class="row w-100" style="position:relative;padding-left: 4em;padding-top: 2em;padding-bottom: 5em;">

    <?php
        $image_path="uploads/";
    if(!$placed)
    {
      if(!$post)
      {
        if(isset($_SESSION['cart']) & !empty($_SESSION['cart']))
        {
          /**************************************************************************************************************************/
              $cartitems=$_SESSION['cartitems'];
              echo "<form id='form' action='";
              echo htmlspecialchars($_SERVER["PHP_SELF"]);
              echo "'method='post' enctype='application/x-www-form-urlencoded'>";
              if ($_SESSION['cart_count' ]==1) 
              {
                  $id = $_SESSION['cartitems'];
				echo "<script>console.log(' Cart count 1 detected')</script>";
                  $sql ="select name,image,description,price,unit from products where id='".$id."'";
                  
                  $result=mysqli_query($link,$sql);
                  $rowcount=mysqli_num_rows($result);
                  $row = mysqli_fetch_assoc($result); 
				//echo "<script>console.log(' Id : ".$id." cartitems : ".$_SESSION['cartitems']." row: ".$row."')</script>";
                  $image_link=$image_path.$row['image'];

                  echo "<div class='row w-100 content-fluid' id='".$id."_container'style='border-bottom-style:solid;border-bottom-color:black;padding-left:1em;padding-right:1em;'>";
                  echo "<div class='col-5' data-toggle='modal' data-target='#".$id."_modal'>";
                  echo "<div class='row'>";
                  echo "<div class='col-4'>";
                  echo '<img class="img-thumbnail" src="'.$image_link.'" alt="'.$post.'" style="margin-top:2em;">';
                  echo "</div>";
                  echo "<div class='col-3'>";
                      echo "<div class='row w-100' style='padding-top:2em;'>";
                          echo "<span class='font-weight-bold'>".$row['name']."</span>";
                      echo "</div>";
                      echo "<div class='row w-100' style='padding-top:2em;'>";
                          echo "<span class='font-weight-bold'>Unit: ".$row['unit']."</span>";
                      echo "</div>";
                      echo "<div class='row w-100' style='padding-top:2em;padding-bottom:1em;'>";
                          echo "<span class='font-weight-bold'>Price: ".$row['price']."</span>";
                      echo "</div>";
                  echo "</div>";
                  echo "</div>";
                  echo "</div>";
                  echo "<div class='col-3'>";
                    echo '<div class="input-group" style="position:relative;padding-top:20%;">
                   
          <span class="input-group-btn">
              <button type="button" class="btn btn-danger btn-number" onclick="decrement(\''.$id.'_input\',\''.$id.'_total\',\''.$row['price'].'\');">
                  <img src="images/remove.png" style="width:1.5em;height:1.5em;" />
              </button>
          </span>
          <input type="text" name="quantity[]" class="form-control input-number" value="1" min="1" onchange="validQuantity(\''.$id.'_input\');" id="'.$id.'_input">
          <span class="input-group-btn">
              <button type="button" class="btn btn-success btn-number" onclick="increment(\''.$id.'_input\',\''.$id.'_total\',\''.$row['price'].'\');" >
                  <img src="images/add.png" style="width:1.5em;height:1.5em;"/>
              </button>
          </span>

      </div>';
                  echo "</div>";
                  echo "<div class='col-3 font-weight-bold'>";
                    echo "Total<br/>";

                    echo "<div class='align-middle' style='font-size:1.5em;padding-top:10%'><span style='font-size:1em'>₹ </span><span id='".$id."_total'>".$row['price']."</span></div>";
                  echo "</div>";
                  
                  
                  echo "<div class='col-1'>";
                    echo "<span style='display:block;padding-top:80%;' ><a href='delcart.php?remove=".$id."'class='btn btn-primary mx-auto float-right' onclick=\"return removeProduct('".$id."_container');\" role='button'>REMOVE</a></span>";
                  echo "</div>";
                  

                  echo '
                  <!-- The Modal -->
                        <div class="modal fade w-100 h-100" id="'.$id.'_modal">
                          <div class="modal-dialog ">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title text-center font-weight-bold">'.$row["name"].'</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">
                                <div class="row w-100">
                                  <div class="col-4">
                                  <img class="card-img-top img-thumbnail" src="'.$image_link.'" alt="Card image cap" >
                                  </div>
                                <div class="col-8">
                                    <div class="card-text text-wrap font-weight-bold" style="height:3em; white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">'.$row["description"].'</div>
                                    <div class="row" style="height:3em;">
                                      <div class="col"><p class="card-text font-weight-bold">Unit: '.$row["unit"].'</p></div>
                                      <div class="col"><p class="card-text font-weight-bold">Price:'.$row["price"].'</p></div>
                                    </div>
                                </div>
                              </div>
                            </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              </div>

                            </div>
                          </div>
                        </div>
                    <!-- The Modal -->
                    ';
                    echo "</div>";




              }
              else
              {
              foreach ($cartitems as $key => $id) 
              {
                  $sql ="select name,image,description,price,unit from products where id='".$id."'";
                  
                  $result=mysqli_query($link,$sql);
                  $rowcount=mysqli_num_rows($result);
                  $row = mysqli_fetch_assoc($result); 
                  $image_link=$image_path.$row['image'];
                  
                  echo "<div class='row w-100 content-fluid' id='".$id."_container'style='border-bottom-style:solid;border-bottom-color:black;padding-left:1em;padding-right:1em;'>";
                  echo "<div class='col-5' data-toggle='modal' data-target='#".$id."_modal'>";
                  echo "<div class='row'>";
                  echo "<div class='col-4'>";
                  echo '<img class="img-thumbnail" src="'.$image_link.'" alt="Card image cap" style="margin-top:2em;">';
                  echo "</div>";
                  echo "<div class='col-3'>";
                      echo "<div class='row w-100' style='padding-top:2em;'>";
                          echo "<span class='font-weight-bold'>".$row['name']."</span>";
                      echo "</div>";
                      echo "<div class='row w-100' style='padding-top:2em;'>";
                          echo "<span class='font-weight-bold'>Unit: ".$row['unit']."</span>";
                      echo "</div>";
                      echo "<div class='row w-100' style='padding-top:2em;padding-bottom:1em;'>";
                          echo "<span class='font-weight-bold'>Price: ".$row['price']."</span>";
                      echo "</div>";
                  echo "</div>";
                  echo "</div>";
                  echo "</div>";
                  echo "<div class='col-3'>";
                  echo "<span class='font-weight-bold'>Quantity</span>";
                    echo '<div class="input-group" style="position:relative;padding-top:10%;">
                   
          <span class="input-group-btn">
              <button type="button" class="btn btn-danger btn-number" onclick="decrement(\''.$id.'_input\',\''.$id.'_total\',\''.$row['price'].'\');">
                  <img src="images/remove.png" style="width:1.5em;height:1.5em;" />
              </button>
          </span>
          <input type="text" name="quantity[]" class="form-control input-number" value="1" min="1" onchange="validQuantity(\''.$id.'_input\');" id="'.$id.'_input">
          <span class="input-group-btn">
              <button type="button" class="btn btn-success btn-number" onclick="increment(\''.$id.'_input\',\''.$id.'_total\',\''.$row['price'].'\');" >
                  <img src="images/add.png" style="width:1.5em;height:1.5em;"/>
              </button>
          </span>

      </div>';
                  echo "</div>";
                  echo "<div class='col-3 font-weight-bold'>";
                    echo "Total<br/>";

                    echo "<div class='align-middle' style='font-size:1.5em;padding-top:10%'><span style='font-size:1em'>₹ </span><span id='".$id."_total'>".$row['price']."</span></div>";
                  echo "</div>";
                  
                  
                  echo "<div class='col-1'>";
                    echo "<span style='display:block;padding-top:80%;' ><a href='delcart.php?remove=".$id."'class='btn btn-primary mx-auto float-right' onclick=\"return removeProduct('".$id."_container');\" role='button'>REMOVE</a></span>";
                  echo "</div>";
                  

                  echo '
                  <!-- The Modal -->
                        <div class="modal fade w-100 h-100" id="'.$id.'_modal">
                          <div class="modal-dialog ">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title text-center font-weight-bold">'.$row["name"].'</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">
                                <div class="row w-100">
                                  <div class="col-4">
                                  <img class="card-img-top img-thumbnail" src="'.$image_link.'" alt="Card image cap" >
                                  </div>
                                <div class="col-8">
                                    <div class="card-text text-wrap font-weight-bold" style="height:3em; white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">'.$row["description"].'</div>
                                    <div class="row" style="height:3em;">
                                      <div class="col"><p class="card-text font-weight-bold">Unit: '.$row["unit"].'</p></div>
                                      <div class="col"><p class="card-text font-weight-bold">Price:'.$row["price"].'</p></div>
                                    </div>
                                </div>
                              </div>
                            </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              </div>

                            </div>
                          </div>
                        </div>
                    <!-- The Modal -->
                    ';
                    echo "</div>";
              }
            }
              echo "<div class='row w-100' id='chkout_btn' style='margin-top:1.5em;'><button type='submit' class='mx-auto btn btn-success' style='font-size:1.5em' name='chkout_btn'>Checkout</button></div>";
              echo "</form>";
          /**************************************************************************************************************************/
        }
        else
        {
           echo "<div class='content w-100'><h1 class='text-center'>No Products in Cart</h1><br/></div>";
           
           echo "<div class='content w-100'><h1 class='text-center'>Goto <a href='user_home.php'>Products</a></h1></div>";
        }
      }
      else
      {

        /**********************************/

          $cartitems=$_SESSION['cartitems'];

          /************HEADLINE********************************/


              echo "<div class='row w-100 mx-auto content-fluid' style='border-bottom-style:solid;border-bottom-color:black;padding-left:1em;padding-right:1em;'>";
                  echo "<div class='col-2'>";
                  
                  
                  echo "</div>";
                  echo "<div class='col-2 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>Name</span>";
                  echo "</div>";
                  echo "<div class='col-2  justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>Unit</span>";
                  echo "</div>";
                  echo "<div class='col-2  justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>Price</span>";
                  
                  echo "</div>";
                  echo "<div class='col-2  justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>Quantity</span>";
                  
                  echo "</div>";
                  
                  
                  echo "<div class='col-2  justify-content-center align-items-center d-flex font-weight-bold'>";
                    echo "Total";
                  echo "</div>";
                  
                  

                  
              echo "</div>";














          /************HEADLINE********************************/









              echo "<form class='w-100' id='form' action='";
              echo htmlspecialchars($_SERVER["PHP_SELF"]);
              echo "'method='post' enctype='application/x-www-form-urlencoded'>";
              if ($_SESSION['cart_count' ]==1) 
              {
                  $id = $_SESSION['cartitems'];
                  $sql ="select name,image,description,price,unit from products where id='".$id."'";
                  
                  $result=mysqli_query($link,$sql);
                  $rowcount=mysqli_num_rows($result);
                  $row = mysqli_fetch_assoc($result); 
                  $image_link=$image_path.$row['image'];

                  echo "<div class='row w-100 mx-auto content-fluid' id='".$id."_container'style='border-bottom-style:solid;border-bottom-color:black;padding-left:1em;padding-right:1em;height:15em;'>";
                  echo "<div class='col-2'>";
                  
                  echo '<img class="img-thumbnail" src="'.$image_link.'" alt="'.$placed.'" style="margin-top:2em;height:10em;width:10em;">';
                  echo "</div>";
                  echo "<div class='col-2 h-100 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>".$row['name']."</span>";
                  echo "</div>";
                  echo "<div class='col-2 h-100 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>".$row['unit']."</span>";
                  echo "</div>";
                  echo "<div class='col-2 h-100 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'><span style='font-size:1em'>₹ </span>".$row['price']."</span>";
                  
                  echo "</div>";
                  echo "<div class='col-2  justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>".$_POST['quantity'][0]."</span>";
                          echo "<input type='hidden' name='quantities[]' value='".$_POST['quantity'][0]."'/>";
                  
                  echo "</div>";
                  
                  
                  echo "<div class='col-2 h-100 justify-content-center align-items-center d-flex font-weight-bold'>";
                    echo "<div class='clear'></div>";
                    echo "<span style='font-size:1em'>₹ </span><span id='".$id."_total' style='font-size:1.5em'>".$row['price']*$_POST['quantity'][0]."</span>";
                  echo "</div>";
                  
                  

                  
                    echo "</div>";




              }
              else
              {
              foreach ($cartitems as $key => $id) 
              {
                  $sql ="select name,image,description,price,unit from products where id='".$id."'";
                  
                  $result=mysqli_query($link,$sql);
                  $rowcount=mysqli_num_rows($result);
                  $row = mysqli_fetch_assoc($result); 
                  $image_link=$image_path.$row['image'];
                  
                  echo "<div class='row w-100 mx-auto content-fluid' id='".$id."_container'style='border-bottom-style:solid;border-bottom-color:black;padding-left:1em;padding-right:1em;height:15em;'>";
                  echo "<div class='col-2'>";
                  
                  echo '<img class="img-thumbnail" src="'.$image_link.'" alt="'.isset($_POST['placeorder']).'" style="margin-top:2em;height:10em;width:10em;">';
                  echo "</div>";
                  echo "<div class='col-2 h-100 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>".$row['name']."</span>";
                  echo "</div>";
                  echo "<div class='col-2 h-100 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>".$row['unit']."</span>";
                  echo "</div>";
                  echo "<div class='col-2 h-100 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'><span style='font-size:1em'>₹ </span>".$row['price']."</span>";
                  
                  echo "</div>";
                  echo "<div class='col-2  justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>".$_POST['quantity'][$key]."</span>";
                          echo "<input type='hidden' name='quantities[]' value='".$_POST['quantity'][$key]."'/>";
                          
                  echo "</div>";
                  
                  
                  echo "<div class='col-2 h-100 justify-content-center align-items-center d-flex font-weight-bold'>";
                    echo "<div class='clear'></div>";
                    echo "<span style='font-size:1em'>₹ </span><span id='".$id."_total' style='font-size:1.5em'>".$row['price']*$_POST['quantity'][$key]."</span>";
                  echo "</div>";
                  
                  

                  
                    echo "</div>";
              }
            }

            
          
            echo "<div class='row w-100' id='chkout_btn' style='margin-top:1.5em;'><button type='submit' class='mx-auto btn btn-success' style='font-size:1.5em' name='placeorder'>Place Order</button></div>";
          
        /***************************************/

      }
      }
          
          else
          {
            echo "<div class='row w-100' style='margin-top:1.5em;'><button class='mx-auto btn btn-success' style='font-size:1.5em' name='placeorder' onclick=\"return thankYou();\">Order Placed!</button></div>";
            echo "<div class='content w-100' style='margin-top:1.5em;margin-left:-1em;'><h3 class='text-center' id='goto_products'>Goto <a href='user_orders.php'>Orders</a></h3></div>";
          }
            echo "</form>";


    ?>
</div>
<div class='content w-100'><h1 class='text-center' id="no_products" style="display: none">No Products in Cart</h1><br/></div>
<div class='content w-100'><h1 class='text-center' id="goto_products" style="display: none">Goto <a href='user_home.php'>Products</a></h1></div> 

</body>
<script type='text/JavaScript' src='cart.js?<?=filemtime("cart.js")?>'></script>
</html>  