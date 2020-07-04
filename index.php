<?php

//Initialize variables, paths
include 'watermark/watermark.php';
$textWatermark = "https://github.com/lenn0n/"; //text type ng watermark, pwedeng sql query
$imgWaterMark = 'watermark/watermark.png'; //path ng watermark png file


//HTML FILE UPLOADER
echo '
<div class="container">
<h2>Add Watermark To Images</h2>
<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="image" value="">
<br/>
<input type="submit" value="Upload">
</form>
</div>
';

//PROCESS FILE UPLOAD
if(isset($_FILES['image']['name'])){
switch($_FILES['image']['type']){
    case 'image/jpeg':
    case 'image/jpg':
    case 'image/png':
    list($txt, $ext) = explode(".", $_FILES['image']['name']);
    $file_name = "images/".rand(0, 9999).'.'.$ext;
    $upload = copy($_FILES['image']['tmp_name'], $file_name);
        if($upload == true){
            $type = "";
            if ($_FILES['image']['type'] == "image/png"){
                $type = "png";
            }else{
                $type = "jpg";
            }

            //CALLS THE FUNCTIONS
            addTextWatermark($file_name, $textWatermark, $file_name, $type);
            addImageWatermark ($file_name, $imgWaterMark, $file_name, $type);

            //PREVIEW THE LAST UPLOADED
            echo 'Preview:<br><img src="'.$file_name.'" class="preview" width="500"><br>';
        }
        else{
            echo 'Error uploading image';
        }
    break;
    default:
    echo 'Please select only JPEG, JPG or PNG file type for upload';
    }
}

?>
