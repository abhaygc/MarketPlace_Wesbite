<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "rt";
	$conn = mysqli_connect($servername,$username,$password,$database);
	if (!$conn) {
		echo "<strong>Connection failed </strong>";
	}
	/*echo $_POST;*/
	$data = file_get_contents('php://input');

	var_dump($data);
	var_dump($_POST);
	print_r($_POST);
	$num = sizeof($_POST['category']);
	echo "<br/> num type ",gettype($num);
	$user_id="A447ED47";
	$status = "SENT";
	$stamp="201811090907";
	$order_id=uniqid();

	$i=0;
	echo "<br/> num type ",gettype($i);
	while ( $i < $num ) {
		if ($_POST['category'][$i]!="" and $_POST['product'][$i]!="") {
			$cat =$_POST['category'][$i];
			$pro =$_POST['product'][$i];
			$quantity = $_POST['quantity'][$i];
			$sql = "INSERT INTO orders (order_id,product_id,product_name,quantity,user_id,stamp,status) VALUES('".$order_id."', '".$pro."','".$pro."', '".$quantity."','".$user_id."','".$stamp."','".$status."')";
			
			
			if(mysqli_query($conn, $sql)){
		       echo "Records added successfully.";
		    } 
		    else{
		   		echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
		    }
		}
	    $i++;
	}

	mysqli_close($conn);



?>