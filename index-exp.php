<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>WCE main Test</title>
  <meta property="og:title" content="VideoPlayer" />
  <link rel="icon" href="/images/logoLAGA.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <meta property="twitter:card" content="summary_large_image" />
  <script class="u-script" type="text/javascript" src="index-exp.js" defer=""></script>
  <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>

  <style data-tag="reset-style-sheet">
    html {
      line-height: 1.15;
    }

    body {
      margin: 0;
    }

    * {
      box-sizing: border-box;
      border-width: 0;
      border-style: solid;
    }

    p,
    li,
    ul,
    pre,
    div,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    figure,
    blockquote,
    figcaption {
      margin: 0;
      padding: 0;
    }

    button {
      background-color: transparent;
    }

    button,
    input,
    optgroup,
    select,
    textarea {
      font-family: inherit;
      font-size: 100%;
      line-height: 1.15;
      margin: 0;
    }

    button,
    select {
      text-transform: none;
    }

    button,
    [type="button"],
    [type="reset"],
    [type="submit"] {
      -webkit-appearance: button;
    }

    button::-moz-focus-inner,
    [type="button"]::-moz-focus-inner,
    [type="reset"]::-moz-focus-inner,
    [type="submit"]::-moz-focus-inner {
      border-style: none;
      padding: 0;
    }

    button:-moz-focus,
    [type="button"]:-moz-focus,
    [type="reset"]:-moz-focus,
    [type="submit"]:-moz-focus {
      outline: 1px dotted ButtonText;
    }

    a {
      color: inherit;
      text-decoration: inherit;
    }

    input {
      padding: 2px 4px;
    }

    img {
      display: block;
    }

    html {
      scroll-behavior: smooth
    }
  </style>
  <style data-tag="default-style-sheet">
    html {
      font-family: Inter;
      font-size: 16px;
    }

    body {
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      text-transform: none;
      letter-spacing: normal;
      line-height: 1.15;
      color: var(--dl-color-gray-black);
      background-color: var(--dl-color-gray-white);

    }
  </style>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" data-tag="font" />
  <link rel="stylesheet" href="./style-exp.css" />
</head>

<body>
  <div>
    <script type="text/javascript" src="https://unpkg.com/dangerous-html@0.1.11/dist/default/lib.umd.js"></script>
    <link href="./home-exp.css" rel="stylesheet" />

    <div class="home-container">
      <div class="home-container1">
        <video preload="auto" src="<?php echo $_SESSION['src_current']; ?>" class="home-video" id="distVideo"></video>
        <video preload="auto" src="<?php echo $_SESSION['ref_current']; ?>" class="home-video1" id="refVideo"></video>
      </div>
      <div class="home-container2">
        <span id="spancurrent" class="home-page"><?php echo $_SESSION['currentID']; ?>/<?php echo $_SESSION['length']; ?></span>
        <button onclick="startVideos()" class="home-play button">Play</button>
        <button onclick="stopVideos()" class="home-stop button">Stop</button>
        <div class="home-container3">
          <div class="home-container4">
            <div class="home-radiobutton">
              <dangerous-html html="<style type='text/css'>
    /* DEFAULTS */
    /* =============================================== */
    /* MAIN */
    /* =============================================== */
    .rad-label {
        display: flex;
        align-items: center;
        border-radius: 100px;
        padding: 8px 8px;
        margin: 10px 0;
        cursor: pointer;
        transition: .3s;
    }
    .rad-input:checked+.rad-design::before {
    transform: scale(0);
    }

    .rad-label:hover,
    .rad-label:focus-within {
        background: hsla(0, 0%, 80%, .14);
    }

    .rad-input {
        position: absolute;
        left: 0;
        top: 0;
        width: 1px;
        height: 1px;
        opacity: 0;
        z-index: -1;
    }

    .rad-design {
        width: 22px;
        height: 22px;
        border-radius: 100px;
        background: linear-gradient(to right bottom, hsl(0, 0%, 66%), hsl(0, 0%, 66%));
        position: relative;
    }

    .rad-design::before {
        content: '';
        display: inline-block;
        width: inherit;
        height: inherit;
        border-radius: inherit;
        background: hsl(0, 0%, 50%);
        transform: scale(1.1);
        transition: .3s;
    }

    

    .rad-text {
        color: hsl(0, 0%, 66%);
        margin-left: 14px;
        letter-spacing: 3px;
        text-transform: uppercase;
        font-size: 16px;
        font-weight: 900;
        transition: .3s;
    }

    .rad-input:checked~.rad-text {
        color: hsl(0, 0%, 66%);
    }


</style><!-- partial:index.partial.html -->
<div>
    <label class='rad-label'>
            <input type='radio' class='rad-input' name='rad' value='4' checked>
            <div class='rad-design'></div>
            <div class='rad-text'>Very Annoying</div>
          </label>
    <label class='rad-label'>
            <input type='radio' class='rad-input' name='rad' value='3'>
            <div class='rad-design'></div>
            <div class='rad-text'>Annoying</div>
          </label>
    <label class='rad-label'>
            <input type='radio' class='rad-input' name='rad' value='2'>
            <div class='rad-design'></div>
            <div class='rad-text'>Just Noticeable</div>
          </label>
    <label class='rad-label'>
            <input type='radio' class='rad-input' name='rad' value='1'>
            <div class='rad-design'></div>
            <div class='rad-text'>Hardly Visible</div>
          </label>
</div>"></dangerous-html>
            </div>
            <span class="home-instruction">
              <span>Please rate the video quality</span>
              <br />
              <span>
                (based on your perception of the video impact on your experience)
              </span>
            </span>
          </div>
        </div>
        <div class="home-container5">
          <button onclick="nextVideo()" class="home-next button">Next</button>
        </div>
      </div>
      <div class="home-container6">
        <span class="home-text3">Distorted Video</span>
        <span class="home-text4">Reference Video</span>
      </div>
    </div>
  </div>
  <div id="notif" class="popup">
    <button id="close">&times;</button>


    <h2> Notification </h2>
    <p>
      You have completed the visual test. Please click the button below once you are ready to proceed to the main test. Please note that the main test will take approximately 30 minutes to complete.
    </p>
    <a onclick="closePopup()">I'm ready</a>
  </div>

  <div id="alert" class="popup">
    <button id="closealert">&times;</button>


    <h2> Alert </h2>
    <p>
    Please "Play" the video and rate the video quality before proceeding to the "Next" video.
    </p>
    <a onclick="closeAlert()">Close</a>
  </div>

</body>

</html>