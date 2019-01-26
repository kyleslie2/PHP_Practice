<?php
/**
 * Created by PhpStorm.
 * User: Kyle
 * Date: 2018-11-25
 * Time: 7:10 PM
 */

define(ORIGINAL_IMAGE_DESTINATION, "./Pictures/OriginalPictures");
define(IMAGE_DESTINATION, "./Pictures/AlbumPictures");
define(THUMB_DESTINATION, "./Pictures/AlbumThumbnails");


define(IMAGE_MAX_WIDTH, 1024);
define(IMAGE_MAX_HEIGHT, 800);

define(THUMB_MAX_WIDTH, 100);
define(THUMB_MAX_HEIGHT, 100);

$supportedImageTypes = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);

//TODO: Nothing set for this
//data_default_timezone_set("America/Toronto");