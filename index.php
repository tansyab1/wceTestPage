
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Wireless Capsule Endoscopy Subjective Test">
    <meta name="description" content="">
    <title>WCE Test</title>
    <link rel="icon" href="/~tansy.nguyen/images/logoLAGA.png" type="image/x-icon">
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="login.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="login.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 4.19.3, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i">
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "WebSite2986854"
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="login">
    <meta property="og:type" content="website">
  </head>
  <body data-home-page="index.php" data-home-page-title="login" class="u-body u-overlap u-xl-mode" data-lang="en">
    <section class="skrollable u-align-center u-clearfix u-image u-parallax u-section-1" id="sec-b92b" data-image-width="1424" data-image-height="1000">
      <div class="u-clearfix u-sheet u-sheet-1">
        <a href="index.php" class="u-image u-logo u-image-1" data-image-width="217" data-image-height="193" title="login">
          <img src="images/laga-l2ti.png" class="u-logo-image u-logo-image-1">
        </a>
        <h2 class="u-custom-font u-font-ubuntu u-subtitle u-text u-text-default u-text-1">Wireless Capsule Endoscopy Subjective Test</h2>
        <div class="u-form u-login-control u-form-1">
          <form action="#mainpage" method="POST" class="u-clearfix u-form-custom-backend u-form-spacing-10 u-form-vertical u-inner-form" source="custom" name="form" style="padding: 0px;" redirect="true">
            <div class="u-form-group u-form-name u-label-top">
              <label for="username-a30d" class="u-label u-label-1">Email address *</label>
              <input type="text" placeholder="Enter your email address" id="username-a30d" name="username" class="u-border-8 u-border-white u-input u-input-rectangle u-radius-50 u-white u-input-1" required="">
            </div>
            <div class="u-form-group u-form-password u-label-top">
              <label for="password-a30d" class="u-label u-label-2">Password *</label>
              <input type="password" placeholder="Enter your Password" id="password-a30d" name="password" class="u-border-8 u-border-white u-input u-input-rectangle u-radius-50 u-white u-input-2" required="">
            </div>
            <div class="u-form-checkbox u-form-group u-label-top">
              <input type="checkbox" id="checkbox-a30d" name="remember" value="On">
              <label for="checkbox-a30d" class="u-label u-label-3">Remember me</label>
            </div>
            <div class="u-align-left u-form-group u-form-submit u-label-top">
              <input type="submit" value="submit" class="u-form-control-hidden" name="login" onclick="IsrememberMe()">
              <a class="u-active-white u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-white u-palette-4-dark-2 u-radius-50 u-text-active-black u-text-hover-palette-4-base u-btn-1">Login</a>
            </div>
            <!-- check the login button is clicked-->
            <?php
            session_start();
            if(isset($_POST['login'])){
              // load data from the database to check the user is valid or not
              $username = $_POST['username'];
              $password = $_POST['password'];
              // connect to the database
              $conn = mysqli_connect("localhost","capsule","Malinim+59","endoscopy");
              // $conn = mysqli_connect("wcetest-do-user-13153530-0.b.db.ondigitalocean.com","tansy","AVNS_doKxqqz5IHiYyYSw_Jl","DATA",25060);
              // check the user is valid or not
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }
              $sql = "SELECT * FROM `userNote` WHERE `email` = '$username' AND `passwordUser` = '$password'";
              $result = mysqli_query($conn,$sql);
              $num = mysqli_num_rows($result);
              if($num == 1){
                // if the user is valid then start the session for the user and redirect to the main page
                
                $_SESSION['username'] = $username;
                // get the id of the user
                $sql = "SELECT `id` FROM `userNote` WHERE `email` = '$username'";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($result);
                $id = $row['id'];
                $_SESSION['id'] = $id;

                // select pass the test or not
                $sql = "SELECT `pass` FROM `userNote` WHERE `email` = '$username'";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($result);
                $pass = $row['pass'];
                // check the user is pass the test or not
                if($pass == 0){
                  // redirect to the main page
                echo "<p style='color:green;'>Login successfully. User sesstion is started</p>";
                echo "<meta http-equiv='refresh' content='2;url=mainpage.php'>";
                }else{
                  // redirect to the test page
                  echo "<p style='color:green;'>Login successfully. User sesstion is started</p>";
                  echo "<meta http-equiv='refresh' content='0;url=result.php'>";
                }
                
              }else{
                // if the user is invalid then show the error message
                // align the error message to the center
                echo "<div class='u-align-center u-form-group u-form-submit u-label-top'>";
                // show the error message
                echo "<p style='color:red;'>Invalid username or password</p>";
                echo "</div>";
              }

            }
            ?>
            <input type="hidden" value="" name="recaptchaResponse">
          </form>
        </div>
        <a href="signup.php" class="u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-btn u-btn-round u-button-style u-hover-feature u-none u-btn-2">Do not have an account ?</a>
        <a href="resetPassword.php" class="u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-btn u-btn-round u-button-style u-hover-feature u-none u-btn-2">Forgot your password?</a>
      </div>
      
    </section>
    
    
    <footer class="u-align-center u-clearfix u-footer2 u-grey-80 u-footer2" id="sec-2ee3"><div class="u-clearfix u-sheet u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">© 2022 Université Sorbonne Paris Nord, LAGA-L2TI laboratoire, All Rights Reserved.</p>
      </div></footer>
    
  
</body></html>