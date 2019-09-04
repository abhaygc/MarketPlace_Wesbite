<?php
session_start();
require_once "config.php";
$id = $_GET['q'];
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
  <title>Edit Categories</title>
  <meta charset="utf-8">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <script src="js/sweetalert2.all.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="edit_category.css?<?=filemtime("edit_category.css")?>" rel="stylesheet" type="text/css" />
 
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
<?php


if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $today = date("d/m/Y");
  $UploadFolder="uploads";
  /*
  print_r($_FILES["fileToUpload"]["tmp_name"]);
  echo "<br/>";
  print_r($_FILES["fileToUpload"]["name"]);
  echo "<br/>";
  */
  $sql = "UPDATE category SET cname = ? , cid = ? WHERE cid='".$id."'";
  
   if($stmt = mysqli_prepare($link, $sql))
   {
       mysqli_stmt_bind_param($stmt, "ss", $param_name,$param_cid);
       $param_name = $_POST['cname'];
       $param_cid = $_POST['cid'];
       if(mysqli_stmt_execute($stmt))
       {
            $sql2 = "UPDATE products SET cid = ? WHERE cid='".$id."'";
            if($stmt2 = mysqli_prepare($link, $sql2))
            {
                mysqli_stmt_bind_param($stmt2, "s",$param_cid);
                $param_cid = $_POST['cid'];
                if(mysqli_stmt_execute($stmt2))
                {
                }
            }
            foreach($_FILES["fileToUpload"]["tmp_name"] as $key=>$tmp_name)
            {
                echo $key;
                chdir("C:\\xampp\htdocs\RT\web");
                //echo getcwd() . "<br>";
                $temp = $_FILES["fileToUpload"]["tmp_name"][$key];
                $name = $_FILES["fileToUpload"]["name"][$key];
                /*
                echo "KEY: ".$key;
                echo " TEMP Name : ".$temp." NAME : ".$name;
                */
                $sql3 = "SELECT * FROM products WHERE id='".$_SESSION['raw_id'][$key]."'";
                //echo $_SESSION['raw_id'][$key]."<br/>";
                $result3= mysqli_query($link,$sql3);
                $row3= mysqli_fetch_assoc($result3);
                if ($temp!="") 
                {
                  chdir("uploads");
                  //echo getcwd() . "<br>";
                  unlink($row3['image']);
                  chdir("C:\\xampp\htdocs\RT\web");
                  $temp = $_FILES["fileToUpload"]["tmp_name"][$key];
                  $name = $_FILES["fileToUpload"]["name"][$key];
                  
                  $se=explode(".",$name);
                  
                  if(isset($se[1]))
                  {
                    $new_name=$_POST['pid'][$key].".".$se[1];
                  }
                  $_FILES["fileToUpload"]["name"][$key]=$new_name;
                  $name = $_FILES["fileToUpload"]["name"][$key];
                  echo $name;
                  $ext = pathinfo($name, PATHINFO_EXTENSION);
                  
                   
                  
                  move_uploaded_file($temp,$UploadFolder."/".$name);
                      
                }
                else
                {
                  chdir("uploads");
                  $se=explode(".",$row3['image']);
                  
                  $new_name=$_POST['pid'][$key].".".$se[1];
                  rename($row3['image'],$new_name);
                  $name = $new_name;
                } 
                $sql4 = "UPDATE products SET id=?,cid=?,name=?,description=?,image=?,price=?,profit=?,unit=?,date_added=? WHERE id='".$_SESSION['raw_id'][$key]."';";
                echo $sql4;
                if($stmt4 = mysqli_prepare($link, $sql4))
                {
                    
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt4, "sssssssss", $param_id,$param_cid,$param_name,$param_description,$param_image,$param_price,$param_profit,$param_unit,$param_date_added);
                    
                    // Set parameters
                    $param_id = $_POST['pid'][$key];
                    $param_cid=$_POST['cid'];
                    $param_name = $_POST['pname'][$key];
                    $param_description =$_POST['pdescription'][$key];
                    $param_image = $name;
                    $param_price= $_POST['pprice'][$key];
                    $param_profit=$_POST['pprofit'][$key];
                    $param_unit = $_POST['punit'][$key];
                    $param_date_added=$today;
                    if(mysqli_stmt_execute($stmt4))
                    {
                        header("location:http://localhost/web/edit_products.php");
                    }
                }
                
            }
       }
       else
      {
              echo "<script type='text/JavaScript'>swal({
                      type: 'error',
                      title: 'Error occurred! Please Try Again later!',
                      showConfirmButton: true,
                      confirmButtonText: 'Okay',
                      
                    });</script>";
      }

   }
   
  

}


?>
<body>


