<?php
 require_once "config.php";
 $q = trim($_GET['q']);
if ($q=="") {
    echo "Please enter ID";
}
else
{
    $sql = "CALL chkCid(?)";
     if($stmt = mysqli_prepare($link, $sql))
     {
        // Bind variables to the prepared statement as parameters
    	mysqli_stmt_bind_param($stmt, "s", $param_cid);
                
        // Set parameters
        $param_cid = $q;
                
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
            	echo "ID available!";
            }
        }
        else
        {
            echo $stmt;
        }
      }
      else
        {
            echo "STMT PREPARE ERROR";
        }

    }
 ?>