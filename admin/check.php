// check_username.php
<?php
include "../api/db_conn.php";
if (isset($_POST['username'])) {
  $username = $_POST['username'];

  // Your database query to check if the username exists
  $result = mysqli_query($conn, "SELECT * FROM `admin` WHERE username='$username'");

  if ($result->num_rows > 0) {
    echo "Username already exists";
  } else {
    echo ""; // Username is available
  }
}

if (isset($_POST['email'])) {
  $email = $_POST['email'];

  // Your database query to check if the email exists
  $result = mysqli_query($conn, "SELECT * FROM `admin` WHERE email='$email'");

  if ($result->num_rows > 0) {
    echo "Email already exists";
  } else {
    echo ""; // Email is available
  }
}
?>