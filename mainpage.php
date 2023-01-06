<!-- php start the session -->
<?php
session_start();
include 'getVideo.php';
// check the user is logged in. if not then redirect to the login page
if (!isset($_SESSION['username'])) {
  // show alert message to the user and redirect to the login page
  echo "<script>alert('You are not logged in. Please login to access the main page')</script>";
  echo "<meta http-equiv='refresh' content='0;url=index.php'>";
  // header("Location: index.php");
  // eles if the user is logged in then create table for the user
} else {
  
  // connect to the database
  // $conn = mysqli_connect("remotemysql.com", "g3uw65oJMS", "x6sPplebaq", "g3uw65oJMS");
  // $conn = mysqli_connect("wcetest-do-user-13153530-0.b.db.ondigitalocean.com","doadmin","AVNS_8WsUdQ7GU9RwUI5S9gd","DATA", 25060);
              
  $conn = mysqli_connect("localhost","capsule","Malinim+59","endoscopy");
  // check the connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  // get the username from the session
  $id = $_SESSION['id'];
  // create table for the user using id
  $sql = "CREATE TABLE IF NOT EXISTS `endoscopy`.`$id` ( `id` INT NOT NULL AUTO_INCREMENT , `videoName` VARCHAR(255) NOT NULL , `value` VARCHAR(50) NOT NULL , `timeProcess` INT(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
  // $sql = "CREATE TABLE IF NOT EXISTS `DATA`.`$id` ( `id` INT NOT NULL AUTO_INCREMENT , `videoName` VARCHAR(255) NOT NULL , `value` VARCHAR(50) NOT NULL , `timeProcess` INT(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
  // check the table is created or not
  if (!mysqli_query($conn, $sql)) {
    echo "Error creating table: " . mysqli_error($conn);
  }
  $_SESSION['currentID'] = 1;

  // check if table is empty or not
  $sql = "SELECT * FROM `$id`";
  $result = mysqli_query($conn, $sql);
  // if the table is empty then get the list of videos from the database
  if (mysqli_num_rows($result) == 0) {
    // get all videos from the folders
    $videos = getVideos();
    $ref_videos = $videos[0];
    $dist_videos = $videos[1];

    $_SESSION['ref_videos'] = $ref_videos;
    $_SESSION['dist_videos'] = $dist_videos;

    // send two variables to the session

    $src_next = $dist_videos[0];
    $ref_next = findRefVideo($src_next);

    $_SESSION['src_current'] = $src_next;
    $_SESSION['ref_current'] = $ref_next;

    // update the database with the list of dist videos
    $dist_videos = $_SESSION['dist_videos'];
    $table_id = $_SESSION['id'];
    foreach ($dist_videos as &$dist_video) {
      $src = $dist_video;
      $sql = "SELECT * FROM `$table_id` WHERE videoName = '$src'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO `$table_id` (videoName, value, timeProcess) VALUES ('$src', '0', '0')";
        mysqli_query($conn, $sql);
        // check query is successful
        if (mysqli_affected_rows($conn) <= 0) {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      }
    }
  }else{
    // get the last row of the table where the value is 0
    $sql = "SELECT * FROM `$id` WHERE value = '0' ORDER BY id ASC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    // last video id 
    $last_id = $row['id'];
    $_SESSION['currentID'] = $last_id;
    // echo $last_id;
    
    // get list of videos from the database
    $sql = "SELECT * FROM `$id`";
    $result = mysqli_query($conn, $sql);

    $videos = getVideos();
    $ref_videos = $videos[0];
    $dist_videos = array();


    while ($row = mysqli_fetch_assoc($result)) {
      $dist_videos[] = $row['videoName'];
    }
    

    $_SESSION['ref_videos'] = $ref_videos;
    $_SESSION['dist_videos'] = $dist_videos;

    $_SESSION['src_current'] = $dist_videos[$last_id-1];

    

    $_SESSION['ref_current'] = findRefVideo($dist_videos[$last_id-1]);

  }
  // $_SESSION['length'] is total number of videos
  $_SESSION['length'] = count($_SESSION['dist_videos']);

  
  // echo $_SESSION['src_current'];

  // // get all videos from the folders
  // $videos = getVideos();
  // $ref_videos = $videos[0];
  // $dist_videos = $videos[1];

  // $_SESSION['ref_videos'] = $ref_videos;
  // $_SESSION['dist_videos'] = $dist_videos;

  // // send two variables to the session

  // $src_next = $dist_videos[0];
  // $ref_next = findRefVideo($src_next);

  // $_SESSION['src_current'] = $src_next;
  // $_SESSION['ref_current'] = $ref_next;

  // // update the database with the list of dist videos
  // $dist_videos = $_SESSION['dist_videos'];
  // $table_id = $_SESSION['id'];
  // foreach ($dist_videos as &$dist_video) {
  //   $src = $dist_video;
  //   $sql = "SELECT * FROM `$table_id` WHERE videoName = '$src'";
  //   $result = mysqli_query($conn, $sql);
  //   if (mysqli_num_rows($result) == 0) {
  //     $sql = "INSERT INTO `$table_id` (videoName, value, timeProcess) VALUES ('$src', '0', '0')";
  //     mysqli_query($conn, $sql);
  //     // check query is successful
  //     if (mysqli_affected_rows($conn) <= 0) {
  //       echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  //     }
  //   }
  // }

  // close the connection
  mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="One Step to Making a Good Start, Events of Healthy Food, Exclusive&nbsp;restaurant in Paris, the ultimate way to get amazing food from the best chefs in the city.&nbsp;Great atmosphere included., Exclusive&nbsp;restaurant in Paris, the ultimate way to get amazing food from the best chefs in the city.&nbsp;Great atmosphere included., Delicious From The Chef, Get in touch">
  <meta name="description" content="">
  <title>Welcome</title>
  <link rel="icon" href="/~tansy.nguyen/images/logoLAGA.png" type="image/x-icon">
  <link rel="stylesheet" href="nicepage.css" media="screen">
  <link rel="stylesheet" href="mainpage.css" media="screen">
  <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
  <!-- <script class="u-script" type="text/javascript" src="custom.js" defer=""></script> -->
  <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
  <script class="u-script" type="text/javascript" src="mainpage.js" defer=""></script>
  <meta name="generator" content="Nicepage 4.19.3, nicepage.com">

  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">

  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "WebSite2986854"
    }
  </script>
  <meta name="theme-color" content="#478ac9">
  <meta property="og:title" content="mainpage">
  <meta property="og:type" content="website">
