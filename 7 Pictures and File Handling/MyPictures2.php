<?php
/**
 * Created by PhpStorm.
 * User: Kyle
 * Date: 2018-11-28
 * Time: 2:26 PM
 */

include("./Common/Header.php");

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
?>



<div class="bs-example">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">



        <!-- Wrapper for carousel items -->
        <div class="carousel-inner">

            <div class="item active">
                <img src="<?php echo $pics[5]->getAlbumFilePath() ?>" >
            </div>

        </div>


    </div>
</div>


<?php include("./Common/Footer.php");?>