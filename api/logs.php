<?php
include "db_conn.php";

$table = "logs";
$action = $_POST['action'];
if ($conn->connect_error) {
  die("Connection Failed :: " . $conn->connect_error);
  return;
}

if ("CREATE_TABLE" == $action) {
  $sql = "CREATE TABLE IF NOT EXISTS $table (
    id INT AUTO_INCREMENT PRIMARY KEY,
    log_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    log_level ENUM('INFO', 'WARNING', 'ERROR') NOT NULL,
    message TEXT
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

if ("GET_CHAMA_BY_ID" == $action) {
  $chama_id = $_POST['chama_id'];
  $sql = "SELECT * FROM $table WHERE id = '$chama_id'";
  if ($result = $conn->query($sql)) {
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $db_data[] = $row;
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

if ("GET_CHAMA_BY_USERID" == $action) {
  $userid = $_POST['userid'];
  $sql = "SELECT * FROM $table WHERE userid = '$userid'";
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

if ("GET_CHAMA_BY_IDENTIFIER" == $action) {
  $identifier = $_POST['identifier'];
  $sql = "SELECT * FROM $table WHERE identifier = '$identifier'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $db_data[] = $row;
    }
    echo json_encode($db_data);
  } else {
    echo "Chama with Identifier :$identifier does not exist?";
  }
  $conn->close();
  return;
}

if ("GET_CHAMA_BY_PERIOD" == $action) {
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

if ("REGISTER_CHAMA" == $action) {
  $userid = $_POST['userid'];
  $identifier = $_POST['identifier'];
  $name = $_POST['name'];

  $check_identifier = $conn->query("SELECT * FROM $table WHERE `identifier` = '$identifier'");

  if (mysqli_num_rows($check_identifier) > 0) {
    echo "Chama with idewntifier : $identifier, already exists";
    return;
  }

  $prepare = "INSERT INTO $table(`identifier`, `name`, `userid`) VALUES ('$identifier', '$name', '$userid')";

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

if ("UPDATE_CHAMA" == $action) {
  $name = $_POST['name'];
  $identifier = $_POST['identifier'];

  $sql = "UPDATE $table SET name = '$name' WHERE identifier = '$identifier'";

  if ($conn->query($sql) === TRUE) {
    echo "success";
  } else {
    echo "error";
  }
  $conn->close();
  return;
}

if ("DELETE_CHAMA" == $action) {
  $identifier = $_POST['identifier'];
  $sql = "DELETE FROM $table WHERE identifier = '$identifier'";

  if ($conn->query($sql) === TRUE) {
    echo "success";
  } else {
    echo "error";
  }
  $conn->close();
  return;
}

