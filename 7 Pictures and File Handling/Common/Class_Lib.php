<?php
include_once "ConstantsAndSettings.php";

class Class_Lib
{
}

class Picture {
    private $fileName;
    private $id;

    public static function getPictures() {
        $pictures = array();
        $files = scandir(IMAGE_DESTINATION);
        $numFiles = count($files);
        if ($numFiles > 3) {
            for($i = 3; $i < $numFiles; $i++){
                $ind = strrpos($files[$i], "/");
                $fileName = substr($files[$i], $ind);
                $picture = new Picture($fileName, $i);
                $pictures["$i"] = $picture;
            }
        }
        return $pictures;
    }

    /**
     * Picture constructor.
     * @param $fileName
     * @param $id
     */
    public function __construct($fileName, $id)
    {
        $this->fileName = $fileName;
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    public function getName(){
        $ind = strrpos($this->fileName, ".");
        $name = substr($this->fileName, 0, $ind);
        return $name;
    }
    public function getAlbumFilePath(){
        return IMAGE_DESTINATION."/".$this->fileName;
    }
    public function getThumbnailFilePath(){
        return THUMB_DESTINATION."/".$this->fileName;
    }
    public function getOriginalFilePath(){
        return ORIGINAL_IMAGE_DESTINATION."/".$this->fileName;
    }
}