<nav class="navbar navbar-expand-md fixed-top  navbar-light header" style="background-color: white;border-bottom-style: solid;border-bottom-color: rgba(0,0,0,.5);border-bottom-width: 1px;font-size: 1em;height: 3.125emem;padding-top: 12px;padding-bottom: 12px" >
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
      
            <div class="row nav-item dashboard-menu-item" >
                <a class="nav-link " href="admin_products.php" >Products</a>
            </div>
            <div class="row nav-item dashboard-menu-item" >
                <a class="nav-link " href="add_new_products.php">Add Category</a>
            </div>
            <div class="row nav-item dashboard-menu-item" style="background-color: #1d2124">
                <a class="nav-link " href="edit_products.php">Edit Category</a>
            </div>
            <div class="row nav-item dashboard-menu-item" >
                <a class="nav-link " href="curr_orders.php">Ongoing Orders</a>
            </div>
            <div class="row nav-item dashboard-menu-item">
                <a class="nav-link " href="prev_orders.php">Previous Orders</a>
            </div>
            
        
    </div>
    <div class="col-md-10 offset-2 dashboard-content w-100">

      <div class="row"  style="margin-top:2em;">
        
      </div>
      <?php
          $sql = "select * from category where cid='".$id."'";
          $result = mysqli_query($link,$sql);
          $row = mysqli_fetch_assoc($result);
      ?>
      
      <!--<form class="form-group" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" enctype="multipart/form-data" method="post">-->
	  <form class="form-group" action="<?php echo htmlspecialchars("http://localhost/web/edit_products.php"); ?>" enctype="multipart/form-data" method="post">
	  
        <h1 class="text-center">Category Details</h1>
        <div class="w-100" style="padding-left: 4em;" >
                  <label for="category_name" style="font-size: 1.5em;">Category Name:</label>
                  <input type="text" name="cname" class="form-control col-5 cname" id="cname" value="<?php echo $row['cname'] ?>" />
                  <label class="error error_cname" style="display: none;"></label><br/>
                  
                  <label for="pid" style="font-size: 1.5em;">Category ID:</label>
                  <input type="text" name="cid" class="form-control col-5 cid" id="cid" onkeyup="chkCid(this,'<?php echo $row['cid'] ?>');" value="<?php echo $row['cid'] ?>" />
                  <label class="error error_cid" style="display: none;"></label><br/>
                  <br/>

        </div>
      
        <h1 class="text-center">Product Details</h1>
        <div class="w-100" id="productContainer">
        <?php
              $image_path="uploads/";
              $sql2 ="select * from products where cid='".$row['cid']."'";
                  
              $result2=mysqli_query($link,$sql2);
              
              $rowcount2=mysqli_num_rows($result2);

              $_SESSION['raw_id']=array();      
      while($row2=mysqli_fetch_array($result2)) 
      { 

        array_push($_SESSION['raw_id'], $row2['id']);
        $image_link="";
        $image_link=$image_path.$row2['image'];
        echo '
        <div class="product_list container-fluid mx-auto" style="border-bottom-style:solid;border-bottom-color:black;border-top-style:solid;border-top-color:black;" >
                  <button class="btn btn-primary mx-auto float-right" onclick="return delProduct(this,\''.$row2['id'].'\');" style="margin-top:0.5em;">DELETE</button>
                  <!--<img src="images/cross.png" class="float-right cross" onclick="removeProduct(this);" />-->
                  <div class="row mx-auto" style="margin-top: 1em;">
                    <div class="col">
                        <label style="font-size: 1.5em;">Product Name:</label>
                        <input type="text" name="pname[]" class="form-control col-9 pname" value="'.$row2['name'].'" />
                        <label class="error error_pname" style="display: none;"></label><br/>
                        
                    </div>
                    <div class="col">
                        <label style="font-size: 1.5em;">Product ID:</label>
                        <input type="text" name="pid[]" class="form-control col-9 pid" onkeyup="chkPid(this,\''.$row2['id'].'\');" value="'.$row2['id'].'"/>
                        <label class="error error_pid" style="display: none;"></label><br/>
                        
                    </div>
                  </div>
                  
                  <label style="font-size: 1.5em;">Product Description:</label>
                  <textarea name="pdescription[]" class="form-control col-12 pdescription" rows="5">'.$row2['description'].'</textarea>
                  <label class="error error_pdescription" style="display: none;"></label><br/>
                  
                  <label style="font-size: 1.5em;">Image:</label><br/>
                  <img class="img-thumbnail" src="'.$image_link.'" style="width:200px;height:200px"/>
                  <br/>
                  <label style="font-size: 1.5em;">Select image to upload:</label>
                  <input type="file" name="fileToUpload[]" id="fileToUpload" class="pimage"/>
                  <!--<input type="button" value="Upload Image" name="upload"/>-->
                  <label class="error error_pimage" style="display: none;"></label><br/>
                  

                  <div class="row">
                    <div class="col">
                        <label style="font-size: 1.5em;margin-top:1em;">Unit of Measurement:</label>
                        <input type="text" name="punit[]" class="form-control col-5 punit" value="'.$row2['unit'].'"/>
                        <label class="error error_punit" style="display: none;"></label><br/>
                        
                    </div>
                  
                    <div class="col">
                        <label style="font-size: 1.5em;margin-top:1em;">Price(₹):</label>
                        <br/>
                        
                        <!--<input type="text" value="₹" style="width: 1em;border:none;font-size: 1.8em;" readonly/>-->
                        <input type="numeric" name="pprice[]" class="form-control pprice" value="'.$row2['price'].'">
                        
                        <label class="error error_pprice" style="display: none;"></label><br/>
                        
                    </div>
                    <div class="col">
                        <label style="font-size: 1.5em;margin-top:1em;">Profit(₹):</label>
                        <br/>
                        <!--<input type="text" value="₹" style="width: 1em;border:none;font-size: 1.8em;" readonly/>-->
                        <input type="numeric" name="pprofit[]" class="form-control  pprofit" value="'.$row2['profit'].'">
                        
                        <label class="error error_pprofit" style="display: none;"></label><br/>
                        
                    </div>
                  </div>
        </div>';

      }
        ?>
        <br/>
        <div class="mx-auto d-flex justify-content-center" style="width: 100% !important;align-items: center;">
        
        <button type="submit" name="category_update" id="update" class="btn btn-primary" style="margin-left: 2em" onclick="return validate();" >Update</button>
        </div>
      </div>
      </form>
      
      
    </div>
    
  </div>
</div>


</body>
<script type='text/JavaScript' src='edit_category.js?<?=filemtime("edit_category.js")?>'></script>
</html>