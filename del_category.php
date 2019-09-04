<?php
	require_once "config.php";

?>


<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="/RT/web/js/sweetalert2.all.min.js"></script>
  
	<title>delete category</title>
	
</head>
<body>
	<?php
			// Get current directory
			//echo getcwd() . "<br>";

			// Change directory
			chdir("uploads");

			// Get current directory
			//echo getcwd();
			
	?>
<?php
	
	$q = $_GET['q'];
	
	$sql="DELETE FROM products WHERE cid = ?";
	$sql2="DELETE FROM category WHERE cid = ?";
	$images="SELECT image FROM  products WHERE cid = ?";
	$images_delete=array();
	if ($st = mysqli_prepare($link,$images)) 
	{	
		mysqli_stmt_bind_param($st, "s", $param_cid);

		$param_cid=$q;

		if (mysqli_stmt_execute($st)) 
		{	
			$result = mysqli_stmt_get_result($st);
			//echo $result;
			//print_r($result);
	        while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
	        {
	            
	            foreach ($row as $r)
	            {
	                //echo "<br/>";
	                //print "$r ";
	                array_push($images_delete,$r);
	            }
	            
	            //print_r($row);

	            
	        }
	        //print_r($images_delete);
	        $array_length=count($images_delete);
	        for ($i=0; $i < $array_length; $i++) { 
	        		//echo "<br/> ".$i." ".$images_delete[$i];
	        		unlink($images_delete[$i]);
	        	}	
		}
		
		if ($stmt = mysqli_prepare($link,$sql))
		{	
			//echo "1st";
			mysqli_stmt_bind_param($stmt, "s", $param_cid);

			$param_cid=$q;

			if (mysqli_stmt_execute($stmt)) 
			{		
				//echo "<br/>2nd";
					$affected_rows = mysqli_stmt_affected_rows($stmt);
				//echo "<br/>".$affected_rows;
				  if ($affected_rows>0)
				  {
				  		//echo "<script type='text/JavaScript'>swal('".$affected_rows." products deleted !');</script>";
				  		//echo '<script type="text/JavaScript">deleted_count("'.$affected_rows.'");</script>';
				  		//echo "<br/>".$affected_rows." product deleted";
				  		//echo "yes";
				  }
				  else
				  {
				  	 	//echo "<script type='text/JavaScript'> swal('No Product Deleted!!');</script>";
				  		//echo '<script type="text/JavaScript">deleted_count("'.$affected_rows.'");</script>';
				  		
				  		//echo "<br/>No product deleted";
				  		//echo "no";
				  }
			} 
			else 
			{	
				//echo "<br/>2nd Else";
				//echo "<script>swal('Error! Please try again later!!');</script>";
			}
			
		}
	}

	if ($stmt2 = mysqli_prepare($link,$sql2))
	{	
		//echo "<br/>c 1st";
		mysqli_stmt_bind_param($stmt2, "s", $param_cid);

		$param_cid=$q;

		if (mysqli_stmt_execute($stmt2)) 
		{		
			//echo "<br/>c 2nd";
				$affected_rows = mysqli_stmt_affected_rows($stmt2);
			//echo "<br/>c ".$affected_rows;
			  if ($affected_rows>0)
			  {
			  		//echo "<script type='text/JavaScript'>swal('".$affected_rows." products deleted !');</script>";
			  		//echo '<script type="text/JavaScript">deleted_count("'.$affected_rows.'");</script>';
			  		//echo "<br/>".$affected_rows." category deleted";
			  		echo "yes";
			  }
			  else
			  {
			  	 	//echo "<script type='text/JavaScript'> swal('No Product Deleted!!');</script>";
			  		//echo "<br/>No category deleted";
			  		echo "no";
			  }
		} 
		else 
		{	
			//echo "<br/>2nd Else";
			//echo "<script>swal('Error! Please try again later!!');</script>";
		}
		
	}

?>

	
</body>
</html>