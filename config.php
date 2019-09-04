<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'rt');
 
/* Attempt to connect to MySQL database */
//$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
/*
$stmt="SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'rt';";
$res=mysqli_query($link,$stmt);
if($res)
{
	echo "It' s there";
}
*/
if(!(mysqli_select_db($link,'rt')))
{
	mysqli_query($link,'CREATE DATABASE rt;');
	mysqli_select_db($link,'rt');
}

$create_acc_table="CREATE TABLE IF NOT EXISTS accounts
	(
		user_id VARCHAR(255) PRIMARY KEY,
		owner VARCHAR(255),
		org VARCHAR(255),
		email VARCHAR(255),
		password VARCHAR(255),
		phone VARCHAR(255),
		address VARCHAR(255),
		pin VARCHAR(255),
		city VARCHAR(255),
		state VARCHAR(255),
		acc_date VARCHAR(255)
	)";

mysqli_query($link,$create_acc_table);

$create_admin_table="CREATE TABLE IF NOT EXISTS admin
	(
		id VARCHAR(255) PRIMARY KEY,
		email VARCHAR(255),
		password VARCHAR(255)
	);
	INSERT INTO admin (id,email,password) VALUES ('root','root@root.com','root');";

mysqli_multi_query($link,$create_admin_table);
while (mysqli_next_result($link)) {
	# code...
}

$create_category_table="CREATE TABLE IF NOT EXISTS category
	(
		cid VARCHAR(255) PRIMARY KEY,
		cname VARCHAR(255),
		date_added VARCHAR(255)
	);
	";

mysqli_query($link,$create_category_table);



$create_cfeedback_table="CREATE TABLE IF NOT EXISTS cfeedback
	(
		fid VARCHAR(255) PRIMARY KEY,
		user_id VARCHAR(255),
		name VARCHAR(255),
		email VARCHAR(255),
		phone_number VARCHAR(255),
		description VARCHAR(1000),
		date_added VARCHAR(255),
		status VARCHAR(255)
	);
	";

mysqli_query($link,$create_cfeedback_table);

$create_feedback_table="CREATE TABLE IF NOT EXISTS feedback
	(
		fid VARCHAR(255) PRIMARY KEY,
		name VARCHAR(255),
		email VARCHAR(255),
		phone_number VARCHAR(255),
		description VARCHAR(1000),
		date_added VARCHAR(255),
		status VARCHAR(255)
	);
	";

mysqli_query($link,$create_feedback_table);

$create_orders_table="CREATE TABLE IF NOT EXISTS orders
	(
		order_id VARCHAR(255) PRIMARY KEY,
		product_id VARCHAR(255),
		cid VARCHAR(255),
		product_name VARCHAR(255),
		quantity VARCHAR(255),
		user_id VARCHAR(255),
		status VARCHAR(255),
		i_price VARCHAR(255),
		total_price VARCHAR(255),
		profit VARCHAR(255),
		total_profit VARCHAR(255),
		order_date VARCHAR(255)
	)";

mysqli_query($link,$create_orders_table);

$create_products_table="CREATE TABLE IF NOT EXISTS products
	(
		id VARCHAR(255) PRIMARY KEY,
		cid VARCHAR(255),
		name VARCHAR(255),
		description VARCHAR(1000),
		image VARCHAR(255),
		price VARCHAR(255),
		profit VARCHAR(255),
		unit VARCHAR(255),
		date_added VARCHAR(255)
	)";

mysqli_query($link,$create_products_table);

$create_query_table="CREATE TABLE IF NOT EXISTS query
	(
		qid VARCHAR(255) PRIMARY KEY,
		cid VARCHAR(255),
		name VARCHAR(255),
		email VARCHAR(255),
		phone_number VARCHAR(255),
		subject VARCHAR(1000),
		description VARCHAR(1000),
		date_added VARCHAR(255),
		status VARCHAR(255)
	);
	";

mysqli_query($link,$create_query_table);

$drop_procedure_chkCid="DROP PROCEDURE IF EXISTS chkCid";
mysqli_query($link,$drop_procedure_chkCid);
$create_procedure_chkCid="
	CREATE PROCEDURE chkCid(
		IN in_id VARCHAR(255)
	)
	BEGIN
	SELECT * FROM category WHERE cid=in_id;
	END
	";
mysqli_query($link,$create_procedure_chkCid);

$drop_procedure_chkMail="DROP PROCEDURE IF EXISTS chkMail";
mysqli_query($link,$drop_procedure_chkMail);
$create_procedure_chkMail="
	CREATE PROCEDURE chkMail(
		IN in_mail VARCHAR(255)
	)
	BEGIN
	SELECT user_id FROM accounts WHERE email=in_mail;
	END
	";
mysqli_query($link,$create_procedure_chkMail);

$drop_procedure_chkPid="DROP PROCEDURE IF EXISTS chkPid";
mysqli_query($link,$drop_procedure_chkPid);
$create_procedure_chkPid="
	CREATE PROCEDURE chkPid(
		IN in_id VARCHAR(255)
	)
	BEGIN
	SELECT * FROM products WHERE id =in_id;
	END
	";
mysqli_query($link,$create_procedure_chkPid);
/*
$acc_table_chk="SELECT 1 FROM accounts";
if(mysqli_query($link,$acc_table_chk))
{
	echo "TABLE PRESENT";
}
else
{
	$create_acc="CREATE TABLE accounts
	(
		user_id VARCHAR(255) PRIMARY KEY,
		owner VARCHAR(255),
		org VARCHAR(255),
		email VARCHAR(255),
		password VARCHAR(255),
		phone VARCHAR(255),
		address VARCHAR(255),
		pin VARCHAR(255),
		city VARCHAR(255),
		state VARCHAR(255),
		acc_date VARCHAR(255)
	)";
}
*/
?>