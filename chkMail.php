<?php
 require_once "config.php";
 $q = $_GET['q'];

if (!filter_var($q, FILTER_VALIDATE_EMAIL)) {
 // $emailErr = "Invalid email format"; 
  echo "Invalid email format";
}
else{
 $sql = "CALL chkMaiL(?)";
 if($stmt = mysqli_prepare($link, $sql))
 {
    // Bind variables to the prepared statement as parameters
	mysqli_stmt_bind_param($stmt, "s", $param_email);
            
    // Set parameters
    $param_email = $q;
            
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt))
    {
        /* store result */
        mysqli_stmt_store_result($stmt);
        /*
        mysqli_stmt_bind_result($stmt, $col1);

	    // fetch values 
	    while (mysqli_stmt_fetch($stmt)) {
	        echo $col1;
	    }
	    */
        
        if(mysqli_stmt_num_rows($stmt) == 1){
        	
        	echo "ID already used";
        }
        else
        {
        	//echo "Problem";
            echo "ID available";
        }
    }
  }
  mysqli_stmt_free_result($stmt);
  mysqli_stmt_close($stmt);
}
	
	
?>