
  <!-- info section -->

  <section class="info_section layout_padding2">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3 info_col">
          <div class="info_contact">
            <h4>
              ADDRESS
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  1724,Kisumu.
                </span>
              </a>
              <a href="tel:+254727964903">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  +254 727 964 903
                </span>
              </a>
              <a href="mailto:info@wan.co.ke">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  info@wan.co.ke
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
        <div class="col-md-6 col-lg-2 mx-auto info_col">
          <div class="info_link_box">
            <h4 class='fw-bolder'>
              LINKS
            </h4>
            <div class="info_links">
              <a class="active" href="index.php">
                Home
              </a>
              <a class="" href="about.php">
                About
              </a>
              <a class="" href="service.php">
                Services
              </a>
              <a class="" href="why.php">
                Why Us
              </a>
              <a class="" href="team.php">
                Team
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 info_col ">
            <h4>
                SUBSCRIBE
            </h4>
            <form action="" method="POST">
                <input type="text" placeholder="Enter email, ONLY get tailored updates." name="sub_mail"/>
                <button type="submit" name="submit_email">
                  Subscribe
                </button>
            </form>
            <?php
                if(isset($_POST['submit_email'])){
                    $email = $_POST['sub_mail'];
                    if(empty($email)){
                        echo "Fill the required input!";
                        return;
                    }
                    
                    $stmt = $conn->prepare("INSERT INTO subscription (email, created_at) VALUES (?, NOW())");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->close();
                    $conn->close();
                }
            ?>
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
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <!-- owl slider -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- custom js -->
  <script type="text/javascript" src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->

</body>

</html>