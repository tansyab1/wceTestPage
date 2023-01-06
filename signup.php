<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="Registration">
  <meta name="description" content="">
  <title>Registration</title>
  <link rel="icon" href="/~tansy.nguyen/images/logoLAGA.png" type="image/x-icon">
  <link rel="stylesheet" href="nicepage.css" media="screen">
  <link rel="stylesheet" href="signup.css" media="screen">
  <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
  <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
  <!-- <script class="u-script" type="text/javascript" src="custom.js" defer=""></script> -->
  <meta name="generator" content="Nicepage 4.19.3, nicepage.com">
  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">



  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "WebSite2986854"
    }
  </script>
  <meta name="theme-color" content="#478ac9">
  <meta property="og:title" content="signup">
  <meta property="og:type" content="website">
</head>


<body class="u-body u-xl-mode" data-lang="en">
  <section class="u-clearfix u-grey-90 u-section-1" id="sec-3a86">
    <div class="u-clearfix u-sheet u-sheet-1">
      <h2 class="u-align-center u-text u-text-default u-text-1">Registration</h2>
      <img class="u-expanded-height u-image u-image-default u-preserve-proportions u-image-1" src="images/laga-l2ti.png" alt="" data-image-width="217" data-image-height="193" data-href="index.php">
    </div>
  </section>
  
  <section class="skrollable u-clearfix u-image u-parallax u-section-2" id="sec-aa70" data-image-width="1424" data-image-height="1000">
    
    <div class="u-align-center u-form u-form-1">
    <!-- fdhqfdqhkfdqhfdskq -->
      <form action="signup.php" source="gsheets" name="form" style="padding: 10px;" method="post">
        <div class="u-form-group u-form-name u-form-partition-factor-2">
          <label for="name-27bd" class="u-label">First Name(*)</label>
          <input type="text" placeholder="Enter your Name" id="name-27bd" name="firstname" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
        </div>
        <div class="u-form-group u-form-name u-form-partition-factor-2 u-form-group-2">
          <label for="name-745e" class="u-label">Last Name(*)</label>
          <input type="text" placeholder="Enter your Name" id="name-745e" name="lastname" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
        </div>
        <div class="u-form-email u-form-group">
          <label for="email-27bd" class="u-label">Email(*)</label>
          <input type="email" placeholder="Enter a valid email address" id="email-27bd" name="email" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
        </div>

        <div class="u-form-group u-form-name u-form-partition-factor-2 u-form-group-2">
          <label for="name-745e" class="u-label">Password(*)</label>
          <input type="password" placeholder="Enter your Password" id="pass-745e" name="password" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
          <!-- <span> <input id="password-show" type="checkbox" onclick="showPassword()">Show Password</span> -->
        </div>

        <div class="u-form-date u-form-group u-form-group-4">
          <label for="date-8e2b" class="u-label">How old are you?(*)</label>
          <input type="text" placeholder="Enter your age" id="date-8e2b" name="birthdate" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
        </div>
        <div class="u-form-group u-form-select u-form-group-5">
          <label for="select-21e7" class="u-label">Level and type of expertise(*)</label>
          <div class="u-form-select-wrapper">
            <select id="select-21e7" name="majority" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="required">
              <option value="gas-expert">Gastroenterology Expert</option>
              <option value="qua-expert">Quality Assessment Expert</option>
              <option value="img-expert">Image Processing Expert</option>
              <option value="nonexpert">Non-Experts</option>
            </select>
            <svg class="u-caret u-caret-new" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" style="fill:currentColor;" xml:space="preserve">
              <polygon class="st0" points="8,12 2,4 14,4 "></polygon>
            </svg>
          </div>
        </div>

        <!-- create a space of 2 cm -->
        <div style="height: 1cm"></div>

        <div class="u-form-agree u-form-group u-form-group-6">
          <input type="checkbox" id="agree-553e" name="agree" class="u-agree-checkbox" required="">
          <label for="agree-553e" class="u-agree-label u-label">I accept the <a href="https://www.termsfeed.com/live/9e6c8eb3-7dd7-4ffd-b75f-63925a4e358b" target="_blank">Terms of Service</a>
          </label>
        </div>


        <div class="u-align-left u-form-group u-form-submit">
          <a href="" class="u-border-2 u-border-black u-btn u-btn-submit u-button-style u-hover-black u-none u-text-black u-text-hover-white u-btn-1">Register</a>
          <input type="submit" value="submit" class="u-form-control-hidden" name="register">
        </div>

        <!-- php code check if the button is clicked, connect to the server-->
        <?php
        if (isset($_POST['register'])) {
          // open session to store the data
          // session_start();
          // connect to the server
          $firstname = $_POST['firstname'];
          $lastname = $_POST['lastname'];
          $email = $_POST['email'];
          $password_user = $_POST['password'];
          $date = $_POST['birthdate'];
          // get time today
          $today = date("Y-m-d");
          // get ip address
          //whether ip is from the share internet  
          if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
          }
          //whether ip is from the proxy  
          elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
          }
          //whether ip is from the remote address  
          else {
            $ip = $_SERVER['REMOTE_ADDR'];
          }
          $ip = $_SERVER['REMOTE_ADDR'];
          $majority = $_POST['majority'];
          $agree = $_POST['agree'];
          
          // $conn = mysqli_connect("wcetest-do-user-13153530-0.b.db.ondigitalocean.com","doadmin","AVNS_8WsUdQ7GU9RwUI5S9gd","DATA", 25060);
          $conn = mysqli_connect("localhost","capsule","Malinim+59","endoscopy");
              
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          $sql = "INSERT INTO userNote (timeStamp, firstName, lastName, birthdate, email, passwordUser, majority,ipAddress)
            VALUES ('$today', '$firstname', '$lastname', '$date', '$email', '$password_user', '$majority','$ip')";

          // check if the user is exist in the database
          $sql_check = "SELECT * FROM userNote WHERE email = '$email'";
          $result = $conn->query($sql_check);
          $num_rows = mysqli_num_rows($result);
          if ($num_rows > 0) {
            echo "The user is already exist! Please try again!";
          } else {
            if ($conn->query($sql) === TRUE) {
              echo "<p style='color:green;'>New record created successfully. Login page is redirected in 5s</p>";
              // add meta html to redirect to the next page
              echo "<meta http-equiv='refresh' content='2;url=index.php'>";
            } else {
              echo "<p style='color:red;'>Error (Unable to create your account. Please fix errors then try again) </p>" . $sql . "<br>" . $conn->error;
            }
          }
          $conn->close();
          // close session
          // session_destroy();
        }
        ?>


        <!-- <div class="u-form-send-message u-form-send-success">Thank you! Your account has been created successfull. Please come back login to start the experiment.</div>
          <div class="u-form-send-error u-form-send-message">Unable to create your account. Please fix errors then try again.</div> -->
        <input type="hidden" value="" name="recaptchaResponse">
        <input type="hidden" name="formServices" value="1079bdce-89fc-46dc-9914-799f2a43c1e6">
      </form>
    </div>
  </section>


  <footer class="u-align-center u-clearfix u-footer2 u-grey-80 u-footer2" id="sec-2ee3">
    <div class="u-clearfix u-sheet u-sheet-1">
      <p class="u-small-text u-text u-text-variant u-text-1">© 2022 Université Sorbonne Paris Nord, LAGA-L2TI laboratoire, All Rights Reserved.</p>
    </div>
  </footer>

</body>

</html>