<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<link href="account.css?<?=filemtime("account.css")?>" rel="stylesheet" type="text/css"/>
	<title>Account Details</title>
</head>
<body>
	<div class="header">
		<div class="logo">
			<a href="home.html"><img id="logo"src="logo.png"></a>
		</div>
		
		<div class="navigation">	
			<a href="profile.php">Home</a>
			<a href="#">Account Details</a>
			<a href="login.html">Log Out</a>
		</div>
	</div>
	<div id="clear"></div>
	<div class="content">
		<div class="headline">
			Account Details
		</div>
		
		<div id="clear"></div>
		<div class="details">
			<?php
				$servername = "localhost";
				$username = "root";
				$password = "";
				$database = "rt";
				$conn = mysqli_connect($servername,$username,$password,$database);
				if (!$conn) {
					echo "<strong>Connection failed </strong>";
				}
				$user_id="a5599";
				$sql = "SELECT owner, org, email,phone,address,city,state FROM accounts WHERE user_id='a5599'";
				$result = $conn->query($sql);
				
				while($row = mysqli_fetch_array($result))
					{
						
							echo "<div class='row'>Owner: <span class='value'>".$row['owner']."</span></div>";
							echo "<div class='row'>Organisation: <span class='value'>".$row['org']."</span></div>";
							echo "<div class='row'>Email ID: <span class='value'>".$row['email']."</span></div>";
							echo "<div class='row'>Phone: <span class='value'>".$row['phone']."</span></div>";
							echo "<div class='row'>Address: <span class='value'>".$row['address']."</span></div>";
							echo "<div class='row'>City: <span class='value'>".$row['city']."</span></div>";
							echo "<div class='row'>State: <span class='value'>".$row['state']."</span></div>";
													
					}
			?>
		</div>
		
	</div>
	<div class="footer">
		A big thank you to all of you.
	</div>
</body>
<script type='text/JavaScript' src='account.js?<?=filemtime("account.js")?>'></script>
</html>