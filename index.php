<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="WAN" />
  <meta name="description" content="WAN: Financial Harmony, Community Prosperity." />
  <meta name="author" content="Introtech" />
  <!-- Site Metas -->
  <meta name="keywords" content="WAN" />
  <meta name="description" content="Financial Harmony, Community Prosperity. Explore how microcredit, through small loans, creates significant economic change and empowers individuals. Learn about its impact, challenges, and future innovations in this detailed blog post." />
  <meta name="author" content="IntroTech" />
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <title> WAN </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

    <style>
        /* Ensure the nav-item is positioned relatively to align the dropdown properly */
        .navtem {
          position: relative;
        }
        
        /* Style the dropdown menu */
        .droplink {
          display: none; /* Hide by default */
          position: absolute; /* Position it relative to the nav-item */
          top: 100%; /* Position below the nav-link */
          left: 0; /* Align with the left edge of the nav-item */
          background-color: #fff; /* Background color for dropdown items */
          border: 1px solid #ddd; /* Optional border for better visibility */
          padding: 0; /* Remove default padding */
          margin: 0; /* Remove default margin */
          list-style: none; /* Remove bullet points */
          z-index: 1000; /* Ensure dropdown is above other elements */
        }
        
        /* Show the dropdown when hovering over the nav-item or the dropdown itself */
        .navtem:hover .droplink,
        .droplink:hover {
          display: block; /* Show dropdown */
        }
        
        /* Style the dropdown items */
        .navitem {
          display: block; /* Make items stack vertically */
          padding: 0; /* Remove padding if not needed */
          margin: 0; /* Remove margin */
        }
        
        /* Style the links within the dropdown */
        .navlink {
          text-decoration: none; /* Remove underline */
          color: #000; /* Text color */
          display: block; /* Make links fill the block */
          padding: 10px; /* Add padding for spacing */
          white-space: nowrap; /* Prevent text from wrapping */
          overflow: hidden; /* Hide overflow text */
          text-overflow: ellipsis; /* Add ellipsis if text overflows */
          box-sizing: border-box; /* Ensure padding is included in width */
        }
        
        /* Optional: style for hover effect on dropdown items */
        .navitem a.navlink:hover {
          background-color: #f0f0f0; /* Background color on hover */
        }
        
        /* Optional: add transition effect for dropdown appearance */
        .droplink {
          transition: opacity 0.3s ease;
        }
        
        .navtem:hover .droplink {
          opacity: 1;
        }
        
        .droplink {
          opacity: 0;
        }
        
        .navtem:hover .droplink {
          opacity: 1;
        }
    </style>

</head>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<body>

  <div class="hero_area">

    <div class="hero_bg_box">
      <div class="bg_img_box">
        <img src="images/hero-bg.png" alt="">
      </div>
    </div>

    <!-- header section strats -->
    <?php include "section/header.php"; ?>
    <!-- end header section -->
    <!-- slider section -->
 <section class="slider_section ">
  <div id="customCarousel1" class="carousel slide" data-ride="carousel" data-bs-interval='2000' >
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container ">
          <div class="row">
            <div class="col-md-6 ">
              <div class="detail-box">
                <h1>
                  Financial Harmony, <br>
                  Community Prosperity
                </h1>
                <p>
                  Harmonize your finances for the prosperity of your community. Our SACCOS and financial solutions create a symphony of stability, growth, and shared success.
                </p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="img-box">
                <img src="images/slider-img.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Other carousel items -->
      <div class="carousel-item">
        <div class="container ">
          <div class="row">
            <div class="col-md-6 ">
              <div class="detail-box">
                <h1>
                  Unlock Prosperity, <br>
                  Secure Tomorrow
                </h1>
                <p>Unlock the doors to prosperity and secure your financial tomorrow. Our SACCOS and financial solutions are designed to safeguard your dreams and create a path to wealth.
                </p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="img-box">
                <img src="images/slider-img.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container ">
          <div class="row">
            <div class="col-md-6 ">
              <div class="detail-box">
                <h1>
                Building Wealth,
                 <br>
                 Building Trust
                </h1>
                <p>Unlock the doors to prosperity and secure your financial tomorrow. Our SACCOS and financial solutions are designed to safeguard your dreams and create a path to wealth.
                </p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="img-box">
                <img src="images/slider-img.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- More carousel items -->
    </div>
    <ol class="carousel-indicators">
      <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
      <li data-target="#customCarousel1" data-slide-to="1"></li>
      <li data-target="#customCarousel1" data-slide-to="2"></li>
    </ol>
  </div>
</section>

    <!-- end slider section -->
  </div>


  <!-- sections -->
   <?php include "section/services.php"; ?>
   
  <?php
  // include "section/services.php";
   //include "section/about.php";
  // include "section/whyus.php";
  // include "section/team.php";
  include "section/footer.php"; 
  ?>
  <!-- end sections -->