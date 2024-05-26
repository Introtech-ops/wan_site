<?php
include "db_conn.php";
$table = "apply";
$action = $_GET['action'];

if ($conn->connect_error) {
  die("Connection Failed :: " . $conn->connect_error);
  return;
}
if ("CREATE_TABLE" == $action) {
  $sql = "CREATE TABLE IF NOT EXISTS $table (
    `id` int(255) NOT NULL,
    `userid` int(255) NOT NULL,
    `packageid` int(255) NOT NULL,
    `loanamount` decimal(20,2) NOT NULL,
    `repay` decimal(20,2) NOT NULL,
    `garanter1` varchar(150) NOT NULL,
    `phone1` varchar(15) NOT NULL,
    `garanter2` varchar(150) NOT NULL,
    `phone2` varchar(15) NOT NULL,
    `status` int(1) NOT NULL DEFAULT 0,
    `duedate` datetime NOT NULL,
    `dateapplied` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
if ("GET_LOAN_BY_USERID" == $action) {
  $userid = $_POST['userid'];
  $sql_guarantors = "SELECT * FROM $table WHERE userid = '$userid'";
  $sql_personal = $conn->query("SELECT * FROM users WHERE id = '$userid'");
  if ($result_guarantors = $conn->query($sql_guarantors)) {
    if ($result_guarantors->num_rows > 0) {
      while ($row_user = $result_guarantors->fetch_assoc()) {

        $db_data[] = $row_user;
      }
      echo json_encode($db_data);
    } else {
      echo "Loan for user with ID :$userid does not exist?";
    }
  } else {
    echo "Error!!!";
  }
  $conn->close();
  return;
}
if ("GET_LOANS_BY_GUARANTOR" == $action) {
  $phone = $_POST['phone'];
  $sql = "SELECT * FROM $table WHERE phone1 = '$phone' OR phone2 = '$phone'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row_user = $result->fetch_assoc()) {
      $db_data[] = $row_user;
    }
    echo json_encode($db_data);
  } else {
    if ($phone)
      echo "No Guarantor with :$phone is registered.";
  }
  $conn->close();
  return;
}
if ("GET_LOAN_BY_ID" == $action) {
  $id = $_POST['id'];
  $sql = "SELECT * FROM $table WHERE id = '$id'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row_user = $result->fetch_assoc()) {
      $db_data[] = $row_user;
    }
    echo json_encode($db_data);
  } else {
    echo "Loan of ID :$id does not exist?";
  }
  $conn->close();
  return;
}
if ("APPLY_LOAN" == $action) {
  $userid = $_POST['userid'];
  $packageid = $_POST['packageid'];
  $loanamount = $_POST['loanamount'];
  $g1 = $_POST['g1'];
  $g1_phone = $_POST['g1_phone'];
  $g2 = $_POST['g2'];
  $g2_phone = $_POST['g2_phone'];
  $status = $_POST['status'];
  $due_date = $_POST['due_date'];

  $check_loan = $conn->query("SELECT * FROM $table WHERE `packageid` = '$packageid' AND `userid` = '$userid' ");
  $check_loan_limit = $conn->query("SELECT * FROM `packages` WHERE `id` = '$packageid'");

  if (mysqli_num_rows($check_loan) > 0) {
    echo "Your loan application for package id: $packageid already exists";
    return;
  }

  if ($check_loan_limit) {
    while ($row = mysqli_fetch_assoc($check_loan_limit)) {
      if ($loanamount > $row['amount']) {
        echo "Amount exceeds loan limit of: ";
        return;
      }
    }
  }

  $prepare = "INSERT INTO $table(`userid`, `packageid`, `loanamount`, `garanter1`, `phone1`, `garanter2`, `phone2`, `status`, `duedate`) VALUES ('$userid', '$packageid', '$loanamount', '$g1', '$g1_phone', '$g2', '$g2_phone', '$status', '$due_date')";

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
if ("DELETE_LOAN" == $action) {
  $id = $_POST['id'];
  $userid = $_POST['userid'];
  $check_status = $conn->query("SELECT * FROM $table WHERE  id = '$id' AND userid='$userid' ");

  if (mysqli_num_rows($check_status) > 0) {
    $sql = "UPDATE $table SET status = '3' WHERE id = '$id' AND userid='$userid'";

    if ($conn->query($sql) === TRUE) {
      echo "success";
    } else {
      echo "error";
    }
  } else {
    echo "No loan of sort exists!!!";
  }
  $conn->close();
  return;
}
if ("GET_LOANS_BY_PERIOD" == $action) {
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
