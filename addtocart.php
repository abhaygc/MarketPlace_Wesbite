<?php
session_start();
//$_SESSION['cart']="";
		if(isset($_SESSION['cart']) & !empty($_SESSION['cart']))
		{
			//echo "In multi car <br/>";
			$items = $_SESSION['cart'];
			$cartitems = explode(",", $items);
			if(in_array($_GET['id'], $cartitems))
			{
				//header('location: index.php?status=incart');
				//echo "In Array <br/>";
				
				//print_r($cartitems);
			}
			else
			{
				$items .= "," . $_GET['id'];
				$_SESSION['cart'] = $items;
				$cartitems = explode(",", $items);
				//header('location: index.php?status=success');
				//echo "Not in Array <br/>";
				
				//print_r($cartitems);
			}
			echo count($cartitems);
			$_SESSION['cart_count']=count($cartitems);
			$_SESSION['cartitems']=$cartitems;
			/*print_r($cartitems);
			foreach ($cartitems as $key => $id) {
				echo $key."  ".$id."<br/>";
			}*/
			
		}
		else
		{
			$items = $_GET['id'];
			$_SESSION['cart'] = $items;
			$cartitems=$items;
			$_SESSION['cartitems']=$cartitems;
			$_SESSION['cart_count']=1;
			//header('location: index.php?status=success');
			echo "1";
		}

?>