<?php
include "db_conn.php";

$table = "chama";
$action = $_POST['action'];
if ($conn->connect_error) {
  die("Connection Failed :: " . $conn->connect_error);
  return;
}

if ("CREATE_TABLE" == $action) {
  $sql = "CREATE TABLE IF NOT EXISTS $table (
    `id` int(255) NOT NULL,
    `identifier` varchar(30) NOT NULL,
    `name` varchar(150) NOT NULL,
    `userid` int(255) NOT NULL,
    `date_created` timestamp NOT NULL DEFAULT current_timestamp()
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
function generateRandomString($length = 5) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
if ("REGISTER_CHAMA" == $action) {
  
  $userid = $_POST['userid'];
  $name = $_POST['chama_name'];
  $max = $_POST['max_members'];
  $contri = $_POST['contri_amnt'];
  $chair = $_POST['chair'];
  $treasurer = $_POST['treasurer'];
  $rep = $_POST['rep'];
  $identifier = generateRandomString();

  $check_identifier = $conn->query("SELECT * FROM $table WHERE `identifier` = '$identifier'");

  if (mysqli_num_rows($check_identifier) > 0) {
    echo "Chama with idewntifier : $identifier, already exists";
    return;
  }

  $prepare = "INSERT INTO `chama`(`identifier`, `name`, `userid`, `max_no`, `contribution`, `chair`, `treasurer`, `rep`) VALUES ('$identifier', '$name', '$userid', '$max', '$contri', '$chair', '$treasurer', '$rep')";

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

