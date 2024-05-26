<?php include '../api/db_conn.php'; ?>
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

</head>

<body class="sub_page">
  <?php
    if(!isset($_SESSION['username'])){
        echo "
        <script>
        window.location.href = 'login.php?res=ss_nn'; 
        </script>
        ";
    }
    if(isset($_GET['res'])){
      if($_GET['res'] == 'ss'){
        echo "
        <script>
        alert('Welcome to Fintech Admin Portal');
        window.location.href = 'index.php'; 
        </script>
        ";
      }
    }
  ?>

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
              <li class="nav-item">
                <a class="nav-link" href="profile.php">Welcome: 
                  <?php if (isset($_SESSION['username'])) {
                    echo $_SESSION['username'];
                  } else { echo "User";} ?>
                </a>
              </li>
              <span style="color: white;">||</span>
              <li class="nav-item active">
                <a class="nav-link" href="../app.apk">Download App</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="../index.php">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php" style="color: red !important;">Logout</a>
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
    $get_dashboard = $conn->query('SELECT * FROM `dashboard` WHERE `status` = "Active"')
  ?>
  <section class="team_section pt-5 pb-5 mt-1 mb-1" style=" width: 100%; display: flex; justify-content: center;">
    <div class="row container">
      <?php while ($row = mysqli_fetch_assoc($get_dashboard)) { ?>
        <style>
          .item-content:hover a {
            color: blue;
          }
        </style>
        <div class="dashboard-item col-lg-3 col-md-3 col-sm-4">
          <div class="item-content">
            <a href="details.php?page=<?= $row['title'] ?>" class="text-light">
              <h2><?= $row['title'] ?></h2>
            </a>
            <?php if ($row['title'] == "Users" || $row['title'] == "Kins" || $row['title'] == "Friends" || $row['title'] == "Guarantors" || $row['title'] == "Chamas") { ?>
              <p><?= number_format($row['total']) ?></p>
            <?php } else { ?>
              <p><span class="amnt">Kshs.</span><?= number_format($row['total'], 2) ?></p>

            <?php } ?>
            <hr class="divider">
            <div class="item-details">
              <div class="detail-column">
                <?php if ($row['title'] == "Users" || $row['title'] == "Kins" || $row['title'] == "Friends" || $row['title'] == "Guarantors" || $row['title'] == "Chamas") { ?>
                  <p><span class="l_wk"> Pre Week: </span><?= number_format($row['pre_week']) ?></p>
                <?php } else { ?>
                  <p><span class="l_wk"> Pre Week: </span><span class="amnt">Kshs.</span> <?= number_format($row['pre_week'], 2) ?></p>
                <?php } ?>
              </div>
              <div class="detail-column">
                <p></p>
              </div>
              <div class="detail-column">
                <?php if ($row['direction'] == "up") { ?>
                  <p class="rate" style="color: green;"><?= $row['rate'] ?>%</p>
                <?php } else { ?>
                  <p class="rate" style="color: red;"><?= $row['rate'] ?>%</p>
                <?php }  ?>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>
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
  <!-- End Google Map -->

</body>

</html>