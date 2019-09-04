<?php
session_start();
require_once "config.php";
if(isset($_SESSION["aloggedin"]) && $_SESSION["aloggedin"] === true)
{

}
else{
    header("location: alogin.php");
    exit;
}
?>
<html lang="en">
<head>
  <title>Customers</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
  <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="admin.css?<?=filemtime("admin.css")?>" rel="stylesheet" type="text/css" />
  <!--
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  -->
  <style type="text/css">
  
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
</head>
<body>


<nav class="navbar navbar-expand-md  fixed-top navbar-light header" style="background-color: white;border-bottom-style: solid;border-bottom-color: rgba(0,0,0,.5);border-bottom-width: 1px;font-size: 1em;height: 3.125emem;padding-top: 12px;padding-bottom: 12px" >
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link py-0" href="admin.php" style="font-weight: 600;letter-spacing: 1px;"><span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-0" href="new_orders.php" style="font-weight: 600;letter-spacing: 1px;"><span>Orders<span class="badge badge-primary" id="new_order_count">
                  <?php
                    $sql2 ="select order_id from orders where status='SENT';";
                    
                    $result2=mysqli_query($link,$sql2);
                    
                    $rowcount2=mysqli_num_rows($result2);
                    if ($rowcount2>0)
                    {
                      echo $rowcount2;
                    }

                  ?>
                </span></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-0" href="new_messages.php" style="font-weight: 600;letter-spacing: 1px;"><span>Queries<span class="badge badge-primary" id="new_message_count">
                  <?php
                    $sql ="select * from query where status='SENT';";
                
                    $result=mysqli_query($link,$sql);
                    
                    $rowcount=mysqli_num_rows($result);
                    if ($rowcount>0)
                    {
                      echo $rowcount;
                    }

                  ?>
                </span></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-0" href="new_feedbacks.php" style="font-weight: 600;letter-spacing: 1px;"><span>Feedbacks<span class="badge badge-primary" id="new_feedback_count">
                  <?php
                    $sql ="select * from feedback where status='SENT';";
                
                    $result=mysqli_query($link,$sql);
                    
                    $rowcount1=mysqli_num_rows($result);
                    $sql2 ="select * from cfeedback where status='SENT';";
                
                    $result2=mysqli_query($link,$sql2);
                    
                    $rowcount2=mysqli_num_rows($result2);

                    $rowcount = $rowcount1 + $rowcount2;
                    if ($rowcount>0)
                    {
                      echo $rowcount;
                    }

                  ?>

                </span></span></a>
            </li>
            
        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto py-0" href="admin.php" style="font-weight: 600;font-size: 1.5em;line-height: 22px;letter-spacing: 2px;padding: 16px 0 0 0;">SHRADDHA ENTERPRISE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link py-0" href="customers.php" style="font-weight: 600;letter-spacing: 1px;"><span style="color: #b06010;">Customers</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-0" href="alogout.php" style="font-weight: 600;letter-spacing: 1px;"><span>Logout</span></a>
            </li>
        </ul>
    </div>
</nav>

<br/>

<div class="container-fluid content" style="position: relative;">
  <div class="row">
    <div class="col-md-2 position-fixed dashboard-menu bg-dark" style="min-height: 100%;" >
      
            <div class="row nav-item dashboard-menu-item" >
                <a class="nav-link " href="admin_products.php" >Products</a>
            </div>
            <div class="row nav-item dashboard-menu-item" >
                <a class="nav-link " href="add_new_products.php">Add Category</a>
            </div>
            <div class="row nav-item dashboard-menu-item">
                <a class="nav-link " href="edit_products.php">Edit Category</a>
            </div>
            <div class="row nav-item dashboard-menu-item" >
                <a class="nav-link " href="curr_orders.php">Ongoing Orders</a>
            </div>
            <div class="row nav-item dashboard-menu-item">
                <a class="nav-link " href="prev_orders.php">Previous Orders</a>
            </div>
            
        
    </div>
  	<div class="col-10 offset-2 dashboard-content" style="margin-top: 30px;">

      
       <?php
          /************HEADLINE********************************/


              echo "<div class='row w-100 mx-auto content-fluid position-fixed' style='border-bottom-style:solid;border-bottom-color:black;background-color:white;z-index:2;padding-left:1em;padding-right:1em;'>";
                  echo "<div class='col-2   '>";
                    
                      echo "<span class='align-middle font-weight-bold' style='margin-left:2em;'>User ID</span>";
                  
                  echo "</div>";
                  echo "<div class='col-2 '>";
                      
                          echo "<span class='align-middle font-weight-bold'>Organisation Name</span>";
                  echo "</div>";
                  echo "<div class='col-2  '>";
                      
                          echo "<span class='align-middle font-weight-bold' style='margin-left:-3em;'>Ongoing Orders</span>";
                  echo "</div>";
                  echo "<div class='col-2    '>";
                      
                          echo "<span class='align-middle font-weight-bold' style='margin-left:-5em;'>Previous Orders</span>";
                  
                  echo "</div>";
                  echo "<div class='col-2    '>";
                      
                          echo "<span class='align-middle font-weight-bold' style='margin-left:-8em;'>Date</span>";
                  
                  echo "</div>";
                  
                  
                  echo "<div class='col-2  font-weight-bold'>";
                          echo "<span class='align-middle font-weight-bold' style='margin-left:-8em;'></span>";
                          
                  echo "</div>";
                  
                  

                  
              echo "</div>";


          /************HEADLINE********************************/
              $sql2 ="select * from accounts;";
              
              $result2=mysqli_query($link,$sql2);
              
              $rowcount2=mysqli_num_rows($result2);
              echo "<div class='container-fluid' style='margin-top:1em;'>";
              while ($row=mysqli_fetch_array($result2))
              {

                $sql="select * from orders where user_id='".$row['user_id']."' and status='COMPLETED'";

                $result = mysqli_query($link,$sql);

                $rowcount_ongoing=mysqli_num_rows($result);

                $sql3="select * from orders where (user_id='".$row['user_id']."' and status='IN PROGRESS') or (user_id='".$row['user_id']."' and status='SENT')";

                $result3 = mysqli_query($link,$sql3);

                $rowcount_previous=mysqli_num_rows($result3);



                  echo "<div class='row w-100 mx-auto content-fluid' style='border-bottom-style:solid;border-bottom-color:black;padding-left:1em;padding-right:1em;height:5em;'>";
                  echo "<div class='col-2 h-100 justify-content-center align-items-center d-flex'>";
                  
                    echo "<span class='align-middle font-weight-bold'>".$row['user_id']."</span>";
                  echo "</div>";
                  echo "<div class='col-2 h-100 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>".$row['org']."</span>";
                  echo "</div>";
                  echo "<div class='col-2 h-100 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>".$rowcount_ongoing."</span>";
                  echo "</div>";
                  echo "<div class='col-2 h-100 justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>".$rowcount_previous."</span>";
                  
                  echo "</div>";
                  echo "<div class='col-2  justify-content-center align-items-center d-flex'>";
                      
                          echo "<span class='align-middle font-weight-bold'>".$row['acc_date']."</span>";
                  
                  echo "</div>";
                  
                  
                  echo "<div class='col-2 h-100 justify-content-center align-items-center d-flex font-weight-bold'>";
                    echo "<a href=\"customer_details.php?q=".$row['user_id']."\">View Details</a>";
                  echo "</div>";
                  
                  

                  
                    echo "</div>";

              } 
              echo "</div>";








       ?>











  		
  	</div>
  </div>
</div>


</body>
</html>