<?php
    //REMOVE FILE LIMIT
    ini_set('memory_limit', '-1'); 
    
    // Function to add text water mark over image
    function addTextWatermark($src, $watermark, $save=NULL, $type) {
    list($width, $height) = getimagesize($src);
    $image_color = imagecreatetruecolor($width, $height);
    $textlen = strlen($watermark);
    if ($type == "png"){
        $image = imagecreatefrompng($src);
    }
    else{
        $image = imagecreatefromjpeg($src);
    }
    imagecopyresampled($image_color, $image, 0, 0, 0, 0, $width, $height, $width, $height);

    //TEXT COLOR
    $txtcolor = imagecolorallocate($image_color, 255, 255, 255);

    //TEXT FONT FAMILY PATH
    $font = 'watermark/opensan.ttf';

    //TEXT FONT SIZE
    $font_size = $width/70;

    //SOURCE_FILE, FONT_SIZE, ROTATION, X COORDINATE, Y COORDINATE, TEXT_COLOR, FONT_FAMILY, WATERMARK
    imagettftext($image_color, $font_size, 0, $font_size, $height-$font_size, $txtcolor, $font, $watermark);
    if ($save<>'') {
        if ($type == "png"){
            imagepng($image_color, $save, 7);
        }
        else{
            imagejpeg ($image_color, $save, 100);
        }
      
        }
    else {
       
        }
    imagedestroy($image);
    imagedestroy($image_color);
}

// Function to add image watermark over images
function addImageWatermark($SourceFile, $WaterMark, $DestinationFile=NULL, $type) {
$main_img = $SourceFile;
$watermark_img = $WaterMark;
$padding = 20;
//$opacity = $opacity;
// create watermark
$watermark = imagecreatefrompng($watermark_img);
if ($type == "png"){
    $image = imagecreatefrompng($main_img);
}
else{
    $image = imagecreatefromjpeg($main_img);
}

    if(!$image || !$watermark) die("Error: main image or watermark image could not be loaded!");
    $watermark_size = getimagesize($watermark_img);
    $img = getimagesize($main_img);
    $w = $img[0];
    $h = $img[1];
    $watermark_width = $watermark_size[0];
    $watermark_height = $watermark_size[1];
    $image_size = getimagesize($main_img);
    $dest_x = $image_size[0] - $watermark_width;
    $dest_y = $image_size[1] - $watermark_height;

    //ADJUSTING OF WATERMARK
    imagecopy($image, $watermark, $dest_x-10, $dest_y, 0, 0, $watermark_width, $watermark_height);
        if ($DestinationFile<>'') {
            if ($type == "png"){
                imagealphablending($image, false); 
                imagesavealpha($image,true);
                imagepng($image, $DestinationFile, 7);
            }else{
                imagejpeg($image, $DestinationFile, 100);
            }
      
        } else {
     
        }
        imagedestroy($image);
        imagedestroy($watermark);

}
?>