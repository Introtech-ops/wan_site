<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="../images/favicon.png" type="">

  <title> Admin | Fintech </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="../css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="../css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../css/responsive.css" rel="stylesheet" />
  <link href="../css/admin.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

</head>

<body class="sub_page">

  <div class="hero_area">

    <div class="hero_bg_box">
      <div class="bg_img_box">
        <img src="images/hero-bg.png" alt="">
      </div>
    </div>

    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <span>
              Fintech || Admin
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
              <li class="nav-item active">
                <a class="nav-link" href="../app.apk">Download App</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Dashboard</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>
  <!-- why section -->
  <?php
  include '../api/db_conn.php';

  $page = $_GET['page'];

  echo "<script> var page = '$page'; </script>";
  ?>
  <div style="justify-content: center; margin-right: 30%; margin-left: 30%;" class="row container">
    <input type="text" id="myInput" class="col-md-8 col-sm-8 form-control" placeholder="Search...">

    <div class="col-md-4 col-sm-4 tbl-controls">
      <button class="btn btn-sm btn-outline-success dropdown-toggle" type="button" id="exportDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Generate Report
      </button>
      <div class="dropdown-menu" aria-labelledby="exportDropdown">
        <button class="dropdown-item" onclick="exec()">Excel</button>
      </div>
    </div>
  </div>
  <section class="table-responsive container service_section pt-5 pb-5 mt-1 mb-1" style=" width: 100%; display: flex; justify-content: center;">
    <?php
    if ($page == "Deposits") {
    ?>
      <table class="table table-bordered" id="myTable">
        <thead>
          <tr>
            <th>Trans ID</th>
            <th>Type</th>
            <th>Credit</th>
            <th>Debit</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          </tr>
        </tbody>
      </table>
    <?php } else if ($page == "Withdrawals") { ?>
      <table class="table table-bordered" id="myTable">
        <thead>
          <tr>
            <th>Count</th>
            <th>Member ID</th>
            <th>Group ID</th>
            <th>Saving ID</th>
            <th>Amount</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          </tr>
          <!-- Add more rows -->
        </tbody>
      </table>

    <?php } else if ($page == "Loans") {
      $sql_tbl = $conn->query("SELECT * FROM loans ") ?>
      <table class="table table-bordered" id="myTable">
        <thead>
          <tr>
            <th>Count</th>
            <th>Member ID</th>
            <th>Loan ID</th>
            <th>Amount</th>
            <th>Interest Rate</th>
            <th>Duration</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($sql_tbl)) {
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['member_id'] ?></td>
              <td><?= $row['loan_id'] ?></td>
              <td><?= $row['date'] ?></td>
              <td>Kshs. <?= $row['amount'] ?></td>
              <td><?= $row['interest_rate'] ?>%</td>
              <td><?= $row['duration'] ?></td>
              <td><?= $row['status'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else if ($page == "Transactions") {
      $sql_tbl = $conn->query("SELECT * FROM savings ") ?>
      <table class="table table-bordered" id="myTable">
        <thead>
          <tr>
            <th>Date</th>
            <th>Trans Id</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Credit</th>
            <th>Debit</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($sql_tbl)) {
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['member_id'] ?></td>
              <td><?= $row['group_id'] ?></td>
              <td><?= $row['saving_id'] ?></td>
              <td>Kshs. <?= $row['amount'] ?></td>
              <td><?= $row['date'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else if ($page == "Savings") {
      $sql_tbl = $conn->query("SELECT * FROM savings ") ?>
      <table class="table table-bordered" id="myTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Member ID</th>
            <th>Group ID</th>
            <th>Saving ID</th>
            <th>Amount</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($sql_tbl)) {
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['member_id'] ?></td>
              <td><?= $row['group_id'] ?></td>
              <td><?= $row['saving_id'] ?></td>
              <td>Kshs. <?= $row['amount'] ?></td>
              <td><?= $row['date'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else if ($page == "Contributions") {
      $sql_tbl = $conn->query("SELECT * FROM contributions ") ?>
      <table class="table table-bordered" id="myTable">
        <thead>
          <tr>
            <th>Count</th>
            <th>Contributions ID</th>
            <th>Group ID</th>
            <th>User ID</th>
            <th>Amount</th>
            <th>Created At.</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($sql_tbl)) {
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['contid'] ?></td>
              <td><?= $row['groupid'] ?></td>
              <td><?= $row['userid'] ?></td>
              <td>Kshs. <?= $row['amount'] ?></td>
              <td><?= $row['dateAdded'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else if ($page == "Users") {
      $sql_tbl = $conn->query("SELECT * FROM users ") ?>
      <table class="table table-bordered" id="myTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Nat Id.</th>
            <th>Phone</th>
            <th>Loan Limit</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($sql_tbl)) {
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['name'] ?></td>
              <td><?= $row['idnum'] ?></td>
              <td><?= $row['phone'] ?></td>
              <td>Kshs. <?= $row['loanlimit'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else if ($page == "Kins") {
      $sql_tbl = $conn->query("SELECT * FROM kins ") ?>
      <table class="table table-bordered" id="myTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Relation</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
            <th>User ID</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($sql_tbl)) {
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['name'] ?></td>
              <td><?= $row['relationship'] ?></td>
              <td><?= $row['contact'] ?></td>
              <td><?= $row['email'] ?></td>
              <td><?= $row['address'] ?></td>
              <td><?= $row['user_id'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else if ($page == "Friends") {
      $sql_tbl = $conn->query("SELECT * FROM friends ") ?>
      <table class="table table-bordered" id="myTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Friend 1</th>
            <th>Friend 2</th>
            <th>Status</th>
            <th>Created At.</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($sql_tbl)) {
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['friend1'] ?></td>
              <td><?= $row['friend2'] ?></td>
              <td><?php if ($row['status'] == '1') {
                    print("Accepted");
                  } else {
                    print('Pending');
                  } ?></td>
              <td><?= $row['created_at'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else if ($page == "Guarantors") {
      $sql_tbl = $conn->query("SELECT * FROM guarantors ") ?>
      <table class="table table-bordered" id="myTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Name</th>
            <th>Nat ID No.</th>
            <th>Contact</th>
            <th>Relation</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($sql_tbl)) {
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['user_id'] ?></td>
              <td><?= $row['guarantor_name'] ?></td>
              <td><?= $row['guarantor_id_no'] ?></td>
              <td><?= $row['guarantor_contact'] ?></td>
              <td><?= $row['relationship'] ?></td>
              <td><?= $row['created_at'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else if ($page == "Chamas") {
      $sql_tbl = $conn->query("SELECT * FROM chama ")
    ?>
      <table class="table table-bordered" id="myTable">
        <thead>
          <tr>
            <th>Count</th>
            <th>Identifier</th>
            <th>Name</th>
            <th>Created By</th>
            <th>Created AT</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($sql_tbl)) {
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['identifier'] ?></td>
              <td><?= $row['name'] ?></td>
              <td><?= $row['userid'] ?></td>
              <td><?= $row['date_created'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } ?>
  </section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
      });
    });

    function exec() {
      if (page == 'Deposits') {
        console.log("Something");
        exportToExcel();
      } else if (page == 'Withdrawals') {
        console.log("Withd Ese");
        // const currentdate = new Date();
        // var url = "http://localhost/projects/fintech/api/users.php?action=GET_ALL";
        // var filename = "Users_"+currentdate+".xlsx";
        // exportToExcel(url, filename);
      } else if (page == 'Loans') {
        console.log("Loans Ese");
      } else if (page == 'Transactions') {
        console.log("Trans Ese");
      } else if (page == 'Savings') {
        console.log("Savings Ese");
      } else if (page == 'Contributions') {
        console.log("Contri Ese");
      } else if (page == 'Users') {
        console.log("Users Data");
        // const currentdate = new Date();
        // var url = "http://localhost/projects/fintech/api/users.php?action=GET_ALL";
        // var filename = "Users_"+currentdate+".xlsx";
        // exportToExcel(url, filename);
      } else if (page == 'Kins') {
        console.log("Kins Ese");
      } else if (page == 'Friends') {
        console.log("Friends Ese");
      } else if (page == 'Guarantors') {
        console.log("Guarantors Ese");
      } else if (page == 'Chamas') {
        console.log("Chamas Ese");
      }
    }

    function fetchData(uri) {
      return fetch(uri)
        .then(response => response.json())
        .then(data => {
          return data;
        })
        .catch(error => {
          console.error('Error fetching data:', error);
          throw error; // Propagate the error
        });
    }

    function exportToExcel(url, name) {
      // Assuming your JSON data is stored in a variable called 'jsonData'
      fetchData(url)
        .then(dummyData => {
          console.log("LOGGGING");
          console.log(dummyData);

          const ws = XLSX.utils.json_to_sheet(dummyData);
          const wb = XLSX.utils.book_new();
          XLSX.utils.book_append_sheet(wb, ws, "Summary");
          console.log('Recieving');

          var filename = name + ".xlsx";

          // Save the file
          XLSX.writeFile(wb, filename);
        })
        .catch(error => {
          // Handle errors here
        });
    }
  </script>
  <!-- end why section -->

  <!-- info section -->
  <section class="info_section layout_padding2">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3 info_col">
          <div class="info_contact">
            <h4>
              Address
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Location
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call +01 1234567890
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  info@mail.com
                </span>
              </a>
            </div>
          </div>
          <div class="info_social">
            <a href="">
              <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-linkedin" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 info_col">
          <div class="info_detail">
            <h4>
              Info
            </h4>
            <p>
              necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 mx-auto info_col">
          <div class="info_link_box">
            <h4>
              Links
            </h4>
            <div class="info_links">
              <a class="active" href="../index.php">
                Home
              </a>
              <a class="" href="../about.php">
                About
              </a>
              <a class="" href="../service.php">
                Services
              </a>
              <a class="" href="../why.php">
                Why Us
              </a>
              <a class="" href="../team.php">
                Team
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 info_col ">
          <h4>
            Subscribe
          </h4>
          <form action="#">
            <input type="text" placeholder="Enter email" />
            <button type="submit">
              Subscribe
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- end info section -->

  <!-- footer section -->
  <section class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> Powered By
        <a href="https://introtech.co.ke/" target="_blank">Introtech</a>
      </p>
    </div>
  </section>
  <!-- footer section -->

  <!-- jQery -->
  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script type="text/javascript" src="../js/bootstrap.js"></script>
  <!-- owl slider -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- custom js -->
  <script type="text/javascript" src="../js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map --><!-- Add the jQuery library -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Add the DataTables JavaScript file -->
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

  <script>
    $(document).ready(function() {
      // Initialize DataTables
      $('#myTable').DataTable();
    });
  </script>

</body>

</html>