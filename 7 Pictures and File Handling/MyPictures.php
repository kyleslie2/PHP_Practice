
<?php include("./Common/Header.php");
session_start(); 	// start PHP session!

//region Included Constants
////define constants for convenience
//define(ORIGINAL_IMAGE_DESTINATION, "./Pictures/OriginalPictures");
//
//define(IMAGE_DESTINATION, "./Pictures/AlbumPictures");
//define(IMAGE_MAX_WIDTH, 800);
//define(IMAGE_MAX_HEIGHT, 600);
//
//define(THUMB_DESTINATION, "./Pictures/AlbumThumbnails");
//define(THUMB_MAX_WIDTH, 100);
//define(THUMB_MAX_HEIGHT, 100);
//
////Use an array to hold supported image types for convenience
//$supportedImageTypes = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
//endregion

include "Common/Class_Lib.php";
include "Common/ConstantsAndSettings.php";
include "Common/Functions.php";

$pics = Picture::getPictures();
//print_r($pics);

$originalFilePath = "Pictures/OriginalPictures/";
$originalArray = scandir($originalFilePath);


$thumbnailPath = "Pictures/AlbumThumbnails/";
$thumbnailArray = scandir($thumbnailPath);
$totalThumbPath = $thumbnailPath.$thumbnailArray[3];

$albumPath = "Pictures/AlbumPictures/";

//array of the filenames in folder
$albumImagesArray = scandir($albumPath);
$totalAlbumPath = $albumPath.$albumImagesArray[3];

if (isset($_GET['imageName']))
{
    //getting basename from URL
    $basename = $_GET['imageName'];

    foreach ($albumImagesArray as $image)
    {
        if ($image == $basename)
        {
            //displayPicture is the full filepath to the specific image
            $displayPicture = $albumPath.$basename;

            //sometimes we need a session to keep track of the selected picture
            $_SESSION['displayedImage'] = $displayPicture;
            $_SESSION['currentBasename'] = $basename;
        }
    }

}
else
{
    if (isset ($_SESSION['displayedImage']))
    {
//        echo "from session";
        $displayPicture = $_SESSION['displayedImage'];
        $basename = $_SESSION['currentBasename'];
    }
    else
    {
        //if there are no pictures uploaded display this message. Starts at 4 because of .DS_Store file
        if ((count($thumbnailArray) < 4) || $thumbnailArray == null)
        {
            $basename = "YOU DO NOT CURRENTLY HAVE ANY PHOTOS TO DISPLAY. </br> <hr></br> PLEASE UPLOAD SOME USING THE UPLOAD PAGE.";
        }
        else
        {

            $displayPicture = $albumPath.$albumImagesArray[3];

            $basename = $albumImagesArray[3];

        }

    }

}

if (isset($_GET['btnLeft']))
{

    rotateImage($displayPicture, -90);

    header("location: MyPictures.php");
    exit();


}
if (isset($_GET['btnRight']))
{
    rotateImage($displayPicture, 90);

    header("location: MyPictures.php");
    exit();


}

if (isset($_GET['download']))
{
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.$basename);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: '.filesize($displayPicture));
    ob_clean();
    flush();
    readfile($displayPicture);
    exit;
}

if (isset($_GET['delete']))
{
    unlink(ORIGINAL_IMAGE_DESTINATION . '/' . $basename);
    unlink(IMAGE_DESTINATION . '/' . $basename);
    unlink(THUMB_DESTINATION . '/' . $basename);
    session_destroy();
    header("Location: MyPictures.php");
    exit();
}



?>
<h1 align="center"> <?php echo $basename;?></h1>

<div class="img-container">
<!--    display the image based on the basename-->
    <img src="<?php echo $displayPicture ?>" >
<form action="MyPictures.php?imageName="<?php $basename; ?>" method="get">
    <div class="action-list">
        <button style="border:none; background-color: transparent;" type="submit" name="btnLeft">
            <span class="glyphicon glyphicon-repeat gly-flip-horizontal actionButtons">
        </button>
        <button style="border:none; background-color: transparent;" type="submit" name="btnRight">
            <span class="glyphicon glyphicon-repeat"></span>
        </button>
        <button style="border:none; background-color: transparent;" type="submit" name="download">
            <span class="glyphicon glyphicon-download-alt"></span>
        </button>
        <button style="border:none; background-color: transparent;" type="submit" name="delete">
            <span class="glyphicon glyphicon-trash"></span>
        </button>
    </div>
</form>

</div>



<div class="horizontal-scroll-wrapper">
<div class="container testimonial-group">
    <div class="row text-center">
         <?php
            if (count($thumbnailArray) > 2) {
                for ($i = 3; $i < count($thumbnailArray); $i++) {
                    $totalThumbPath = $thumbnailPath.$thumbnailArray[$i];
                    $fileInfo = pathinfo($totalThumbPath);
                    printf("<a href='MyPictures.php?imageName=$fileInfo[basename]'> <img src='$totalThumbPath'/></a>");

                }
            }
            ?>

    </div>
</div>
</div>


<?php include("./Common/Footer.php");?>
