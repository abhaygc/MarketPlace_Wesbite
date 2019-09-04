<!DOCTYPE html>
<html>
<head>

	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<!--<link rel="stylesheet" type="text/css" href="profile.css">-->
	<link href="profile.css?<?=filemtime("profile.css")?>" rel="stylesheet" type="text/css" />
	
	<title>Profile</title>
</head>
<body>

	<div class="header">
		<div class="logo">
			<a href="home.html"><img id="logo"src="logo.png"></a>
		</div>
		
		<div class="navigation">	
			<a href="#">Home</a>
			<a href="account.php">Account Details</a>
			<a href="logout.php">Log Out</a>
		</div>
		<!--
		<div class="user_menu">
			<img id="user_icon" alt="user-icon" src="user_icon.jpg" onclick="show('menu');event.stopPropagation();" onblur="hide('menu');" /><br/>
			<div class="menu" id="menu">
				<span class="menu_item">Account Details.</span><br/>
				<span class="menu_item">Log Out.</span><br/>
				<span class="menu_item" style="margin-bottom: 20px;">Help.</span><br/>
			</div>
		</div>
	-->

	</div>

	<div class="content">
		<div class="links">
			<span class="option-links" id="op1" onclick="show_op('order_now','op1');">Order new</span><br/>
			<span class="option-links" id="op2" onclick="show_op('current_order','op2');">Current Orders</span><br/>
			<span class="option-links" id="op3" onclick="show_op('previous_order','op3');">Previous Orders</span><br/>
			<span class="option-links" id="op4" onclick="show_op('support','op4');">Support</span><br/>
		</div>
		<div class="link-contents">
			<!--  ORDER NOW    -->
			<div class="option-contents" id="order_now">
				<form action="add_order.php" method="POST" enctype="application/x-www-form-urlencoded">
				<div class="product">
					<select class="first_select" name="category[]" onchange="dropdown(this);">
						<option value="0">Select</option>
						<option value="1">CNS</option>
						<option value="2">Laser Cut</option>
						<option value="3">Rubber roller</option>
						<option value="4">Fixture</option>
					</select>

					<select class="second_select disabled" name="product[]" onchange="dropdown2(this);" disabled>
						<option>Select Product first</option>
					</select>
					<!--<button class="s_btn" onclick="check_products();" value="submit" disabled>Submit</button>-->
					<input class="quantity_btn disabled" name="quantity[]" type="number" min='1' value="1" disabled />
					<button class="remove_btn disabled_button" id="remove_button" onclick="remove_product(this);" disabled>Remove</button>
					<div id="clear"></div>
					<button class="add_btn disabled_button" id="add_button" onclick="new_products(this);" disabled>Add more products</button>
					<button class="reset_btn disabled_button" id="reset_button" onclick="reset();" disabled>Remove All</button>
					<div id="clear"></div>
					<button class="submit_btn disabled_button" id="submit_button" type="submit" disabled>Order</button>
					<div id="clear"></div>
				</div>
				</form>
			</div>

			<!--  ORDER NOW    -->
			<!--   CURRENT ORDER    -->
			<div class="option-contents" id="current_order">
				<?php
					$servername = "localhost";
					$username = "root";
					$password = "";
					$database = "rt";
					$conn = mysqli_connect($servername,$username,$password,$database);
					if (!$conn) {
						echo "<strong>Connection failed </strong>";
					}
					$sql = "SELECT order_id, product_name, quantity,status FROM orders WHERE user_id='A447ED47'";
					$result = $conn->query($sql);
					$num=mysqli_num_rows($result);

				?>
				<table>
					<thead>
					<tr>
					<th>
					<font face="Arial, Helvetica, sans-serif">Order ID</font>
					</th>
					<th>
					<font face="Arial, Helvetica, sans-serif">Product</font>
					</th>
					<th>
					<font face="Arial, Helvetica, sans-serif">Quantity</font>
					</th>
					<th>
					<font face="Arial, Helvetica, sans-serif">Status</font>
					</th>
					</tr>
					</thead>
					<tbody>
					<!-- LOOP -->
				<?php
					while($row = mysqli_fetch_array($result))
					{
						
							echo "<tr>";
							echo "<td>" . $row['order_id'] . "</td>";
							echo "<td>" . $row['product_name'] . "</td>";
							echo "<td>" . $row['quantity'] . "</td>";
							echo "<td>" . $row['status'] . "</td>";
							echo "</tr>";
						
					}
				?>
				</tbody>
			</table>
			</div>
			<!--   CURRENT ORDER    -->
			<div class="option-contents" id="previous_order">
				op 3
			</div>
			<div class="option-contents" id="support">
				op 4
			</div>
		</div>
	
		<div id="clear"></div>

	</div>
		
	<div class="footer">
		A big thank you to all of you.
	</div>
	
	

</body>
<script type='text/JavaScript' src='profile.js?<?=filemtime("profile.js")?>'></script>
</html>