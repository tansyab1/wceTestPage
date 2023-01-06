<?php
session_start();
include 'getVideo.php';
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'next':
            // get the radValue from the form
            $radValue = $_POST['radValue'];
            $src_current = $_SESSION['src_current'];
            $duration = $_POST['duration'];
            $notification = 'pass';
            $_SESSION['currentID'] = $_SESSION['currentID'] + 1;
            addWatchedVideo($src_current, $radValue, $duration);
            nextVideo($notification);
            break;
    }
}

// function to add the current video to the list of watched videos with corresponding value and duration
function addWatchedVideo($src_current, $radValue, $duration) {
    // create a diction with the video path, the value and the duration
    $watched_video = array('src' => $src_current, 'value' => $radValue, 'duration' => $duration);
    // add the video to the list of watched videos
    $_SESSION['watched_videos'][] = $watched_video;

    // if the list of watched videos is longer than 10, update the database and empty the list of watched videos
    if (count($_SESSION['watched_videos']) == 10 && count($_SESSION['watched_videos']) > 0) {
        updateDatabase();
    }

}

// function to connect to the database then update the table ID with the list of watched videos
function updateDatabase() {
    // connect to the database
    // $conn = mysqli_connect("wcetest-do-user-13153530-0.b.db.ondigitalocean.com","doadmin","AVNS_8WsUdQ7GU9RwUI5S9gd","DATA", 25060);
    $conn = mysqli_connect("localhost","capsule","Malinim+59","endoscopy");
              
    // get the list of watched videos
    $watched_videos = $_SESSION['watched_videos'];
    // get the ID of the current user
    $table_id = $_SESSION['id'];

    // for each watched video, update the database with three columns: 'id', 'videoName', 'value' and 'timeProcess'
    foreach ($watched_videos as &$watched_video) {
        $src = $watched_video['src'];
        $value = $watched_video['value'];
        $duration = $watched_video['duration'];

        $_SESSION['total_time'] += $duration;
        $_SESSION['total_video'] += 1;
        $sql = "UPDATE `$table_id` SET `value` = '$value', `timeProcess` = '$duration' WHERE `videoName` = '$src'";
        mysqli_query($conn, $sql);
        // check query is successful
        if (mysqli_affected_rows($conn) <= 0) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }
    // insert the total time and total videos to the database with table userNote
    $sql = "UPDATE `userNote` SET `totalTime` = '$_SESSION[total_time]', `totalVideo` = '$_SESSION[total_video]' WHERE `userNote`.`ID` = '$table_id'";
    mysqli_query($conn, $sql);
    // check query is successful
    if (mysqli_affected_rows($conn) <= 0) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // empty the list of watched videos
    $_SESSION['watched_videos'] = array();
    // close the connection
    mysqli_close($conn);
}

// function to get the next video
function nextVideo($notification) {
    // get the next video of the src_current video in the dist_videos list
    $dist_videos = $_SESSION['dist_videos'];
    global $src_current;
    $src_next = '';
    $index = array_search($src_current, $dist_videos);
    if ($index !== false && $index < count($dist_videos) - 1) {
        $src_next = $dist_videos[$index + 1];
        // $notification = 'pass';
    }else {
        // if the src_current is the last video in the dist_videos list, get the first video in the list
        $src_next = $dist_videos[0];
        $notification = 'end';
        // update the database that user has finished the video
        $table_id = $_SESSION['id'];
        $sql = "UPDATE `userNote` SET `pass` = '1' WHERE `userNote`.`ID` = '$table_id'";
        // $conn = mysqli_connect("wcetest-do-user-13153530-0.b.db.ondigitalocean.com","doadmin","AVNS_8WsUdQ7GU9RwUI5S9gd","DATA", 25060);
        $conn = mysqli_connect("localhost","capsule","Malinim+59","endoscopy");
              
        mysqli_query($conn, $sql);
        // check query is successful
        if (mysqli_affected_rows($conn) <= 0) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        // close the connection
        mysqli_close($conn);


        
    }
    // if the src_next is empty, then the current video is the last video in the list
    if ($src_next == '') {
        // get the first video in the list
        $src_next = $dist_videos[0];
    }
    // get the ref video of the src_next video
    $ref_next = findRefVideo($src_next);
    // set the session variables
    $_SESSION['src_current'] = $src_next;
    $_SESSION['ref_current'] = $ref_next;
    $_SESSION['src_next'] = $src_next;
    $_SESSION['ref_next'] = $ref_next;
    // return the src_next and ref_next
    echo json_encode(array('src_next' => $src_next, 'ref_next' => $ref_next, 'notification' => $notification, 'currentID' => $_SESSION['currentID'], 'numTotal' => $_SESSION['length']));
    
}
