<?php
session_start();
include 'getImage.php';

// check the incoming action

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'next':
            nextImageLoad($_SESSION['imageLevel4']);
            // session current imageRef
            
            break;
    }
}

// function to find the next image
function nextImageLoad($imageRef) {
    // set flag is continue to find the next image
    $flag = false;
    
    // find the index of the current image
    $index = array_search($imageRef, $_SESSION['imagelist']);

    // if the current image is the last image, update flag to true and set the index to 0
    if ($index == count($_SESSION['imagelist']) - 1) {
        $flag = true;
        $index = 0;
    }
    // $_SESSION['imageRef'] = $next_image;
    $_SESSION['imageNumExp'] += 1;
    // get the image with the same name as the next image + 4 levels
    $imageLevel1 = $_SESSION['imagelist'][$index + 1];
    $imageLevel2 = $_SESSION['imagelist'][$index + 2];
    $imageLevel3 = $_SESSION['imagelist'][$index + 3];
    $imageLevel4 = $_SESSION['imagelist'][$index + 4];

    // update the session variables
    $_SESSION['imagelevel1'] = $imageLevel1;
    $_SESSION['imagelevel2'] = $imageLevel2;
    $_SESSION['imagelevel3'] = $imageLevel3;
    $_SESSION['imagelevel4'] = $imageLevel4;

    list($patho, $kind) = getDistortion($_SESSION['imagelevel1']);

    $_SESSION['patho'] = $patho;
    $_SESSION['kind'] = $kind;

    

    // return the next image and the 4 levels
    echo json_encode(array( 'num' => $_SESSION['imageNumExp'], 'patho' => $patho, 'kind' => $kind , 'imageLevel1' => $imageLevel1, 'imageLevel2' => $imageLevel2, 'imageLevel3' => $imageLevel3, 'imageLevel4' => $imageLevel4, 'flag' => $flag));
    
}
