<?php
include "db_conn.php";
$table = "users";
$action = $_POST['action'];

if ($conn->connect_error) {
  die("Connection Failed :: " . $conn->connect_error);
  return;
}
if ("CREATE_TABLE" == $action) {
  $sql = "CREATE TABLE IF NOT EXISTS $table (
    `id` int(255) NOT NULL,
    `name` varchar(150) NOT NULL,
    `idnum` int(15) NOT NULL DEFAULT 0,
    `phone` varchar(15) NOT NULL,
    `loanlimit` decimal(20,2) NOT NULL,
    `pwd` varchar(1024) NOT NULL
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

if ("DASH" == $action) {
  $db_data = array();
  $sql = "SELECT * FROM `dsahboard` WHERE `status` = 'active' ";
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
if ("GET_USER_BY_PHONE" == $action) {
  $phone = $_POST['phone'];
  $sql = "SELECT * FROM $table WHERE phone = '$phone'";
  if ($result = $conn->query($sql)) {
    if ($result->num_rows > 0) {
      while ($row_user = $result->fetch_assoc()) {
        $db_data[] = $row_user;
      }
      echo json_encode($db_data);
    } else {
      echo "User with phone no.:$phone does not exist?";
    }
  } else {
    echo "Error!!!";
  }
  $conn->close();
  return;
}
if ("GET_USER_BY_NATID" == $action) {
  $natid = $_POST['natid'];
  $sql = "SELECT * FROM $table WHERE idnum = '$natid'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row_user = $result->fetch_assoc()) {
      $db_data[] = $row_user;
    }
    echo json_encode($db_data);
  } else {
    echo "User of ID no.: $natid is not yet registered!!!";
  }
  $conn->close();
  return;
}
if ("GET_USER_BY_ID" == $action) {
  $userid = $_POST['userid'];
  $sql = "SELECT * FROM $table WHERE id = '$userid'";
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
if ("ADD_USER" == $action) {
  $name = $_POST['name'];
  $idnum = $_POST['idnum'];
  $phone = $_POST['phone'];
  $pswd = $_POST['pswd'];

  $hashpswd = password_hash($pswd, PASSWORD_BCRYPT);

  $check_chama_id = $conn->query("SELECT * FROM $table WHERE `idnum` = '$idnum' OR phone='$phone'");

  if (mysqli_num_rows($check_chama_id) > 0) {
    echo "duplicate";
    return;
  }

  $stmt = $conn->query("INSERT INTO `users`(`idnum`, `loanlimit`, `name`, `phone`, `pwd`) VALUES ('$idnum', '0', '$name',  '$phone', '$hashpswd')");

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
if ("REG_ADMIN" == $action) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $f_name = $_POST['f_name'];
  $l_name = $_POST['l_name'];
  $id_no = $_POST['id_no'];
  $pswd = $_POST['pswd'];
  $cnfm_pswd = $_POST['cnfm_pswd'];

  if ($pswd == $cnfm_pswd) {
    $check_chama_id = $conn->query("SELECT * FROM `admin` WHERE `username` = '$username' OR `email`='$email'");

    if (mysqli_num_rows($check_chama_id) > 0) {
      echo "<script> 
        window.location.href = '../admin/register.php?res=userexist';  
      </script>";
      return;
    }
    // Hash the password using bcrypt
    $pswd = password_hash($pswd, PASSWORD_BCRYPT);

    $prepare = "INSERT INTO  `admin` (`username`, `password`, `email`, `f_name`, `l_name`) VALUES ('$username', '$pswd', '$email', '$f_name', '$l_name')";

    // Prepare and bind parameters
    if ($stmt = $conn->query($prepare)) {
      // Execute the statement
      if ($stmt) {
        // Redirect to form page with success alert
        echo "<script> 
      window.location.href = '../admin/login.php?res=usereg';  
    </script>";
      } else {
        echo "<script> 
          window.location.href = '../admin/register.php?res=useregerr';  
        </script>";
      }
    }
    // Close statement and connection
    $conn->close();
    return;
  } else {
    echo "<script> 
      window.location.href = '../admin/register.php?res=pswdmis';  
    </script>";
  }
}

if ("LOGIN_MOBILE_USER" == $action) {
  $idnum = $_POST['idnum'];
  $pswd = $_POST['pswd'];
  $token = bin2hex(random_bytes(6));

  if ($token) {
    $check_status = $conn->query("SELECT * FROM `users` WHERE  idnum = '$idnum'");
    if (mysqli_num_rows($check_status) > 0) {
      $row = mysqli_fetch_assoc($check_status);
      $db_pswd = $row['pwd'];

      $currentDate = new DateTime();
      $currentDate->add(new DateInterval('P7D'));
      $expdate = $currentDate->format('Y-m-d');

      if (password_verify($pswd, $db_pswd)) {
        $sql_token = $conn->query("INSERT INTO `tokens`(`accesstoken`, `userid`, `expirydatetime`) VALUES ('$token','$username','$expdate')");
        $conn->query("INSERT INTO `logs`(`log_level`, `message`, `user_id`) VALUES('INFO', 'Logging thru app', '$username')");

        if ($sql_token) {
          echo "success";
        } else {
          echo "error";
        }
      }
    }
  }
}

if ("LOGIN_ADMIN" == $action) {
  $username = $_POST['username'];
  $pswd = $_POST['pswd'];
  $token = bin2hex(random_bytes(6));

  if ($token) {

    $check_status = $conn->query("SELECT * FROM `admin` WHERE  username = '$username'");
    if (mysqli_num_rows($check_status) > 0) {
      $row = mysqli_fetch_assoc($check_status);
      $db_pswd = $row['password'];

      $currentDate = new DateTime();
      $currentDate->add(new DateInterval('P7D'));
      $expdate = $currentDate->format('Y-m-d');

      if (password_verify($pswd, $db_pswd)) {
        $sql_token = $conn->query("INSERT INTO `tokens`(`accesstoken`, `userid`, `expirydatetime`) VALUES ('$token','$username','$expdate')");
        $conn->query("INSERT INTO `logs`(`log_level`, `message`, `user_id`) VALUES('INFO', 'Logging thru app', '$username')");
        if ($sql_token) {
          $_SESSION['f_name'] = $row['f_name'];
          $_SESSION['l_name'] = $row['l_name'];
          $_SESSION['username'] = $username;
          echo "<script> 
            window.location.href = '../admin/index.php?res=ss';  
          </script>";
        } else {
          echo "<script> 
          window.location.href = '../admin/login.php?res=tknms';  
        </script>";
        }
      } else {
        echo "<script> 
          window.location.href = '../admin/login.php?res=pswdinvld';  
        </script>";
      }
    } else {
      echo "<script> 
        window.location.href = '../admin/login.php?res=invld';  
      </script>";
    }
    $conn->close();
    return;
  } else {
    echo "<script> 
      window.location.href = '../admin/login.php?res=tkn';  
    </script>";
  }
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
if ("LOGIN_USER" == $action) {
  $idnum = $_POST['id_no'];
  $pswd = $_POST['pswd'];
  $check_status = $conn->query("SELECT * FROM $table WHERE  idnum = '$idnum' AND pwd = '$pswd'");
  if (mysqli_num_rows($check_status) > 0) {
    $_SESSION['id'] = $idnum;
    echo "<script> 
      alert('Logged in Successfully');  
      window.location.href = '../admin/index.php';  
    </script>";
  } else {
    echo "<script> 
      window.location.href = '../admin/login.php?res=invalid';  
    </script>";
  }
  $conn->close();
  return;
}
if ("FORGET_PSWD" == $action) {
  $phone = $_POST['phone'];
  $check_status = $conn->query("SELECT * FROM $table WHERE  phone = '$phone'");
  if (mysqli_num_rows($check_status) > 0) {
    $code = rand(3000, 1000000);
    $sql_code = $conn->query("INSERT INTO codes (`phone`, `code`) VALUES ('$phone', '$code')");
    echo "New signin code :: $code";
  } else {
    echo "User does not exist!!!";
  }
  $conn->close();
  return;
}
if ("RELOGIN_USER" == $action) {
  $phone = $_POST['phone'];
  $code = $_POST['code'];
  $check_status = $conn->query("SELECT * FROM codes WHERE  phone = '$phone' AND code = '$code'");
  if (mysqli_num_rows($check_status) > 0) {
    echo "success";
  } else {
    echo "Error Login, Please contact admin: 07000000!!!";
  }
  $conn->close();
  return;
}
if ("GET_USERS_BY_PERIOD" == $action) {
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
if("SEND_EMAIL_PSWD" ==  $action){
  $conn->query("INSERT INTO `logs`(`log_level`, `message`, `user_id`) VALUES('INFO', 'Tried resetting password', '$username')");

  echo "Something";
  $code = rand(10000, 99999);
  $email = $_POST['email'];

  $conn->query("INSERT INTO `codes`(`phone`, `code`) VALUES ('$email', $code)");

  $subject = "Password Reset";
  $message = 'Your code is : '; 
  $headers =  'From: leonhagai@fintech.com' . "\r\n" . 
  'Reply-To: test@test.com' . "\r\n" . 
  'X-Mailer: PHP/' . phpversion(); 
  
  if(mail($email, $subject, $message, $headers)){
    echo "success";
    $conn->query("INSERT INTO `logs`(`log_level`, `message`, `user_id`) VALUES('INFO', 'Tried sending reset password email', '$username')");
  }else{
    echo "error";
  }
}