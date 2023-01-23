<?php
session_start();
include 'getImage.php';

// load the ref_images and dist_images
list($ref_images, $dist_images) = getImages();

// session the current imageRef is the first image in the ref_images
$_SESSION['imageRef'] = $ref_images[0];

// find the image with the same name as the first image in the ref_images + 4 levels
$_SESSION['imagelevel1'] = findImage($_SESSION['imageRef'], $dist_images, 1);
$_SESSION['imagelevel2'] = findImage($_SESSION['imageRef'], $dist_images, 2);
$_SESSION['imagelevel3'] = findImage($_SESSION['imageRef'], $dist_images, 3);
$_SESSION['imagelevel4'] = findImage($_SESSION['imageRef'], $dist_images, 4);
$_SESSION['imageNumExp'] = 1;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Colour Test</title>
    <meta property="og:title" content="Test Visual" />
    <link rel="icon" href="/~tansy.nguyen/images/logoLAGA.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />
    <script class="u-script" type="text/javascript" src="visualTest.js" defer=""></script>

    <!-- add script -->
    <script class="u-script" type="text/javascript" src="/~tansy.nguyen/jquery.js" defer=""></script>
    <!-- <script class="u-script" type="text/javascript" src="jquery-ui.js" defer=""></script> -->


    <style data-tag="reset-style-sheet">
      html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6,figure,blockquote,figcaption {  margin: 0;  padding: 0;}button {  background-color: transparent;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] {  -webkit-appearance: button;}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;}a {  color: inherit;  text-decoration: inherit;}input {  padding: 2px 4px;}img {  display: block;}html { scroll-behavior: smooth  }
    </style>
    <style data-tag="default-style-sheet">
      html {
        font-family: Inter;
        font-size: 16px;
      }

      body {
        font-weight: 400;
        font-style:normal;
        text-decoration: none;
        text-transform: none;
        letter-spacing: normal;
        line-height: 1.15;
        color: var(--dl-color-gray-black);
        background-color: var(--dl-color-gray-white);

      }
    </style>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      data-tag="font"
    />
    <link rel="stylesheet" href="./style.css" />
  </head>
  <body>
    <div>
      <link href="./home.css" rel="stylesheet" />

      <div class="home-container">
        <div class="home-container1">
          <img
            alt="image"
            id = "imageRef"
            src= <?php echo $_SESSION['imageRef']; ?>
            class="home-image"
          />
          <img
            alt="image"
            id = "imageLevel1"
            src= <?php echo $_SESSION['imagelevel1']; ?>
            class="home-image1"
          />
          <img
            alt="image"
            id = "imageLevel2"
            src= <?php echo $_SESSION['imagelevel2']; ?>
            class="home-image2"
          />
          <img
            alt="image"
            id = "imageLevel3"
            src= <?php echo $_SESSION['imagelevel3']; ?>
            class="home-image3"
          />
          <img
            alt="image"
            id = "imageLevel4"
            src= <?php echo $_SESSION['imagelevel4']; ?>
            class="home-image4"
          />
        </div>
        <div class="home-container2">
          <div class="home-container3">
            <span class="home-instruction">
              Please note the difference between images
            </span>
          </div>
          <div class="home-container4">
            <button id="nextImageButton" class="home-next button">Next</button>
          </div>
          <span id="numExp" class="home-page"> <?php echo $_SESSION['imageNumExp']; ?>/4 </span>
        </div>
      </div>
    </div>
  </body>
</html>
