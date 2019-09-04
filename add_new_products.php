<?php
session_start();
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
<title>Add Category</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
<link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="add_new_products.css?<?=filemtime("add_new_products.css")?>" rel="stylesheet" type="text/css" />
<script src="js/sweetalert2.all.min.js"></script>

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



<?php
require_once "config.php";
if(!isset($_POST['add']))
{
  $count=-1;
}

$epn=array();
$epid=array();
$efile=array();
$edescription=array();
$eprice=array();
$eprofit=array();
$eunit=array();
$new_name="";
$success=false;
/*
$data = file_get_contents('php://input');
echo var_dump($data);

echo var_dump($_POST);
*/
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $cname=$_POST['cname'];
  $cid=$_POST['cid'];
  $today = date("d/m/Y");
 
  
/***********************************************************************************************************************/

/***********************************************************************************************************************/



  $sql = "INSERT INTO category (cid,cname,date_added) VALUES (?, ?, ?)";
        
        if($stmt = mysqli_prepare($link, $sql))
        {
          
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_cid, $param_cname,$param_acc_date);
            
            // Set parameters
            $param_cid = $cid;
            $param_cname = $cname;
            
            $param_acc_date=$today;

            //$param_password = password_hash($password, PASSWORD_BCRYPT); // Creates a password hash
            
            // Attempt to execute the prepared statement

            if(mysqli_stmt_execute($stmt))
            {
                // ADDING PRODUCTS
/***********************                                        ***************************************************/
                      $errors = array();
                      $uploadedFiles = array();
                      $extension = array("jpeg","jpg","png","gif");
                      $bytes = 1024;
                      $KB = 1024;
                      $totalBytes = $bytes * $KB;
                      $UploadFolder = "uploads";
                       
                      $counter = 0;
                      $i=0; 
                      foreach($_FILES["fileToUpload"]["tmp_name"] as $key=>$tmp_name)
                      {
                          
                          $temp = $_FILES["fileToUpload"]["tmp_name"][$key];
                          $name = $_FILES["fileToUpload"]["name"][$key];
                          //echo $temp."</br>";
                          //echo $name."</br>";
                          $se=explode(".",$name);
                          //if(isset($se[1])){print_r($se[1]);}
                          //echo "<br/>";
                          if(isset($se[1]))
                          {
                            $new_name=$_POST['pid'][$key].".".$se[1];
                            //echo "New Name".$new_name;
                          }
                          
                          $_FILES["fileToUpload"]["name"][$key]=$new_name;
                          $name = $_FILES["fileToUpload"]["name"][$key];
                          
                          //echo "</br>".$name."</br>";
                          if ($key >0) 
                          {
                              /*
                              $ext = pathinfo($name, PATHINFO_EXTENSION);
                              $iname = $_POST["pid"][$key];
                              $iname .=".";
                              $iname.=$ext;
                              echo $iname;
                              $name =$iname;
                              */
                              $sql = "INSERT INTO products (id,cid,name,description,image,price,profit,unit,date_added) VALUES (?, ?, ?, ?, ?, ?, ?,?,?)";
                              
                              if($stmt = mysqli_prepare($link, $sql))
                              {
                                
                                  // Bind variables to the prepared statement as parameters
                                  mysqli_stmt_bind_param($stmt, "sssssssss", $param_id,$param_cid ,$param_name,$param_description,$param_image,$param_price,$param_profit,$param_unit,$param_date_added);
                                  
                                  // Set parameters
                                  $param_id = $_POST['pid'][$key];
                                  $param_cid=$cid;
                                  $param_name = $_POST['pname'][$key];
                                  $param_description =$_POST['pdescription'][$key];
                                  $param_image = $name;
                                  $param_price= $_POST['pprice'][$key];
                                  $param_profit=$_POST['pprofit'][$key];
                                  $param_unit = $_POST['punit'][$key];
                                  $param_date_added=$today;
                                  

                                  //$param_password = password_hash($password, PASSWORD_BCRYPT); // Creates a password hash
                                  
                                  // Attempt to execute the prepared statement

                                  if(mysqli_stmt_execute($stmt))
                                  {
                                      // Redirect to login page
                                    //echo "<script type='text/JavaScript'>swal('Products added !');</script>";
                                    $success=true;
                                      
                                  } 
                                  else
                                  {
                                      //echo "Something went wrong. Please try again later.";
									  echo "<script>console.log('start ".mysqli_error($link)."')</script>";
                                      
                                  }
                              }
                              if(empty($temp))
                              {
                                  break;
                              }
                               
                              $counter++;
                              $UploadOk = true;
                               
                              if($_FILES["fileToUpload"]["size"][$key] > $totalBytes)
                              {
                                  $UploadOk = false;
                                  array_push($errors, $name." file size is larger than the 1 MB.");
                              }
                               
                              $ext = pathinfo($name, PATHINFO_EXTENSION);
                              if(in_array(strtolower($ext), $extension) == false)
                              {
                                  $UploadOk = false;
                                  array_push($errors, $name." is invalid file type.");
                              }
                               
                              if(file_exists($UploadFolder."/".$name) == true)
                              {
                                  $UploadOk = false;
                                  array_push($errors, $name." file is already exist.");
                              }
                               
                              if($UploadOk == true)
                              {
                                  move_uploaded_file($temp,$UploadFolder."/".$name);
                                  array_push($uploadedFiles, $name);
                              }
                          }

                      }
                       
                      if($counter>0)
                      {
                          if(count($errors)>0)
                          {
                              echo "<b>Errors:</b>";
                              echo "<br/><ul>";
                              foreach($errors as $error)
                              {
                                  echo "<li>".$error."</li>";
                              }
                              echo "</ul><br/>";
                          }
                           
                          if(count($uploadedFiles)>0)
                          {
                             /* echo "<b>Uploaded Files:</b>";
                              echo "<br/><ul>";
                              foreach($uploadedFiles as $fileName)
                              {
                                  echo "<li>".$fileName."</li>";
                              }
                              echo "</ul><br/>";
                               
                              echo count($uploadedFiles)." file(s) are successfully uploaded.";
                              */
                          }                               
                      }
                      else
                      {
                          echo "Please, Select file(s) to upload.";
                      }






/**************************                                      *****************************************************/

                
            } 
            else
            {
                echo "Something went wrong. Please try again later.";
                
            }
          }




}
?>

