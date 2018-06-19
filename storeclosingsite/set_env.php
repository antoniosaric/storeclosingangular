<?php          
$is_local = $_SERVER['SERVER_NAME'] === 'localhost';
$is_prod = $_SERVER['SERVER_NAME'] === 'storeclosing.com' || $_SERVER['SERVER_NAME'] === 'www.storeclosing.com';
if ( $is_local )
{
	// local database credentials
	$db_host = 'localhost'; 
	// Place the username for the MySQL database here 
	$db_username = 'root'; 
	// Place the password for the MySQL database here 
	$db_pass = "";  
	// Place the name for the MySQL database here 
	$db_name = 'storeclosing';
}
else if ( $is_prod )
{
	// prod database credentials
	$db_host = ''; 
	// Place the username for the MySQL database here 
	$db_username = ''; 
	// Place the password for the MySQL database here 
	$db_pass = '';  
	// Place the name for the MySQL database here 
	$db_name = '';
}
?>




