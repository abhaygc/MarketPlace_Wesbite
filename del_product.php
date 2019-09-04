<?php

	session_start();
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
  
	<title>delete product</title>
	
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
	
	$sql = "SELECT image FROM products WHERE id = ?";

		if ($stmt = mysqli_prepare($link,$sql))
		{	
			//echo "1st";
			mysqli_stmt_bind_param($stmt, "s", $param_pid);

			$param_pid=$q;

			if (mysqli_stmt_execute($stmt)) 
			{		
				$result = mysqli_stmt_get_result($stmt);
				$row = mysqli_fetch_array($result, MYSQLI_NUM);
				unlink($row[0]);
			} 
			else 
			{	
				
			}
			
		}
	
	$sql2="DELETE FROM products WHERE id = ?";
	
		if ($stmt = mysqli_prepare($link,$sql2))
		{	
			//echo "1st";
			mysqli_stmt_bind_param($stmt, "s", $param_pid);

			$param_pid=$q;

			if (mysqli_stmt_execute($stmt)) 
			{		
				//echo "<br/>2nd";
					$affected_rows = mysqli_stmt_affected_rows($stmt);
				//echo "<br/>".$affected_rows;
				  if ($affected_rows>0)
				  {
				  		$temp=array();
				  		array_push($temp, $id);
				  		
				  		$_SESSION['raw_id'] = array_diff($_SESSION['raw_id'], $temp);
				  }
				  else
				  {
				  	 	
				  }
			} 
			else 
			{	
				
			}
			
		}
	
	
	

?>

	
</body>
</html>