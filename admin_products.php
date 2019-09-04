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
  <title>Products</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <script src="js/sweetalert2.all.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">-->
  <link href="admin_products.css?<?=filemtime("admin_products.css")?>" rel="stylesheet" type="text/css" />
 
  <!--
  <link rel="stylesheet" href="/RT/web/css/bootstrap.min.css">
  <script src="/RT/web/js/jquery.min.js"></script>
  <script src="/RT/web/js/popper.min.js"></script>
  <script src="/RT/web/js/bootstrap.min.js"></script>
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
                <a class="nav-link py-0" href="customers.php" style="font-weight: 600;letter-spacing: 1px;"><span>Customers</span></a>
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
      
            <div class="row nav-item dashboard-menu-item" style="background-color: #1d2124" >
                <a class="nav-link " href="admin_products.php" >Products</a>
            </div>
            <div class="row nav-item dashboard-menu-item" >
                <a class="nav-link " href="add_new_products.php">Add Category</a>
            </div>
            <div class="row nav-item dashboard-menu-item" >
                <a class="nav-link " href="edit_products.php">Edit Category</a>
            </div>
            <div class="row nav-item dashboard-menu-item" >
                <a class="nav-link " href="curr_orders.php">Ongoing Orders</a>
            </div>
            <div class="row nav-item dashboard-menu-item">
                <a class="nav-link " href="prev_orders.php">Previous Orders</a>
            </div>
            
        
    </div>
    <div class="col-md-10 offset-2 dashboard-content w-100" >
      <div class="row w-100" style="padding-left: 4em;padding-bottom: 5em;">
          <?php
              $image_path="uploads/";
              $sql ="SELECT cid,cname from category";
              $result=mysqli_query($link,$sql);
              $rowcount=mysqli_num_rows($result);

              if ($rowcount==0) {
                echo "<h1 class='text-center' style='margin-top:1em;margin-bottom:1em;'>No Products exists.</h1>";
              } 
              else 
              {

                while ($row=mysqli_fetch_array($result)) 
                {
                  echo "<h1 class='mx-auto' style='margin-top:1em;margin-bottom:1em;'>".$row['cname']."</h1>";
                  echo "<div class='row w-100'>";
                  
                  $sql2 ="select id,name,image,description,price,unit,date_added from products where cid='".$row['cid']."'";
                  //echo "<br/>".$sql2;
                  $result2=mysqli_query($link,$sql2);
                  /*if( $result2)
                  {
                    echo "yesssssss";
                  }
                  else
                  {
                  echo "Query Failed";
                }
                */
                  $rowcount2=mysqli_num_rows($result2);

                  $j=0;
                  $image_link="";
                  while($row2=mysqli_fetch_array($result2)) 
                  { 
                    $image_link=$image_path.$row2['image'];
                    if ($j%3==0) 
                    {
                      echo("<div class='row w-100' style='margin-bottom:1em'>");
                    }

                    echo "<div class='col-4' >";
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
                          <div class="modal-dialog modal-dialog-centered">
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
                                  <img class="card-img-top" src="'.$image_link.'" alt="Card image cap" >
                                  </div>
                                <div class="col-8">
                                    <div class="row" style="height:3em; white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">'.$row2["description"].'</div>
                                    <div class="row" style="height:3em;">
                                     Date Added:'.$row2["date_added"].'
                                    </div>
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
                    if ($j%3==2) 
                    {
                      echo("</div>");
                    }
                    $j++;
                  }

                  
                  echo "</div>";
                }
              }
  

        ?>
      </div>
      <div class="row w-100">
        <div class="col"></div>
      </div>
    </div>
</div>


</body>
<script type='text/JavaScript' src='admin_products.js?<?=filemtime("admin_products.js")?>'></script>
</html>