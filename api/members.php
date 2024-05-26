<?php
include "db_conn.php";
$table = "members";
$action = $_GET['action'];

if ($conn->connect_error) {
  die("Connection Failed :: " . $conn->connect_error);
  return;
}
if ("CREATE_TABLE" == $action) {
  $sql = "CREATE TABLE IF NOT EXISTS $table (
    `id` int(255) NOT NULL,
    `chamaid` int(255) NOT NULL,
    `userid` int(255) NOT NULL,
    `status` int(11) NOT NULL DEFAULT 1,
    `date_joined` timestamp NOT NULL DEFAULT current_timestamp()
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
if ("GET_MEMEBERS_BY_CHAMA" == $action) {
  $chama_id = $_POST['chama_id'];
  $sql = "SELECT * FROM $table WHERE chamaid = '$chama_id'";
  if ($result = $conn->query($sql)) {
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $userid = $row['userid'];
        $sql_users = $conn->query("SELECT `id`, `name`, `idnum`, `phone`, `loanlimit` FROM users WHERE id = '$userid'");
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
if ("GET_MEMBERS_BY_STATUS" == $action) {
  $status = $_POST['status'];
  $sql = "SELECT * FROM $table WHERE status = '$status'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $userid = $row['userid'];
      $sql_users = $conn->query("SELECT `id`, `name`, `idnum`, `phone`, `loanlimit` FROM users WHERE id = '$userid'");
      while ($row_user = $sql_users->fetch_assoc()) {
        $db_data[] = $row_user;
      }
    }
    echo json_encode($db_data);
  } else {
    if($status)
    echo "Members with Stattus: $status not yet registered or cleared?";
  }
  $conn->close();
  return;
}
if ("GET_MEMBER_BY_USERID" == $action) {
  $userid = $_POST['userid'];
  $sql = "SELECT * FROM $table WHERE userid = '$userid'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $userid = $row['userid'];
      $sql_users = $conn->query("SELECT `id`, `name`, `idnum`, `phone`, `loanlimit` FROM users WHERE id = '$userid'");
      while ($row_user = $sql_users->fetch_assoc()) {
        $db_data[] = $row_user;
      }
    }
    echo json_encode($db_data);
  } else {
    echo "Chama with user ID :$userid does not exist?";
  }
  $conn->close();
  return;
}
if ("JOIN_CHAMA" == $action) {
  $chama_id = $_POST['chama_id'];
  $user_id = $_POST['user_id'];

  $check_chama_id = $conn->query("SELECT * FROM $table WHERE `chamaid` = '$chama_id' AND `userid` = '$user_id' ");

  if (mysqli_num_rows($check_chama_id) > 0) {
    echo "Memeber  with id : $user_id, already member of Chama Id : $chama_id";
    return;
  }

  $prepare = "INSERT INTO $table(`chamaid`, `userid`) VALUES ('$chama_id', '$user_id')";

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
if ("DELETE_MEMEBERSHIP" == $action) {
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
if ("GET_MEMBERS_BY_PERIOD" == $action) {
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