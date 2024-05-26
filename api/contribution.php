<?php
include "db_conn.php";
$table = "contributions";
$action = $_GET['action'];

if ($conn->connect_error) {
  die("Connection Failed :: " . $conn->connect_error);
  return;
}
if ("CREATE_TABLE" == $action) {
  $sql = "CREATE TABLE IF NOT EXISTS $table (
    `id` int(255) NOT NULL,
    `contid` int(255) NOT NULL,
    `userid` int(255) NOT NULL,
    `amount` decimal(20,2) NOT NULL,
    `dateAdded` timestamp NOT NULL DEFAULT current_timestamp()
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
if ("GET_CONTRI_BY_ID" == $action) {
  $friend1_id = $_POST['friend1_id'];
  $phone = $_POST['phone'];
  $sql = "SELECT * FROM $table WHERE friend1 = '$friend1_id'";
  if ($result = $conn->query($sql)) {
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $friend2 = $row['friend2'];
        $sql_users = $conn->query("SELECT `contid`, `userid`, `amount`, `dateAdded` FROM invites WHERE `id` = '$friend2'");
        while ($row_user = $sql_users->fetch_assoc()) {
          $db_data[] = $row_user;
        }
      }
      echo json_encode($db_data);
    } else {
      echo "Chama with ID :$chama_id does not exist?";
    }
  } else {
    echo "Error!!!";
  }
  $conn->close();
  return;
}
if ("CREATE_CONTRI" == $action) {
  $chamaid = $_POST['chamaid'];
  $campaign = $_POST['campaign'];
  $target = $_POST['target'];
  $days = $_POST['days'];
  $prepare = "INSERT INTO `contribution` (`chamaid`, `campaign`, `target`, `days`)VALUES ('$chamaid', '$campaign', '$target', '$days')";

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
if ("ADD_MEMEBER_CONTRI" == $action) {
  $contid = $_POST['contid'];
  $userid = $_POST['userid'];
  $amount = $_POST['amount'];
  $prepare = "INSERT INTO $table ( `contid`, `userid`, `amount`)VALUES ('$contid', '$userid', '$amount')";

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
if ("DELETE_CONTRI" == $action) {
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
if ("GET_CONTRI_BY_PERIOD" == $action) {
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];

  if ('non-student' == $user_type) {
    $sql = "SELECT * FROM $table WHERE user_type = '$user_type'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $db_data[] = $row;
      }
      echo json_encode($db_data);
    } else {
      echo $result;
    }
  } else if ('student' == $user_type) {
    $sql = "SELECT * FROM $table WHERE user_type = '$user_type'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $db_data[] = $row;
      }
      echo json_encode($db_data);
    } else {
      echo $result;
    }
  }
  $conn->close();
  return;
}