<?php include("./Common/Header.php");

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

include "Common/ConstantsAndSettings.php";
include "Common/Functions.php";

$thumbnailPath = "Pictures/AlbumThumbnails/";
$thumbnailArray = scandir($thumbnailPath);

if (isset($_POST['btnUpload']))
{
    for ($j = 0; $j < count($_FILES['txtUpload']['tmp_name']); $j++) {

        if ($_FILES['txtUpload']['error'][$j] == 0) {
            $filePath = save_uploaded_file(ORIGINAL_IMAGE_DESTINATION, $j);

            $imageDetails = getimagesize($filePath);

            if ($imageDetails && in_array($imageDetails[2], $supportedImageTypes)) {
                resamplePicture($filePath, IMAGE_DESTINATION, IMAGE_MAX_WIDTH, IMAGE_MAX_HEIGHT);

                resamplePicture($filePath, THUMB_DESTINATION, THUMB_MAX_WIDTH, THUMB_MAX_HEIGHT);
            } else {
                $error = "Uploaded file is not a supported type";
                unlink($filePath);
            }
        } elseif ($_FILES['txtUpload']['error'][$j] == 1) {
            $error = "Upload file is too large";
        } elseif ($_FILES['txtUpload']['error'][$j] == 4) {
            $error = "No upload file specified";
        } else {
            $error = "Error happened while uploading the file. Try again later";
        }
    }
    header("Location: UploadPictures.php");
    exit();

}
?>



<!--region My Upload HTML-->
<div class="container">
    <h1 >Upload Pictures</h1>
    <hr>
    <br>

    <h4>Accepted picture types: JPG (JPEG), GIF, and PNG</h4>
    <br>
    <h4>Tip: You can upload multiple pictures at a time by pressing the shift key while selecting pictures.</h4>

    <br><br>

    <span class='error'><?php echo $error;?></span>

    <form action="UploadPictures.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="uploadInput">File to Upload:</label>
            <input style="background-color: white;" type="file" class="form-control-file" id="txtUpload" name="txtUpload[]" multiple accept="image/png, image/jpeg, image/gif">
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="btnUpload" value="Upload"/>
            &nbsp; &nbsp; &nbsp;<input class="btn btn-danger" type="reset" name="btnReset" value="Reset"/>

        </div>
    </form>

    <?php
    if ((count($thumbnailArray) > 3) || $thumbnailArray == null)
    {
        echo "<div class='container' align='center'><h2>All Uploaded Files</h2><hr></div>";
        $files = scandir(ORIGINAL_IMAGE_DESTINATION);

        for ($i = 3; $i < count($files); $i++) {
            print("<div>$files[$i]<hr/></div>");

        }
    }

    ?>

</div>










<?php include("./Common/Footer.php");?>
<!--endregion-->

