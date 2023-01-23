
<?php
// session_start();
// function to get all image paths in two folders
function getImages() {
    $ref_images = array();
    $ref_images = array_merge($ref_images, glob('imageExp/ref_images/*.jpg'));
    $dist_images = array();
    $dist_images = array_merge($dist_images, glob('imageExp/dist_images/*.jpg'));


    // return two arrays
    return array($ref_images, $dist_images);
}


// function to find the image with the same name as the reference image + level* in the dist_images folder
function findImage($ref_image, $dist_images, $level) {
    $image_name = basename($ref_image);
    $image_name = substr($image_name, 0, -4);
    $image_name = $image_name . "level" . $level . ".jpg";

    $image_path = "imageExp/dist_images/" . $image_name;

    if (in_array($image_path, $dist_images)) {
        return $image_path;
    } else {
        return "https://play.teleporthq.io/static/svg/default-img.svg";
    }
}

?>