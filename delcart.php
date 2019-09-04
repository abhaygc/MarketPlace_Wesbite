<?php 
session_start();
$items = $_SESSION['cart'];
$cartitems = explode(",", $items);
echo count($cartitems)."<br/>";
print_r($cartitems);
echo "<br/>";
if(isset($_GET['remove']) & !empty($_GET['remove'])){
	$delitem = $_GET['remove'];
	//unset($cartitems[$delitem]);
	$cartitems = array_diff($cartitems, array($delitem));
	print_r($cartitems);
	echo "<br/>";
	$itemids = implode(",", $cartitems);
	$_SESSION['cart'] = $itemids;


	$items = $_SESSION['cart'];
	$cartitems = explode(",", $items);
	$_SESSION['cartitems']=$cartitems;
	$_SESSION['cart_count']=count($cartitems);
	echo "<br/>SUCCESS<br/>";
}
echo count($cartitems)."<br/>";
echo $_SESSION['cart']."<br/>";
if(empty($_SESSION['cart']))
{
	unset($_SESSION['cartitems']);
	unset($_SESSION['cart']);
	unset($_SESSION['cart_count']);
}
header('location:cart.php');
?>