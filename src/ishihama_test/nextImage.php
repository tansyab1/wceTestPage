<?php
session_start();
include 'getImage.php';
$numCorrect = 0;

// check the incoming action

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'next':
            nextImageLoad($_SESSION['imageIshihara']);
            // add num to $_SESSION['resultNum']
            array_push($_SESSION['resultNum'], $_POST['num']);
            break;
    }
}

// function to find the next image
function nextImageLoad($imageRef) {
    // set flag is continue to find the next image
    $flag = false;
    // find the index of the current image
    $index = array_search($imageRef,$_SESSION['imageIshiharalist']);
    // $index = 0;
    $numCorrect = 0;
    // if the current image is the last image, update flag to true and set the index to 0
    if ($index == count($_SESSION['imageIshiharalist']) - 1) {
        $flag = true;
        $index = 0;

        // echo "resultNumCorrect:";
        // print_r($_SESSION['resultNumCorrect']);
        // echo "resultNum:";
        // print_r($_SESSION['resultNum']);
        // compart the resultNum with the result index by index and count the number of correct answers
        
        for ($i = 0; $i < count($_SESSION['resultNumCorrect']); $i++) {
            if ($_SESSION['resultNumCorrect'][$i] == $_SESSION['resultNum'][$i]) {
                $numCorrect += 1;
            }
        }

    }
    // get the next image
    $next_image = $_SESSION['imageIshiharalist'][$index + 1];
    $_SESSION['imageIshihara'] = $next_image;
    $_SESSION['imageIshiharaNumExp'] += 1;

    // return the next image and the 4 levels
    echo json_encode(array( 'num' => $_SESSION['imageIshiharaNumExp'] ,'imageRef' => $next_image, 'flag' => $flag, 'numCorrect' => $numCorrect));
    
}


?>
            