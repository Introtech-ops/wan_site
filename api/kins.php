<?php
include "db_conn.php";
$table = "kins";
$action = $_POST['action'];

if ($conn->connect_error) {
	die("Connection Failed :: " . $conn->connect_error);
	return;
}
if ("CREATE_TABLE" == $action) {
	$sql = "CREATE TABLE IF NOT EXISTS $table (
    `id` int(255) NOT NULL,
    `name` varchar(150) NOT NULL,
    `address` varchar(150) NOT NULL DEFAULT 0,
    `contact` varchar(150) NOT NULL,
    `email` varchar(150) NOT NULL,
    `user_id` varchar(100) NOT NULL
  )";
	if ($conn->query($sql) === TRUE) {
		echo "success";
	} else {
		echo "error";
	}
	$conn->close();
	return;
}
if ("GET_ALL" == $action) {
	$db_data = array();
	$sql = "SELECT * FROM $table ORDER BY id DESC";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$db_data[] = $row;
		}
		echo json_encode($db_data);
	} else {
		echo $result;
	}
	$conn->close();
	return;
}

if ("GET_BY_PHONE" == $action) {
	$db_data = array();
	$phone = $_POST['phone'];
	$sql = $conn->query("SELECT * FROM kins WHERE contact = '$phone'");
	if ($sql) {
		while ($row_kin = mysqli_fetch_assoc($sql)) {
			$db_data[] = $row_kin;
		}
		echo json_encode($db_data);
	} else {
		echo "User with phone no.: $phone does not exist?";
	}
	$conn->close();
	return;
}
if ("GET_BY_ID" == $action) {
	$db_data = array();
	$userid = $_POST['userid'];
	$sql = "SELECT * FROM `users` WHERE idnum = '$userid'";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$id = $row['id'];
			$sql_users = $conn->query("SELECT * FROM `$table` WHERE `user_id` = '$id'");
			while ($row_user = $sql_users->fetch_assoc()) {
				$db_data[] = $row_user;
			}
		}
		echo json_encode($db_data);
	} else {
		echo "Kin with user ID :$userid does not exist?";
	}
	$conn->close();
	return;
}
if ("ADD_KIN" == $action) {
	$userid = $_POST['userid'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
	$email = $_POST['email'];	
	$relationship = $_POST['relationship'];	

	$sql_kin = $conn->query("SELECT * FROM users WHERE idnum = '$userid'");
	$row = mysqli_fetch_assoc($sql_kin);
	$id = $row['id'];

	$stmt = $conn->query("INSERT INTO $table (`name`, `address`, `contact`, `email`, `relationship`, `user_id`) VALUES ('$name', '$address', '$contact', '$email', '$relationship', '$id')");

	// Prepare and bind parameters
	if ($stmt) {
		// Redirect to form page with success alert
		echo "success";
	} else {
		echo "error";
	}
	// Close statement and connection
	$conn->close();
	return;
}

if ("DELETE_USER" == $action) {
	$userid = $_POST['user_id'];
	$chamaid = $_POST['chama_id'];
	$check_status = $conn->query("SELECT * FROM $table WHERE  userid = '$userid' AND chamaid='$chamaid' ");

	if (mysqli_num_rows($check_status) > 0) {
		$sql = "UPDATE $table SET status = '3' WHERE userid = '$userid' AND chamaid='$chamaid'";

		if ($conn->query($sql) === TRUE) {
			echo "success";
		} else {
			echo "error";
		}
	} else {
		echo "No membership of sort exists!!!";
	}
	$conn->close();
	return;
}