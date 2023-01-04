
<?php
// session_start();
// function to get all video paths in two folders
function getVideos() {
    $ref_videos = array();
    $ref_videos = array_merge($ref_videos, glob('ref_videos/*.mp4'));
    $dist_videos = array();
    $dist_videos = array_merge($dist_videos, glob('dist_videos/*/*/*.mp4'));
    
    // suffle the videos in the array dist_videos
    shuffle($dist_videos);

    // return two arrays
    return array($ref_videos, $dist_videos);
}


// function to find the video with the same name as the dist video in the ref_videos list
function findRefVideo($dist_video) {
    $ref_videos = $_SESSION['ref_videos'];
    $ref_video = '';
    foreach ($ref_videos as &$video) {
        if (strpos($video, basename($dist_video)) !== false) {
            $ref_video = $video;
            break;
        }
    }
    return $ref_video;
}

?>