<?php
include "db_conn.php";

$table = "packages";
$action = $_GET['action'];
if ($conn->connect_error) {
  die("Connection Failed :: " . $conn->connect_error);
  return;
}

if ("CREATE_TABLE" == $action) {
  $sql = "CREATE TABLE IF NOT EXISTS $table (
    `id` int(255) NOT NULL,
    `name` varchar(150) NOT NULL,
    `amount` decimal(20,2) NOT NULL,
    `interest` decimal(4,2) NOT NULL,
    `disburse` decimal(20,2) NOT NULL,
    `grace` int(3) NOT NULL
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

if ("GET_PACK_BY_ID" == $action) {
  $pack_id = $_POST['pack_id'];
  $sql = "SELECT * FROM $table WHERE id = '$pack_id'";
  if ($result = $conn->query($sql)) {
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $db_data[] = $row;
      }
      echo json_encode($db_data);
    } else {
      echo "Package with ID :$pack_id does not exist?";
    }
  } else {
    echo "Error!!!";
  }
  $conn->close();
  return;
}

if ("GET_PACK_BY_AMOUNT_LESS" == $action) {
  $amount = $_POST['amount'];
  $sql = "SELECT * FROM $table WHERE amount <= '$amount'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $db_data[] = $row;
    }
    echo json_encode($db_data);
  } else {
    echo "Chama with user ID :$userid does not exist?";
  }
  $conn->close();
  return;
}

if ("GET_PACK_BY_AMOUNT_MORE" == $action) {
  $amount = $_POST['amount'];
  $sql = "SELECT * FROM $table WHERE amount >= '$amount'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $db_data[] = $row;
    }
    echo json_encode($db_data);
  } else {
    echo "Chama with user ID :$userid does not exist?";
  }
  $conn->close();
  return;
}

if ("REGISTER_PACK" == $action) {
  $name = $_POST['name'];
  $amount = $_POST['amount'];
  $interest = $_POST['interest'];
  $disburse = $_POST['disburse'];
  $grace = $_POST['grace'];

  $check_name = $conn->query("SELECT * FROM $table WHERE `name` = '$name'");

  if (mysqli_num_rows($check_name) > 0) {
    echo "Package with title : <b> $name </b>, already exists";
    return;
  }

  $prepare = "INSERT INTO $table (`name`, `amount`, `interest`, `disburse`, `grace`) VALUES ('$name', '$amount', '$interest', '$disburse', '$grace')";

  // Prepare and bind parameters
  if ($stmt = $conn->query($prepare)) {
    // Execute the statement
    if ($stmt) {
      // Redirect to form page with success alert
      echo "success";
    } else {
      echo "error";
    }
  }
  // Close statement and connection
  $conn->close();
  return;
}

if ("UPDATE_PACK" == $action) {
  $name = $_POST['name'];
  $id = $_POST['id'];

  $sql = "UPDATE $table SET name = '$name' WHERE id = '$id'";

  if ($conn->query($sql) === TRUE) {
    echo "success";
  } else {
    echo "error";
  }
  $conn->close();
  return;
}

if ("DELETE_PACK" == $action) {
  $id = $_POST['id'];
  $sql = "DELETE FROM $table WHERE id = '$id'";

  if ($conn->query($sql) === TRUE) {
    echo "success";
  } else {
    echo "error";
  }
  $conn->close();
  return;
}

