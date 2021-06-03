<?php

namespace App\Http\Controllers;

use \Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Exception;

class ImageUploadController {

    /**
     * Converts the file to jpeg and stores it in the desired location
     * @param file the uploaded file
     * @param destinationFolder the destination folder
     * @param name the destination file's name, null if automatically generated
     * @return void
     */
    public static function store(UploadedFile $file, $destinationFolder, $name=null) {
        if ($name === null) $name = date('mdYHis') . uniqid();

        $extension = $file->extension();
        $path = $file->path();

        $storageFileName = $name.'.jpg';

        if (preg_match('/jpg|jpeg/i',$extension))
            $tmp=imagecreatefromjpeg($path);

        else if (preg_match('/png/i',$extension))
            $tmp=imagecreatefrompng($path);

        else if (preg_match('/gif/i',$extension))
            $tmp=imagecreatefromgif($path);

        else if (preg_match('/bmp/i',$extension))
            $tmp=imagecreatefrombmp($path);

        else throw new Exception("Image with wrong extension");

        $stream = fopen('php://memory','r+'); // open stream
        imagejpeg($tmp, $stream);  // convert image to jpeg and output to stream
        rewind($stream);   // rewind buffer pointer
        $stringdata = stream_get_contents($stream);   // get string contents

        imagedestroy($tmp);

        Storage::put($destinationFolder.($destinationFolder[strlen($destinationFolder)-1] == '/' ? '' : '/').$storageFileName, $stringdata);
    }

}



?>
