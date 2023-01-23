<?php
session_start();
include 'getImage.php';
list($ref_images, $ref_folders) = getIshiharaImages();

// session the current imageRef is the first image in the ref_images
$_SESSION['imageIshihara'] = $ref_images[0];
$_SESSION['imageIshiharalist'] = $ref_images;
$_SESSION['imageIshiharaNumExp'] = 1;

// create a array to store the result
$_SESSION['resultNum'] = array();
$_SESSION['resultNumCorrect'] = $ref_folders;
// convert the array to number
$_SESSION['resultNumCorrect'] = array_map('intval', $_SESSION['resultNumCorrect']);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Ishihara CVD Test</title>
    <meta property="og:title" content="Well Groomed Lone Bear" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />
    <script class="u-script" type="text/javascript" src="IshiharaTest.js" defer=""></script>

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
    <!--This is the head section-->
    <!-- <style> ... </style> -->
    <link rel="stylesheet" href="./style.css" />
  </head>
  <body>
    <div>
      <link href="./home.css" rel="stylesheet" />

      <div class="home-container">
        <div class="home-container1">
          <img
          id = "imageRef"
            alt="image"
            src=<?php echo $_SESSION['imageIshihara']; ?>
            class="home-image"
          />
          <div class="home-container2">
            <input
              type="number"
              required=""
              autofocus=""
              placeholder="Enter the number"
              class="home-textinput input"
            />
            <button id="nextImageButton" class="home-button button">
              <span class="home-text">
                <span>Next</span>
                <br />
              </span>
            </button>
            <span id="numExp" class="home-text3">Plate <?php echo $_SESSION['imageIshiharaNumExp']; ?>/38</span>
          </div>
        </div>
        <h1 class="home-text4">Ishihara 38 Plates CVD Test</h1>
      </div>
    </div>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  </body>
</html>
