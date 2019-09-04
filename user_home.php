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
	

	<title>Home</title>
</head>
<body>
<nav class="navbar navbar-expand-md  fixed-top navbar-light header" style="background-color: white;border-bottom-style: solid;border-bottom-color: rgba(0,0,0,.5);border-bottom-width: 1px;font-size: 1em;height: 3.125emem;padding-top: 12px;padding-bottom: 12px" >
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link py-0" href="#" style="font-weight: 600;letter-spacing: 1px;"><span style="color: #b06010;">Home</span></a>
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
<div class="row w-100" style="padding-left: 4em;padding-bottom: 5em;">
          <?php
              $image_path="uploads/";
              $sql ="select cid,cname from category";
              $result=mysqli_query($link,$sql);
              $rowcount=mysqli_num_rows($result);

              if ($rowcount==0) {
                echo "<h1 class='mx-auto' style='margin-top:1em;'>No Products exists.</h1>";
              } 
              else 
              {

                while ($row=mysqli_fetch_array($result)) 
                {
                  echo "<h1 class='mx-auto' style='margin-top:1em;'>".$row['cname']."</h1>";
                  echo "<div class='row w-100'>";
                  
                  $sql2 ="select id,name,image,description,price,unit from products where cid='".$row['cid']."'";
                  //echo "<br/>".$sql2."<br/>";
                  $result2=mysqli_query($link,$sql2);
                  
                  $rowcount2=mysqli_num_rows($result2);
                  
                  if ($rowcount2==0) {
                    echo("<div class='row w-100 mx-auto'>");
                    echo "<h4 class='mx-auto' style='margin-top:1em;'>No Products under this Category currently.</h4>";
                    echo("</div>");
                  } 
                  else
                  {
                  $j=0;
                  $image_link="";
                    while($row2=mysqli_fetch_array($result2)) 
                    { 
                      $image_link=$image_path.$row2['image'];
                      if ($j%3==0) 
                      {
                        echo("<div class='row w-100 mx-auto'>");
                      }
            					echo "<div class='mx-auto' >";
            					echo "<div class='col-4 w-100'  >";
                      echo'<div class="card" style="width: 18em;height:26.5em;overflow:hidden;border-style:solid;border-color:black" data-toggle="modal" data-target="#'.$row2["id"].'_modal">
                      <div class="card-header text-center" style="height:2.5em;">'.$row2["name"].'</div>
                      <img class="card-img-top" src="'.$image_link.'" alt="Card image cap" style="width: 18em;height:18em;">
                      <div class="card-body" style="height:4em;">
                        <div class="card-text text-wrap" style="height:3em; white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">'.$row2["description"].'</div>
                        <div class="row" style="height:3em;">
                        <div class="col"><p class="card-text">Unit: '.$row2["unit"].'</p></div>
                        <div class="col"><p class="card-text">Price:'.$row2["price"].'</p></div>
                        </div>

                      </div>
                      </div>

                      
                      <!-- The Modal -->
                          <div class="modal fade w-100 h-100" id="'.$row2["id"].'_modal">
                            <div class="modal-dialog ">
                              <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title text-center">'.$row2["name"].'</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                  <div class="row w-100">
                                    <div class="col-4">
                                    <img class="card-img-top img-thumbnail" src="'.$image_link.'" alt="Card image cap" >
                                    </div>
                                  <div class="col-8">
                                      <div class="card-text text-wrap" style="height:3em; white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">'.$row2["description"].'</div>
                                      <div class="row" style="height:3em;">
                                        <div class="col"><p class="card-text">Unit: '.$row2["unit"].'</p></div>
                                        <div class="col"><p class="card-text">Price:'.$row2["price"].'</p></div>
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
                      echo '<p class="row w-100 "><button onclick="addtocart(this,\''.$row2['id'].'\');" class="btn btn-primary mx-auto" style="margin-top:0.5em;"';
                      	if(isset($_SESSION["cart"]) & !empty($_SESSION["cart"]))
                      	{	
                      		$items = $_SESSION["cart"];
                      		$cartitems = explode(",", $items);
                      		if(in_array($row2["id"], $cartitems))
                      			{
                      				echo "disabled";
                      			}
                      	}
                      echo	'>';
                      if(isset($_SESSION["cart"]) & !empty($_SESSION["cart"])){$items = $_SESSION["cart"];$cartitems = explode(",", $items);if(in_array($row2["id"], $cartitems)){echo "Added To Cart";}else{echo "Add to Cart";}}
                      else{echo "Add to Cart";}
                      echo'</button></p> ';
                      echo "</div>";

                      if ($j%3==2) 
                      {
                        echo("</div>");
                      }
                      $j++;
                    }

                    
                    echo "</div>";
                  }
                }
              }
  

        ?>
      </div>
      <div class="row w-100">
        <div class="col"></div>
      </div>
</body>
<script type='text/JavaScript' src='user_home.js?<?=filemtime("user_home.js")?>'></script>
</html>  