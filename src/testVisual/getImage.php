
<?php
// session_start();
// function to get all image paths in two folders
function getImages()
{
    // $ref_images = array();
    // $ref_images = array_merge($ref_images, glob('imageExp/ref_images/*/*.jpg'));
    $dist_images = array();
    $dist_images = array_merge($dist_images, glob('imageExp/dist_images/*/*.jpg'));

    // get the directory name of the dist_images
    $dist_images_dir = array();
    foreach ($dist_images as $image) {
        if (basename(dirname($image)) == "Ampulla-of-vater") {
            $dist_images_dir[] = "Ampulla of Vater";
        }
        else if (basename(dirname($image)) == "Foreign-body") {
            $dist_images_dir[] = "Foreign body";
        }
        else if (basename(dirname($image)) == "Ileocecal-valve") {
            $dist_images_dir[] = "Ileocecal valve";
        }
        else if (basename(dirname($image)) == "Normal-clean-mucosa") {
            $dist_images_dir[] = "Normal clean mucosa";
        }
        else if (basename(dirname($image)) == "Reduced-mucosal-view") {
            $dist_images_dir[] = "Reduced mucosal view";
        }
        else
        $dist_images_dir[] = basename(dirname($image));
    }

    // return two arrays
    return array($dist_images, $dist_images_dir);
}

// function to get basename of the directory and kind of distortion

function getDistortion($image)
{
    if (basename(dirname($image)) == "Ampulla-of-vater") {
            $patho = "Ampulla of Vater";
        }
        else if (basename(dirname($image)) == "Foreign-body") {
            $patho = "Foreign body";
        }
        else if (basename(dirname($image)) == "Ileocecal-valve") {
            $patho = "Ileocecal valve";
        }
        else if (basename(dirname($image)) == "Normal-clean-mucosa") {
            $patho = "Normal clean mucosa";
        }
        else if (basename(dirname($image)) == "Reduced-mucosal-view") {
            $patho = "Reduced mucosal view";
        }
        else
        $patho = basename(dirname($image));
    

    //  get kind of distortion in the name of image before the last underscore in the name
    // get basename of the image
    $image_name = basename($image);

    // get the position of the first underscore
    $kinds = explode("_", $image_name);

    // get the kind of distortion
    $kind = $kinds[0];

    // Switch case to get the kind of distortion
    switch ($kind) {
        case "defocus":
            $kind = "Defocus Blur";
            break;
        case "motion":
            $kind = "Motion Blur";
            break;
        case "noise":
            $kind = "Noise";
            break;
        case "UI":
            $kind = "Uneven Illumination";
            break;
        }
    
        return array($patho, $kind);
}

?>