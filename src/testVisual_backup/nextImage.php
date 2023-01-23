<?php
session_start();
include 'getImage.php';

// check the incoming action

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'next':
            nextImageLoad($_SESSION['imageRef']);
            // session current imageRef
            
            break;
    }
}

// function to find the next image
function nextImageLoad($imageRef) {
    // set flag is continue to find the next image
    $flag = false;
    // get the list of images
    list($ref_images, $dist_images) = getImages();

    // // show the imageRef
    // echo $imageRef;
    
    // find the index of the current image
    $index = array_search($imageRef, $ref_images);

    // if the current image is the last image, update flag to true and set the index to 0
    if ($index == count($ref_images) - 1) {
        $flag = true;
        $index = 0;
    }
    // get the next image
    $next_image = $ref_images[$index + 1];
    $_SESSION['imageRef'] = $next_image;
    $_SESSION['imageNumExp'] += 1;
    // get the image with the same name as the next image + 4 levels
    $imageLevel1 = findImage($next_image, $dist_images, 1);
    $imageLevel2 = findImage($next_image, $dist_images, 2);
    $imageLevel3 = findImage($next_image, $dist_images, 3);
    $imageLevel4 = findImage($next_image, $dist_images, 4);

    // return the next image and the 4 levels
    echo json_encode(array( 'num' => $_SESSION['imageNumExp'] ,'imageRef' => $next_image, 'imageLevel1' => $imageLevel1, 'imageLevel2' => $imageLevel2, 'imageLevel3' => $imageLevel3, 'imageLevel4' => $imageLevel4, 'flag' => $flag));
    
}


?>
            