<body>
<?php
  if ($success) 
  {
    echo "<script type='text/JavaScript'>swal('Products added !');</script>";
  }
  

?>

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
        <a class="navbar-brand mx-auto py-0" href="admin.php" style="font-weight: 600;font-size: 1.5em;line-height: 22px;letter-spacing: 2px;padding: 16px 0 0 0;">Shraddha Enterprise</a>
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
            <div class="row nav-item dashboard-menu-item" style="background-color: #1d2124">
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
  	<div class="col-md-10 offset-2 dashboard-content w-100">
  		<h1 style="margin-top: 23px">Add New Category.</h1>
      <form class="form-group" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="post" >
        <div class="w-100" style="padding-left: 4em;" >
                  <label for="category_name" style="font-size: 1.5em;">Category Name:</label>
                  <input type="text" name="cname" class="form-control col-5 cname" id="cname" >
                  <label class="error error_cname" style="display: none;"></label><br/>
                  
                  <label for="pid" style="font-size: 1.5em;">Category ID:</label>
                  <input type="text" name="cid" class="form-control col-5 cid" id="cid" onkeyup="chkCid(this);" >
                  <label class="error error_cid" style="display: none;"></label><br/>
                  <br/>
        </div>
        
        <h2>Add Products</h2>
        
        
          
          <div class="row w-100 add_product" style="padding-left: 4em;" >
            <!--  COUNT  -->
              
              <div class="row w-100" >
              <button class="btn btn-primary mx-auto" id="simple_add_btn" onclick="event.stopPropagation();return addProduct(this);" style="display: inline;" disabled>Add Product</button>
              </div>

              <div class="product_form_demo w-100" style="align-content: center;margin-top:2em;display: none;">
                <div class="product_list container-fluid mx-auto" style="">
                  <img src="images/cross.png" class="float-right cross" onclick="removeProduct(this);" />
                  <div class="row mx-auto" style="margin-top: 1em;">
                    <div class="col">
                        <label style="font-size: 1.5em;">Product Name:</label>
                        <input type="text" name="pname[]" class="form-control col-9 pname">
                        <label class="error error_pname" style="display: none;"></label><br/>
                        <?php /*if(!isset($_POST["add"])){$count++;} echo "".$count."<br/>";*/
                        //if (array_key_exists($count, $epn)){echo "".$epn[$count]."<br/>" ;}
                        ?>
                    </div>
                    <div class="col">
                        <label style="font-size: 1.5em;">Product ID:</label>
                        <input type="text" name="pid[]" class="form-control col-9 pid" onkeyup="chkPid(this);"/>
                        <label class="error error_pid" style="display: none;"></label><br/>
                        <?php //if (array_key_exists($count, $epid)){echo "".$epid[$count]."<br/>" ;}?>
                    </div>
                  </div>
                  
                  <label style="font-size: 1.5em;">Product Description:</label>
                  <textarea name="pdescription[]" class="form-control col-12 pdescription" rows="5"></textarea>
                  <label class="error error_pdescription" style="display: none;"></label><br/>
                  <?php // if (array_key_exists($count, $edescription)){echo "".$edescription[$count]."<br/>" ;}?>
                  
                  <label style="font-size: 1.5em;">Select image to upload:</label>
                  <input type="file" name="fileToUpload[]" id="fileToUpload" class="pimage"/>
                  <!--<input type="button" value="Upload Image" name="upload"/>-->
                  <label class="error error_pimage" style="display: none;"></label><br/>
                  <?php //if (array_key_exists($count, $efile)){echo "".$efile[$count]."<br/>" ;}?>

                  <div class="row">
                    <div class="col">
                        <label style="font-size: 1.5em;margin-top:1em;">Unit of Measurement:</label>
                        <input type="text" name="punit[]" class="form-control col-5 punit" />
                        <label class="error error_punit" style="display: none;"></label><br/>
                        <?php //if (array_key_exists($count, $eunit)){echo "".$eunit[$count]."<br/>" ;}?>
                    </div>
                  
                    <div class="col">
                        <label style="font-size: 1.5em;margin-top:1em;">Price(₹):</label>
                        <br/>
                        
                        <!--<input type="text" value="₹" style="width: 1em;border:none;font-size: 1.8em;" readonly/>-->
                        <input type="numeric" name="pprice[]" class="form-control pprice">
                        
                        <label class="error error_pprice" style="display: none;"></label><br/>
                        <?php //if (array_key_exists($count, $eprice)){echo "".$eprice[$count]."<br/>" ;}?>
                    </div>
                    <div class="col">
                        <label style="font-size: 1.5em;margin-top:1em;">Profit(₹):</label>
                        <br/>
                        <!--<input type="text" value="₹" style="width: 1em;border:none;font-size: 1.8em;" readonly/>-->
                        <input type="numeric" name="pprofit[]" class="form-control  pprofit">
                        
                        <label class="error error_pprofit" style="display: none;"></label><br/>
                        <?php //if (array_key_exists($count, $eprofit)){echo "".$eprofit[$count]."<br/>" ;}?>
                    </div>
                  </div>
                </div>

              </div>
              <div class="product_form w-100" style="align-content: center;margin-top:2em;">
                
              </div>
              <div class="row w-100" >
                <button class="btn btn-primary mx-auto" id="add_more_btn" onclick="event.stopPropagation();return addMoreProduct(this);" style="display: none;margin-top: 1em;" disabled>Add More Product</button>
              </div>

          </div>
          
        <div class="row w-100" >
          <button type="submit" name="add" class="btn btn-primary mx-auto" id="add_category" style="display: none;margin-top: 1em;margin-left: 2em;" onclick="event.stopPropagation();return validate();" disabled>Add Category</button>
        </div>
      </form>

  		
  	</div>
  	
  </div>
</div>


</body>
<script type='text/JavaScript' src='add_new_products.js?<?=filemtime("add_new_products.js")?>'></script>
</html>