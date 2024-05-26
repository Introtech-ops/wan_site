<?php
include "db_conn.php";
$table = "guarantors";
$action = $_POST['action'];

if ($conn->connect_error) {
	die("Connection Failed :: " . $conn->connect_error);
	return;
}
if ("CREATE_TABLE" == $action) {
	$sql = "CREATE TABLE IF NOT EXISTS $table (
    `id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `guarantor_name` varchar(150) NOT NULL DEFAULT 0,
    `guarantor_id_no` varchar(20) NOT NULL,
    `guarantor_contact` varchar(20) NOT NULL,
    `relationship` varchar(50) NOT NULL
    `created_at` timestamp NOT NULL DEFAULT current_timestamp()
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
if ("ADD_GUARANTOR" == $action) {
	$userid = $_POST['userid'];
	$name = $_POST['name'];
	$id_no = $_POST['id_no'];
	$contact = $_POST['contact'];
	$relationship = $_POST['relationship'];

	$sql_confirm = $conn->query("SELECT * FROM `users` WHERE `idnum` ='$userid'");
	$row_confirm = mysqli_fetch_assoc($sql_confirm);

	if ($row_confirm) {
		$row_id = $row_confirm['id'];
		$row_name = $row_confirm['name'];

		$stmt = $conn->query("INSERT INTO `guarantors`(`guarantor_name`, `guarantor_id_no`, `guarantor_contact`, `relationship`, `user_id`, `created_at`) VALUES ('$userid', '$name', '$id_no', '$contact', '$relationship')");
		if ($stmt) {
			echo 'success';
		} else {
			echo 'error';
		}
	} else {
		echo "error in fetching user id";
	}
	// Close statement and connection
	$conn->close();
	return;
}
if ("DELETE_GUARANTOR" == $action) {
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
