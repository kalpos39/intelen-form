<?php

$db_user = "root";
$db_pass = "";
$db_name = "accounts";
$db_servername = "localhost";

$conn = mysqli_connect($db_servername,$db_user,$db_pass,$db_name);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to db";
?>
