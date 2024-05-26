<?php
header("Access-Control-Allow-Origin: http://192.168.1.3");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jowary";
$base_url = "http://localhost";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

session_start();
// Set the session lifetime to 2 hours
// ini_set('session.gc_maxlifetime', 7200);