</head>

<body class="u-body u-overlap u-overlap-contrast u-xl-mode" data-lang="en">
  <header class="u-clearfix u-header u-header" id="sec-4d5f" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">
    <div class="u-clearfix u-sheet u-sheet-1">
      <nav class="u-menu u-menu-hamburger u-offcanvas u-menu-1" data-responsive-from="XL">
        <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px;">
          <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
            <svg class="u-svg-link" viewBox="0 0 24 24">
              <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use>
            </svg>
            <svg class="u-svg-content" version="1.1" id="menu-hamburger" viewBox="0 0 16 16" x="0px" y="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
              <g>
                <rect y="1" width="16" height="2"></rect>
                <rect y="7" width="16" height="2"></rect>
                <rect y="13" width="16" height="2"></rect>
              </g>
            </svg>
          </a>
        </div>
        <div class="u-custom-menu u-nav-container">
          <ul class="u-nav u-unstyled u-nav-1">
            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="mainpage.html#sec-107e" style="padding: 10px 20px;">Home</a>
            </li>
            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="mainpage.html#sec-a668" style="padding: 10px 20px;">About</a>
            </li>
            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="mainpage.html#sec-27f5" style="padding: 10px 20px;">Process Test</a>
            </li>
            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="mainpage.html#sec-8043" style="padding: 10px 20px;">Contact</a>
            </li>
          </ul>
        </div>
        <!-- php code if the button log-->
        <div class="u-custom-menu u-nav-container-collapse">
          <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
            <div class="u-inner-container-layout u-sidenav-overflow">
              <div class="u-menu-close"></div>
              <ul class="u-align-center u-menu-hamburger u-nav u-popupmenu-items u-unstyled u-nav-2">
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="mainpage.html#sec-107e">Home</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="mainpage.html#sec-a668">About</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="./src/visual/colorVisual.php">Start Experiment</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="mainpage.html#sec-8043">Contact</a>
                </li>
                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="logout.php">Logout</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
        </div>
      </nav>
    </div>
  </header>
  <section class="skrollable u-align-center u-clearfix u-image u-parallax u-shading u-section-1" id="sec-107e" data-image-width="1102" data-image-height="618">

    <div class="u-clearfix u-sheet u-sheet-1">
      <img src="images/laga-l2ti.png" alt="" class="u-align-center u-image u-image-contain u-image-default u-image-1" data-image-width="217" data-image-height="193">
      <h1 class="u-custom-font u-font-playfair-display u-text u-text-1">Wireless Capsule Endoscopy</h1>
      <p class="u-align-center u-text u-text-2"> Thank you for taking the time to complete this experiment. We truly value the information you will provide. Your responses will contribute to the development and advancement of new quality assessment techniques for wireless capsule endoscopy images.</p>
      <a href="./src/visual/colorVisual.php" class="u-align-center u-btn u-btn-round u-button-style u-hover-feature u-hover-palette-1-light-2 u-palette-1-light-3 u-radius-50 u-btn-1" data-animation-name="customAnimationIn" data-animation-duration="1000"><span class="u-icon"><svg class="u-svg-content" viewBox="0 0 30.727 30.727" x="0px" y="0px" style="width: 1em; height: 1em;">
            <path d="M29.994,10.183L15.363,24.812L0.733,10.184c-0.977-0.978-0.977-2.561,0-3.536c0.977-0.977,2.559-0.976,3.536,0   l11.095,11.093L26.461,6.647c0.977-0.976,2.559-0.976,3.535,0C30.971,7.624,30.971,9.206,29.994,10.183z"></path>
          </svg><img></span>&nbsp; Start Experiment
      </a>
    </div>
  </section>

  <!-- <section class="skrollable u-align-center u-clearfix u-image u-parallax u-section-4" id="sec-27f5" data-image-width="1424" data-image-height="1000">
    <div class="u-clearfix u-sheet u-sheet-1">
      <h6 class="u-text u-text-default u-text-1">events</h6>
      <h2 class="u-custom-font u-font-playfair-display u-text u-text-default u-text-2">Experiment Instruction</h2>
      <div class="u-expanded-width u-list u-list-1">
        <div class="u-repeater u-repeater-1">
          <div class="u-align-center u-container-style u-list-item u-repeater-item">
            <div class="u-container-layout u-similar-container u-container-layout-1"><span class="u-file-icon u-icon u-icon-1"><img src="images/482059.png" alt=""></span>
              <p class="u-text u-text-default u-text-3">PLAY</p>
              <p class="u-text u-text-4">"Play" button. Click to <span style="font-weight: 700;">play</span> videos<br>Each video has a <span style="font-weight: 700;">duration of 10 seconds</span>. After observing and evaluating each video, you will choose <span style="font-weight: 700;">one of the four</span> quality levels listed below based on your comfort with each video.
              </p>
            </div>
          </div>
          <div class="u-align-center u-container-style u-list-item u-repeater-item">
            <div class="u-container-layout u-similar-container u-container-layout-2"><span class="u-file-icon u-icon u-icon-2"><img src="images/7838119.png" alt=""></span>
              <h6 class="u-text u-text-default u-text-5">STOP</h6>
              <p class="u-text u-text-6"> "Stop" button. Click to <span style="font-weight: 700;">stop</span> videos<br>The button will be used when you feel the need to stop the video and take a closer look at the image.<br>
              </p>
            </div>
          </div>
          <div class="u-align-center u-container-style u-list-item u-repeater-item">
            <div class="u-container-layout u-similar-container u-container-layout-3"><span class="u-file-icon u-icon u-icon-3"><img src="images/1549454.png" alt=""></span>
              <h6 class="u-text u-text-default u-text-7">NEXT</h6>
              <p class="u-text u-text-8"> "Next" button. Click to <span style="font-weight: 700;">display the next&nbsp;videos</span>
                <br>The button will be used When you want to skip to the next video. The quality rating value of the current video will be stored automatically.<br>
              </p>
            </div>
          </div>
        </div>
        <!-- create button to load experiment page -->
      </div>
    </div>
  </section> 
  <!-- php get the session username and load data from database-->
  <?php
  // session_start();
  $username = $_SESSION['username'];
  // connect to server and select database
  // $db = mysqli_connect("remotemysql.com", "g3uw65oJMS", "x6sPplebaq", "g3uw65oJMS");
  // $db = mysqli_connect("wcetest-do-user-13153530-0.b.db.ondigitalocean.com","doadmin","AVNS_8WsUdQ7GU9RwUI5S9gd","DATA", 25060);
              
  $db = mysqli_connect("localhost","capsule","Malinim+59","endoscopy");
  $sql = "SELECT * FROM userNote WHERE email = '$username'";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
  // get the name, majority, total time and total video from database
  $name = $row['firstName'];
  $majority = $row['majority'];
  // if the majority is expert, the text will be "expert"
  switch ($majority) {
    case 'gas-expert':
      $majority = "Gastroenterology Expert";
      break;
    case 'qua-expert':
      $majority = "Quality Assessment Expert";
      break;
    case 'img-expert':
      $majority = "Image Processing Expert";
      break;
    default:
      $majority = "Non-Experts";
      break;
  }

  $total_time = $row['totalTime'];
  $total_video = $row['totalVideo'];
  $_SESSION['total_time'] = $total_time;
  $_SESSION['total_video'] = $total_video;
  // get number of user having majority == expert 
  $sql = "SELECT COUNT(*) AS totalExpert FROM userNote WHERE majority LIKE '%-expert'";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
  $totalExpert = $row['totalExpert'];
  // get number of user having majority == novice
  $sql = "SELECT COUNT(*) AS totalNovice FROM userNote WHERE majority = 'nonexpert'";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
  $totalNovice = $row['totalNovice'];

  // get sum of total time
  $sql = "SELECT SUM(totalTime) AS totalTime FROM userNote";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
  $sum_total_time = $row['totalTime'];
  ?>
  <section class="u-align-center u-clearfix u-section-8" id="sec-45bf">
    <div class="u-clearfix u-sheet u-sheet-1">
      <h6 class="u-text u-text-default u-text-1">YOUR note</h6>
      <h2 class="u-custom-font u-font-playfair-display u-text u-text-default u-text-2">Current User Note</h2>
      <div class="u-expanded-width u-list u-list-1">
        <div class="u-repeater u-repeater-1">
          <div class="u-align-center u-container-style u-list-item u-repeater-item">
            <div class="u-container-layout u-similar-container u-valign-top u-container-layout-1">
              <h6 class="u-align-center u-text u-text-default u-text-3">name</h6>
              <p class="u-align-center u-text u-text-default u-text-2"><?php echo $name; ?></p>
            </div>
          </div>
          <div class="u-align-center u-container-style u-list-item u-repeater-item">
            <div class="u-container-layout u-similar-container u-valign-top u-container-layout-2">
              <h6 class="u-align-center u-text u-text-default u-text-3">Level and type of expertise</h6>
              <p class="u-align-center u-text u-text-default u-text-2"><?php echo $majority; ?></p>
            </div>
          </div>
          <div class="u-container-style u-list-item u-repeater-item">
            <div class="u-container-layout u-similar-container u-valign-top u-container-layout-3">
              <h6 class="u-align-center u-text u-text-default u-text-7">total time</h6>
              <p class="u-align-center u-text u-text-default u-text-2"><?php echo $total_time; ?> (s)</p>
            </div>
          </div>
          <div class="u-container-style u-list-item u-repeater-item">
            <div class="u-container-layout u-similar-container u-valign-top u-container-layout-4">
              <h6 class="u-align-center u-text u-text-default u-text-9">number of processed videos</h6>
              <p class="u-align-center u-text u-text-default u-text-2"><?php echo $total_video; ?> / <?php echo $_SESSION['length']?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="u-border-2 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>

  </section>
  <section class="u-clearfix u-lightbox u-section-9" id="sec-96ba">
    <div class="u-clearfix u-sheet u-sheet-1">
      <div class="u-list u-list-1">
        <div class="u-repeater u-repeater-1">
          <div class="u-align-center-lg u-align-center-md u-align-center-sm u-align-center-xl u-container-style u-list-item u-repeater-item">
            <div class="u-container-layout u-similar-container u-container-layout-1"><span class="u-file-icon u-icon u-icon-1"><img src="images/223404.png" alt=""></span>
              <h3 class="u-align-center-xs u-custom-font u-font-playfair-display u-text u-text-default u-text-1" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="4250" data-animation-delay="0"><?php echo $sum_total_time; ?> (s)</h3>
              <h6 class="u-align-center-xs u-text u-text-default u-text-2">TOTAL TIME</h6>
            </div>
          </div>
          <div class="u-align-center-lg u-align-center-md u-align-center-sm u-align-center-xs u-container-style u-list-item u-repeater-item">
            <div class="u-container-layout u-similar-container u-container-layout-2"><span class="u-file-icon u-icon u-icon-2"><img src="images/476698.png" alt=""></span>
              <h3 class="u-align-center u-custom-font u-font-playfair-display u-text u-text-default u-text-3" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="4250" data-animation-delay="0"><?php echo $totalNovice; ?></h3>
              <h6 class="u-align-center u-text u-text-default u-text-4">NON-EXPERT</h6>
            </div>
          </div>
          <div class="u-align-center u-container-style u-list-item u-repeater-item">
            <div class="u-container-layout u-similar-container u-container-layout-3"><span class="u-file-icon u-icon u-icon-3"><img src="images/1021799.png" alt=""></span>
              <h3 class="u-custom-font u-font-playfair-display u-text u-text-default u-text-5" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="4250" data-animation-delay="0"><?php echo $totalExpert; ?></h3>
              <h6 class="u-text u-text-default u-text-6">EXPERT</h6>
            </div>
          </div>
        </div>
      </div>
      <div class="u-black u-container-style u-group u-shape-circle u-group-1">
        <div class="u-container-layout u-valign-middle u-container-layout-4">
          <h6 class="u-align-center u-text u-text-default u-text-7">Experiment statistical note</h6>
        </div>
      </div>
    </div>
    <div class="u-border-2 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
  </section>
  <section class="u-align-center u-clearfix u-section-2" id="sec-a668">
    <div class="u-clearfix u-sheet u-sheet-1">
      <h6 class="u-align-center u-text u-text-default u-text-1">about our TEAM</h6>
      <h3 class="u-align-center u-custom-font u-font-playfair-display u-text u-text-default u-text-3"> The <span style="font-weight: 700;">Mathematics-Biology</span> team is transversal to the seven teams of the <span style="font-weight: 700;">LAGA</span> laboratory​. The team's research activities cover a <span style="font-weight: 700;">broad spectrum of mathematics and their applications</span> to life sciences.
      </h3>
      <h3 class="u-align-center u-custom-font u-font-playfair-display u-text u-text-default u-text-3">The <span style="font-weight: 700;">Traitement de données multimédia (TDM)</span> team of <span style="font-weight: 700;">L2TI</span> laboratory is interested in various treatments, namely <span style="font-weight: 700;"> pre/post processing, coding and visual data transmission</span>. It comes from the representation and processing of multimedia contents. We have reorganized the themes not only to review the evolution of our activities but also to respond to the technological context.
      </h3>
    </div>
  </section>
  <section class="skrollable u-clearfix u-section-3" id="sec-c149">
    <div class="u-layout-horizontal u-list u-list-1">
      <div class="u-repeater u-repeater-1">
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle u-list-item-1" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-direction="X">
          <div class="u-container-layout u-similar-container u-container-layout-1">
            <img class="u-align-center u-image u-image-1" src="images/sy.png" data-image-width="1920" data-image-height="845">
            <h5 class="u-text u-text-default u-text-1">&nbsp;Tan Sy NGUYEN</h5>
            <p class="u-text u-text-default u-text-2"><span class="u-file-icon u-icon u-icon-1"><img src="images/948256.png" alt=""></span>&nbsp;PhD Student (LAGA/L2TI)
            </p>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle u-list-item-2" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-direction="X">
          <div class="u-container-layout u-similar-container u-container-layout-2">
            <img class="u-align-center u-image u-image-2" src="images/hatem.png" data-image-width="640" data-image-height="638">
            <h5 class="u-text u-text-default u-text-3">Hatem ZAAG</h5>
            <p class="u-text u-text-default u-text-4"><span class="u-file-icon u-icon u-icon-2"><img src="images/182332.png" alt=""></span>&nbsp;Full Professor (LAGA)
            </p>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle u-list-item-3" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-direction="X">
          <div class="u-container-layout u-similar-container u-container-layout-3">
            <img class="u-align-center u-image u-image-3" src="images/John-Chaussard.jpg" data-image-width="512" data-image-height="512">
            <h5 class="u-text u-text-default u-text-5">John CHAUSSARD</h5>
            <p class="u-text u-text-default u-text-6"><span class="u-file-icon u-icon u-icon-3"><img src="images/182332.png" alt=""></span>&nbsp;Associate Professor (LAGA)
            </p>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle u-list-item-4" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-direction="X">
          <div class="u-container-layout u-similar-container u-container-layout-4">
            <img class="u-align-center u-image u-image-4" src="images/Picture_Marie.jpg" data-image-width="191" data-image-height="237">
            <h5 class="u-text u-text-default u-text-7">Marie LUONG</h5>
            <p class="u-text u-text-default u-text-8"><span class="u-file-icon u-icon u-icon-4"><img src="images/182332.png" alt=""></span>&nbsp;Associate Professor (L2TI)
            </p>
          </div>
        </div>
        <div class="u-container-style u-custom-item u-list-item u-repeater-item u-shape-rectangle u-list-item-5" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-direction="X">
          <div class="u-container-layout u-similar-container u-container-layout-5">
            <img class="u-align-center u-image u-image-5" src="images/Azeddine-Beghdadi.jpg" data-image-width="512" data-image-height="512">
            <h5 class="u-text u-text-default u-text-9">Azeddine BEGHDADI</h5>
            <p class="u-text u-text-default u-text-10"><span class="u-file-icon u-icon u-icon-5"><img src="images/182332.png" alt=""></span>&nbsp;Full Professor (L2TI)
            </p>
          </div>
        </div>
      </div>
      <a class="u-absolute-vcenter u-black u-gallery-nav u-gallery-nav-prev u-icon-rounded u-opacity u-opacity-70 u-spacing-10 u-gallery-nav-1" href="#" role="button">
        <span aria-hidden="true">
          <svg viewBox="0 0 451.847 451.847">
            <path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path>
          </svg>
        </span>
        <span class="sr-only">
          <svg viewBox="0 0 451.847 451.847">
            <path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0
