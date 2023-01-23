<?php
session_start();
include 'getImage.php';

// check the incoming action

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'next':
            nextImageLoad($_SESSION['imageIshihara']);
            break;
    }
}

// function to find the next image
function nextImageLoad($imageRef) {
    // set flag is continue to find the next image
    $flag = false;
    // find the index of the current image
    $index = array_search($imageRef,$_SESSION['imageIshiharalist']);

    // if the current image is the last image, update flag to true and set the index to 0
    if ($index == count($_SESSION['imageIshiharalist']) - 1) {
        $flag = true;
        $index = 0;
    }
    // get the next image
    $next_image = $_SESSION['imageIshiharalist'][$index + 1];
    $_SESSION['imageIshihara'] = $next_image;
    $_SESSION['imageIshiharaNumExp'] += 1;

    // return the next image and the 4 levels
    echo json_encode(array( 'num' => $_SESSION['imageIshiharaNumExp'] ,'imageRef' => $next_image, 'flag' => $flag));
    
}


?>
            