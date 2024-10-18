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
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <title> Fintech </title>

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
      display: none;
      /* Hide by default */
      position: absolute;
      /* Position it relative to the nav-item */
      top: 100%;
      /* Position below the nav-link */
      left: 0;
      /* Align with the left edge of the nav-item */
      background-color: #fff;
      /* Background color for dropdown items */
      border: 1px solid #ddd;
      /* Optional border for better visibility */
      padding: 0;
      /* Remove default padding */
      margin: 0;
      /* Remove default margin */
      list-style: none;
      /* Remove bullet points */
      z-index: 1000;
      /* Ensure dropdown is above other elements */
    }

    /* Show the dropdown when hovering over the nav-item or the dropdown itself */
    .navtem:hover .droplink,
    .droplink:hover {
      display: block;
      /* Show dropdown */
    }

    /* Style the dropdown items */
    .navitem {
      display: block;
      /* Make items stack vertically */
      padding: 0;
      /* Remove padding if not needed */
      margin: 0;
      /* Remove margin */
    }

    /* Style the links within the dropdown */
    .navlink {
      text-decoration: none;
      /* Remove underline */
      color: #000;
      /* Text color */
      display: block;
      /* Make links fill the block */
      padding: 10px;
      /* Add padding for spacing */
      white-space: nowrap;
      /* Prevent text from wrapping */
      overflow: hidden;
      /* Hide overflow text */
      text-overflow: ellipsis;
      /* Add ellipsis if text overflows */
      box-sizing: border-box;
      /* Ensure padding is included in width */
    }

    /* Optional: style for hover effect on dropdown items */
    .navitem a.navlink:hover {
      background-color: #f0f0f0;
      /* Background color on hover */
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
              WAN
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
              <li class="nav-item active">
                <a class="nav-link" href="app.apk">Download App</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="index.php">Home </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php"> About</a>
              </li>
              <li class="nav-item active navtem">
                <a class="nav-link" href="service.php">Services <span class="sr-only">(current)</span> </a>

                <ul class="droplink">
                  <li class="navitem">
                    <a class="navlink" href="service.php?focus=microcredit">Micro-Credit</a>
                  </li>
                  <li class="navitem">
                    <a class="navlink" href="service.php?focus=securesavings">MicroSavings</a>
                  </li>
                  <li class="navitem">
                    <a class="navlink" href="service.php?focus=packages">Micro Insurance</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item navtem">
                <a class="nav-link" href="ventures.php">Ventures</a>
                <ul class="droplink">
                  <li class="navitem">
                    <a class="navlink" href="./sme.php?focus=sme">SMEs</a>
                  </li>
                  <li class="navitem">
                    <a class="navlink" href="ventures.php?focus=ebikes">E-Motorbikes</a>
                  </li>
                  <li class="navitem">
                    <a class="navlink" href="ventures.php?focus=tablebanking">Table Banking</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="why.php">Why Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="team.php">Team</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin/login.php"> <i class="fa fa-user" aria-hidden="true"></i> Login</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- service section -->
  <?php
  if (isset($_GET['focus']) && $_GET['focus'] == 'microcredit') {      ?>
    <section class="service_section layout_padding py-5">
  
  <div class="container">
    <!-- Title Section -->
    <div class="heading_container heading_center mb-4">
      <h2 class="text-primary font-weight-bold">
        Microcredit <span class="text-secondary">Service</span>
      </h2>
      <p class="lead">
        <b>At WAN</b>, we are dedicated to empowering bodaboda riders by providing digital solutions that enhance the transparency and efficiency of their SACCOs/Groups, ensuring no funds are mismanaged and fostering trust among members. By offering affordable individual and group loans, and promoting the adoption of electric motorcycles, we are not only improving their financial stability but also contributing to environmental sustainability. Our commitment to setting up retirement plans addresses the uncertainty many riders face in their later years, ensuring they can retire with dignity. Our venture is about uplifting the bodaboda community, offering them a secure and hopeful future through financial inclusion and innovative technology. Try the WAN <a href="https://wan.co.ke/app.apk" class="text-primary"><b>APP</b></a>.
      </p>
    </div>

    <!-- Content Section -->
    <div class="row justify-content-center">
      <div class="col-md-12 col-lg-10">
        <div class="card shadow-lg mb-4 border-0">
          <div class="card-body p-5">
            <!-- Article Header -->
            <h5 class="card-title text-center font-weight-bold mb-4">
              The Power of Microcredit: How Small Loans Can Create Big Change
            </h5>
            <p class="text-muted text-center"><i>7/30/2024</i></p>

            <!-- Introduction Section -->
            <h4 class="font-weight-bold">Introduction</h4>
            <p class="text-justify">
              Financial stability often seems out of reach for the underprivileged. Microcredit offers a beacon of hope, providing small loans to entrepreneurs and small business owners who lack access to traditional banking services. Originating from the vision of <a target="_blank" href="https://www.nobelprize.org/prizes/peace/2006/yunus/biographical/" class="text-primary">Muhammad Yunus</a> and the <a target="_blank" href="https://grameenbank.org.bd/" class="text-primary">Grameen Bank</a>, this concept has transformed the lives of millions across the globe.
            </p>

            <!-- Impact Section -->
            <h4 class="font-weight-bold">The Impact of Microcredit on Individuals</h4>
            <p class="text-justify">
              Microcredit creates life-changing opportunities. For example, Mkenya, a small-scale farmer in Alkebulan, used a microloan to purchase better seeds and fertilizers. The increased crop yield boosted her income and allowed her to educate her children, demonstrating the ripple effect of a modest financial intervention. Another case is Mulili, a tailor in Makutano, who used a microloan to invest in a sewing machine, expanding his business and increasing his earnings.
            </p>

            <!-- How Microcredit Works -->
            <h4 class="font-weight-bold">How Microcredit Works</h4>
            <p class="text-justify">
              Microcredit operates on a simple but effective model. Small loans, ranging from a few hundred to a few thousand shillings, are provided to individuals or groups who lack access to traditional credit. These loans come with manageable repayment terms and modest interest rates. Borrowers often form groups to support each other in loan repayment, reducing risk and fostering community responsibility. Microfinance institutions (MFIs) assess loan applications, provide financial education, and offer ongoing support to borrowers.
            </p>

            <!-- Challenges Section -->
            <h4 class="font-weight-bold">Challenges and Criticisms</h4>
            <p class="text-justify">
              Microcredit faces challenges such as high interest rates, over-indebtedness, and regulatory issues. High interest rates, necessary to cover costs and manage risks, can burden borrowers, especially if their businesses don’t succeed. Over-indebtedness is another issue, as some borrowers take out multiple loans from different sources, leading to financial strain. Additionally, inadequate oversight can lead to fraud and mismanagement, threatening the sustainability of microcredit programs.
            </p>

            <!-- Innovations Section -->
            <h4 class="font-weight-bold">Innovations and Future Directions</h4>
            <p class="text-justify">
              Technological advancements are transforming the microcredit landscape. Digital platforms and mobile banking, such as Kenya's <a href="https://www.safaricom.co.ke/m-pesa" target="_blank" class="text-primary">M-Pesa</a>, make financial services more accessible, especially in remote areas. Partnerships between MFIs and larger financial institutions are expanding the reach and impact of microcredit. The future of microcredit will likely see more integration with technology, a greater focus on financial literacy, and innovative approaches to addressing borrower challenges.
            </p>

            <!-- Conclusion -->
            <h5 class="font-weight-bold text-center">Take Away</h5>
            <p class="text-justify">
              Microcredit has the potential to create significant social and economic change through small, manageable loans. By empowering individuals to start or expand their businesses, microcredit contributes to poverty alleviation and economic development. Despite challenges, continued innovation promises a bright future for microcredit.
            </p>
            <!-- <p class="text-muted text-right"><i>By Admin</i></p> -->
          </div>
        </div>
      </div>
    </div>
  </div>

 
    </section>
  <?php
  } else if (isset($_GET['focus']) && $_GET['focus'] == 'securesavings') {
  ?>
  <section class="service_section layout_padding py-5">
  <section class="service_section layout_padding py-5">
  <div class="container">
    <!-- Title Section -->
    <div class="heading_container heading_center mb-4">
      <h2 class="text-primary font-weight-bold">
        Secure Savings <span class="text-secondary">Service</span>
      </h2>
      <p class="lead ">
        Discover the power of WAN: Your trusted partner for secure savings service, offering quick access to loans, secure savings, comprehensive insurance, seamless remittances, empowering financial education, and tailored business support, all through our convenient <a href="https://wan.co.ke/app.apk" class="text-primary"><b>APP</b></a> and website.
      </p>
    </div>

    <!-- Content Section -->
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8">
        <div class="card shadow-lg mb-4 border-0">
          <div class="card-body p-5">
            <!-- Article Header -->
            <h5 class="card-title text-center font-weight-bold mb-4">Empowering Financial Security with Microsavings: A Path to Economic Stability</h5>
            <p class="text-muted text-center"><i>7/30/2024</i></p>

            <!-- Introduction Section -->
            <h4 class="font-weight-bold">Introduction</h4>
            <p class="text-justify">
              In an era where financial stability often feels elusive, microsavings has emerged as a beacon of hope for many. Microsavings, the practice of saving small amounts of money regularly, often through digital platforms, has gained traction as a tool for promoting financial security. By enabling users to save incrementally, microsavings services provide a pathway to economic stability and empowerment.
            </p>

            <!-- How Microsavings Works -->
            <h4 class="font-weight-bold">How Microsavings Services Work</h4>
            <p class="text-justify">
              Microsavings services are designed to make saving money easy and accessible. These platforms typically operate on a few core principles:
            </p>
            <ul class="list-group mb-4">
              <li class="list-group-item"><strong>Automatic Transfers:</strong> Users set up automated transfers from their checking accounts to their microsavings accounts.</li>
              <li class="list-group-item"><strong>Round-Ups:</strong> Microsavings apps automatically round up each purchase to the nearest ten shillings, saving the spare change.</li>
              <li class="list-group-item"><strong>Goal-Based Savings:</strong> Users can set specific savings goals and track their progress easily.</li>
            </ul>

            <!-- Impact on Demographics -->
            <h4 class="font-weight-bold">Impact on Different Demographics</h4>
            <p class="text-justify">
              Microsavings services have demonstrated their versatility across various demographics:
            </p>
            <ul class="list-group mb-4">
              <li class="list-group-item"><strong>Young Professionals:</strong> Many young professionals use microsavings to manage student loans or build emergency funds.</li>
              <li class="list-group-item"><strong>Low-Income Families:</strong> Microsavings provides a crucial safety net for families living on tight budgets.</li>
              <li class="list-group-item"><strong>Individuals in Developing Regions:</strong> In areas with scarce traditional banking services, microsavings provides financial inclusion opportunities.</li>
            </ul>

            <!-- Financial Literacy and Education -->
            <h4 class="font-weight-bold">Financial Literacy and Education</h4>
            <p class="text-justify">
              Microsavings platforms also contribute to financial education by offering resources, budgeting tools, and insights into spending habits.
            </p>

            <!-- Pitfalls and Future Section -->
            <h4 class="font-weight-bold">Common Pitfalls and How to Avoid Them</h4>
            <p class="text-justify">
              While microsavings offers numerous benefits, be aware of potential pitfalls such as fees, unclear goals, and security concerns.
            </p>

            <h4 class="font-weight-bold">The Future of Microsavings</h4>
            <p class="text-justify">
              The future of microsavings is bright, with ongoing innovations enhancing user experience and financial inclusion.
            </p>

            <!-- Takeaway Section -->
            <h5 class="font-weight-bold text-center">Take Away</h5>
            <p class="text-justify">
              Microsavings has proven to be a powerful tool for promoting financial security and stability. It empowers individuals to build their financial cushion and achieve their savings goals.
            </p>
            <!-- <p class="text-muted text-right"><i>By Admin</i></p> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</section>

  <?php } else if (!isset($_GET['focus'])) {
    include "section/services.php";
  } else if (isset($_GET['focus']) && $_GET['focus'] == 'packages') {
  ?>
    <section class="service_section layout_padding">
      <div class="service_container">
        <div class="container ">
          <div class="heading_container heading_center">
            <h2>
              MicroInsurance <span>Services</span>
            </h2>
            <p>
              Discover the power of WAN: Your trusted partner for microfinance services, offering quick access to loans, secure savings, comprehensive insurance, seamless remittances, empowering financial education, and tailored business support, all through our convenient <a href="https://wan.co.ke/app.apk"><b>APP</b></a> and website.
            </p>
          </div>

          <section class="service_section layout_padding py-5">
  <div class="container">
    <!-- Title Section -->
    <div class="heading_container heading_center mb-5">
      <h2 class="text-primary font-weight-bold">Comprehensive <span class="text-secondary">Microinsurance</span></h2>
      <p class="lead ">Affordable Protection for Everyone</p>
    </div>

    <!-- Content Section -->
    <div class="row justify-content-center">
      <div class="col-lg-10 col-md-12">
        <div class="card shadow-lg mb-4 border-0">
          <div class="card-body p-5">
            <!-- Article Header -->
            <h5 class="card-title text-center font-weight-bold mb-4">
              Comprehensive Microinsurance: Affordable Protection for Everyone
            </h5>
            <p class="text-center text-muted"><i>7/30/2024</i></p>

            <!-- Introduction -->
            <h4 class="font-weight-bold">Introduction</h4>
            <p class="text-justify">
              In an unpredictable world, the need for insurance is undeniable. However, for many low-income individuals and families, traditional insurance options remain out of reach due to high premiums and complex requirements. Microinsurance provides affordable and accessible coverage to those who need it most. This blog explores how microinsurance works, its benefits, real-life impact, and the challenges it faces.
            </p>

            <!-- What is Microinsurance? -->
            <h4 class="font-weight-bold">What is Microinsurance?</h4>
            <p class="text-justify">
              Microinsurance refers to low-cost insurance products designed specifically for low-income individuals who typically lack access to traditional insurance. It provides financial protection against risks such as health issues, accidents, and property damage at an affordable rate.
            </p>

            <!-- Key Features Section -->
            <h4 class="font-weight-bold">Key Features</h4>
            <ul class="list-group mb-4">
              <li class="list-group-item">Affordable Premiums: Premiums as low as a few dollars per month.</li>
              <li class="list-group-item">Simplified Processes: Streamlined application and claims processes.</li>
              <li class="list-group-item">Varied Coverage Types: Health, life, property insurance, and more, tailored to underserved communities.</li>
            </ul>

            <!-- Benefits Section -->
            <h4 class="font-weight-bold">Benefits of Microinsurance</h4>
            <ul class="list-group mb-4">
              <li class="list-group-item"><strong>Mitigating Risks:</strong> Provides protection against unexpected events like illnesses or natural disasters, helping avoid financial hardship.</li>
              <li class="list-group-item"><strong>Peace of Mind:</strong> Policyholders face uncertainties confidently, knowing they have financial protection.</li>
              <li class="list-group-item"><strong>Supporting Recovery:</strong> Helps cover medical expenses or repair damaged property, aiding in faster recovery.</li>
              <li class="list-group-item"><strong>Encouraging Entrepreneurship:</strong> With a safety net, individuals can take risks that contribute to economic growth.</li>
              <li class="list-group-item"><strong>Improved Access to Healthcare:</strong> Microinsurance policies often include health coverage, improving access to treatments and preventive care.</li>
            </ul>

            <!-- Success Stories Section -->
            <h4 class="font-weight-bold">Success Stories: Real-Life Impact</h4>
            <div class="alert alert-info">
              <strong>Case Study 1: Health Insurance in Kenya</strong><br>
              <i>A small-scale farmer in Kenya was able to afford necessary surgery through microinsurance, avoiding debt and returning to work to support his family.</i>
            </div>
            <div class="alert alert-info">
              <strong>Case Study 2: Life Insurance in Rural India</strong><br>
              <i>A family received a payout to cover funeral expenses and daily costs after the loss of their breadwinner, helping them maintain their household.</i>
            </div>

            <!-- Challenges Section -->
            <h4 class="font-weight-bold">Challenges and Considerations</h4>
            <ul class="list-group mb-4">
              <li class="list-group-item"><strong>Affordability vs. Coverage:</strong> Balancing low premiums with meaningful coverage.</li>
              <li class="list-group-item"><strong>Awareness and Education:</strong> Many individuals are unaware of microinsurance options, requiring effective outreach.</li>
              <li class="list-group-item"><strong>Sustainability of Providers:</strong> Providers need to ensure that policies are viable while delivering value to policyholders.</li>
            </ul>

            <!-- The Future Section -->
            <h4 class="font-weight-bold">The Future of Microinsurance</h4>
            <p class="text-justify">
              <b>Technological Innovations:</b> Digital platforms are making it easier to enroll, manage policies, and file claims, enhancing accessibility.<br>
              <b>Expansion and Accessibility:</b> As technology advances, microinsurance is reaching underserved regions, with future developments expanding coverage options.
            </p>

            <!-- Takeaway Section -->
            <h5 class="font-weight-bold text-center">Take Away</h5>
            <p class="text-justify">
              Microinsurance offers essential financial protection to low-income individuals and families. By investing in microinsurance, individuals not only purchase a policy but also invest in financial security and peace of mind.
            </p>
            <!-- <p class="text-muted text-right"><i>By Admin</i></p> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

        </div>
      </div>
    </section>
  <?php } ?>

  <!-- end service section -->
  <!-- info section -->
  <?php include "section/footer.php"; ?>