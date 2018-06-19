<?php

include 'set_env.php';

// Run the actual connection here  
$conn = new mysqli($db_host, $db_username, $db_pass, $db_name);
mysqli_set_charset($conn, "UTF8");

?>