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
  

  <title>Orders</title>
</head>





<?php
	require_once "config.php";
	session_start();
  
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
	{
	    
	   
	}
	else
	{
		header("location: login.php");
	    exit;
	}

  
?>

<body>


<nav class="navbar navbar-expand-md  fixed-top navbar-light header" style="background-color: white;border-bottom-style: solid;border-bottom-color: rgba(0,0,0,.5);border-bottom-width: 1px;font-size: 1em;height: 3.125emem;padding-top: 12px;padding-bottom: 12px" >
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link py-0" href="user_home.php" style="font-weight: 600;letter-spacing: 1px;"><span>Home</span></a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link py-0" href="user_orders.php" style="font-weight: 600;letter-spacing: 1px;"><span style="color: #b06010;">Ongoing Orders</span></a>
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
                <a class="nav-link py-0" href="cart.php" style="font-weight: 600;letter-spacing: 1px;"><span>Cart <span class="badge badge-primary" id="cart_count" ><?php if (isset($_SESSION['cart_count'])) {echo $_SESSION['cart_count'];} ?></span></span></a>
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
      
        /**********************************/

          $sql="select * from orders where (user_id='".$_SESSION['user_id']."' and status='IN PROGRESS') or (user_id='".$_SESSION['user_id']."' and status='SENT')";

          $result = mysqli_query($link,$sql);
          /************HEADLINE********************************/


              echo "<div class='row w-100 mx-auto content-fluid' style='border-bottom-style:solid;border-bottom-color:black;padding-left:1em;padding-right:1em;'>";
                  echo "<div class='col-1'>";
                  
                  
                  echo "</div>";
                  echo "<div class='col-1 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>Order ID</span>";
                  echo "</div>";
                  echo "<div class='col-2 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>Product Name</span>";
                  echo "</div>";
                  echo "<div class='col-2  justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>Category Name</span>";
                  echo "</div>";
                  echo "<div class='col-1  justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>Price</span>";
                  
                  echo "</div>";
                  echo "<div class='col-1  justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>Quantity</span>";
                  
                  echo "</div>";
                  
                  
                  echo "<div class='col-1  justify-content-center align-items-center d-flex font-weight-bold'>";
                    echo "Total";
                  echo "</div>";
                  echo "<div class='col-2 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>Status</span>";
                  echo "</div>";

                  echo "<div class='col-1 justify-content-center align-items-center d-flex '>";
                  
                  	echo "<span class='align-middle font-weight-bold'>Order Date</span>";
                  echo "</div>";
                  

                  
              echo "</div>";


          /************HEADLINE********************************/
  
              
              while ($row=mysqli_fetch_array($result))
              {
                  
                  
                  $sql2="select cname from category where cid='".$row['cid']."'";

          		  $result2 = mysqli_query($link,$sql2);
          		  $row2=mysqli_fetch_array($result2);

          		  $sql3="select * from products where id='".$row['product_id']."'";

          		  $result3 = mysqli_query($link,$sql3);
          		  $row3=mysqli_fetch_array($result3);

          		  $image_link=$image_path.$row3['image'];
                  
                  echo "<div class='row w-100 mx-auto content-fluid' id='".$row['order_id']."_container'style='border-bottom-style:solid;border-bottom-color:black;padding-left:1em;padding-right:1em;height:8em;'
                  data-toggle='modal' data-target='#".$row['product_id']."_modal'>";
                  echo "<div class='col-1'>";
                  
                  echo '<img class="img-thumbnail" src="'.$image_link.'" alt="Card image cap" style="margin-top:2em;height:5em;width:5em;">';
                  echo "</div>";
                  echo "<div class='col-1 h-100 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>".$row['order_id']."</span>";
                  echo "</div>";


                  echo "<div class='col-2 h-100 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>".$row['product_name']."</span>";
                  echo "</div>";


                  echo "<div class='col-2 h-100 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>".$row2['cname']."</span>";
                  echo "</div>";
                  echo "<div class='col-1 h-100 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'><span style='font-size:1em'>₹ </span>".$row['i_price']."</span>";
                  
                  echo "</div>";
                  echo "<div class='col-1  justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>".$row['quantity']."</span>";
                          
                  echo "</div>";
                  
                  
                  echo "<div class='col-1 h-100 justify-content-center align-items-center d-flex font-weight-bold'>";
                    echo "<div class='clear'></div>";
                    echo "<span style='font-size:1em'>₹ </span><span id='".$row['order_id']."_total' style='font-size:1.5em'>".$row['total_price']."</span>";
                  echo "</div>";

                  echo "<div class='col-2 h-100 justify-content-center align-items-center d-flex font-weight-bold'>";
                    echo "<div class='clear'></div>";
                    echo "<span id='".$row['order_id']."_total' style='font-size:1em'>".$row['status']."</span>";
                  echo "</div>";
                  
                  echo "<div class='col-1 h-100 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>".$row['order_date']."</span>";
                  echo "</div>";

                    echo "</div>";
                    echo '
                    <!-- The Modal -->
                        <div class="modal fade w-100 h-100" id="'.$row["product_id"].'_modal">
                          <div class="modal-dialog ">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title text-center">'.$row["product_name"].'</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">
                                <div class="row w-100">
                                  <div class="col-4">
                                  <img class="card-img-top img-thumbnail" src="'.$image_link.'" alt="Card image cap" >
                                  </div>
                                <div class="col-8">
                                    <div class="card-text text-wrap" style="height:3em; white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">'.$row3["description"].'</div>
                                    <div class="row" style="height:3em;">
                                      <div class="col"><p class="card-text">Unit: '.$row3["unit"].'</p></div>
                                      <div class="col"><p class="card-text">Price:'.$row3["price"].'</p></div>
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
              
            }

            
        /***************************************/

      

    ?>
</div>


</body>
<script type='text/JavaScript' src='cart.js?<?=filemtime("cart.js")?>'></script>
</html>  