c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744
c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path>
          </svg>
        </span>
      </a>
      <a class="u-absolute-vcenter u-black u-gallery-nav u-gallery-nav-next u-icon-rounded u-opacity u-opacity-70 u-spacing-10 u-text-white u-gallery-nav-2" href="#" role="button">
        <span aria-hidden="true">
          <svg viewBox="0 0 451.846 451.847">
            <path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path>
          </svg>
        </span>
        <span class="sr-only">
          <svg viewBox="0 0 451.846 451.847">
            <path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path>
          </svg>
        </span>
      </a>
    </div>
    <div class="u-border-2 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>
  </section>
  <section class="u-align-center u-clearfix u-section-10" id="sec-8043">
    <div class="u-clearfix u-sheet u-sheet-1">
      <h6 class="u-text u-text-default u-text-1">contact us</h6>
      <h2 class="u-custom-font u-font-playfair-display u-text u-text-default u-text-2">Get in touch</h2>
      <div class="u-form u-form-1">
        <form action="https://forms.nicepagesrv.com/Form/Process" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" style="padding: 10px;" source="email" name="form">
          <div class="u-form-group u-form-name">
            <label for="name-9267" class="u-label">Your name</label>
            <input type="text" placeholder="E.g. John " id="name-9267" name="name" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
          </div>
          <div class="u-form-email u-form-group">
            <label for="email-9267" class="u-label">Email address</label>
            <input type="email" placeholder="Enter a valid email address" id="email-9267" name="email" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
          </div>
          <div class="u-form-group u-form-message u-form-group-3">
            <label for="message-72f6" class="u-label">Message</label>
            <textarea placeholder="Enter your message" rows="4" cols="50" id="message-72f6" name="message" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required=""></textarea>
          </div>
          <div class="u-form-agree u-form-group u-form-group-4">
            <input type="checkbox" id="agree-529e" name="agree" class="u-agree-checkbox" required="">
            <label for="agree-529e" class="u-agree-label u-label">I accept the <a href="https://www.termsfeed.com/live/9e6c8eb3-7dd7-4ffd-b75f-63925a4e358b">Terms of Service</a>
            </label>
          </div>
          <div class="u-align-center u-form-group u-form-submit">
            <a href="#" class="u-border-2 u-border-black u-btn u-btn-submit u-button-style u-hover-black u-none u-text-black u-text-hover-white u-btn-1">Submit</a>
            <input type="submit" value="submit" class="u-form-control-hidden">
          </div>
          <div class="u-form-send-message u-form-send-success"> Thank you! Your message has been sent. </div>
          <div class="u-form-send-error u-form-send-message"> Unable to send your message. Please fix errors then try again. </div>
          <input type="hidden" value="" name="recaptchaResponse">
          <input type="hidden" name="formServices" value="4a303647e57beb14f104b3d50d8a6b03">
        </form>
      </div>
    </div>
  </section>


  <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-2ee3">
    <div class="u-clearfix u-sheet u-sheet-1">
      <p class="u-small-text u-text u-text-variant u-text-1">© 2022 Université Sorbonne Paris Nord, LAGA-L2TI laboratoire, All Rights Reserved.</p>
    </div>
  </footer>
</body>

</html>