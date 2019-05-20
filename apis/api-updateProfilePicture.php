<?php
session_start();
require_once '../components/apiCheckUserLogged.php'; 

function updateProfilePicture() {
    global $uploadedFile;
    require_once '../database.php';
    try {
        $sQuery = $db->prepare('UPDATE users
                              SET profilePicture = :sPicture
                              WHERE id = :iId');
        $sQuery->bindValue(':sPicture', $uploadedFile);
        $sQuery->bindValue(':iId', $_SESSION['jUser']['id']);
        $sQuery->execute();
        if($sQuery->rowCount()) {
            echo 'succes';
            exit;
        }
        echo 'error';
    
    } catch(pdOException $exp) {
        // echo $exp;
        echo '{"status":0, "message":"error"}';
        }
    }

// Calling getimagesize() function - validate if this is a image or a fake image (could be js script)
list($width, $height) = getimagesize($_FILES['file']['tmp_name']); 
if ( !($width > 0 || $height > 0 ) ) {
    echo 'error';
    exit();
}


$uploadedFile = '';
if(!empty($_FILES['file']['name'])){
    if(!empty($_FILES["file"]["type"])){
        $fileName = time().'_'.$_FILES['file']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["file"]["name"]);
        $file_extension = end($temporary);
        if((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
            $sourcePath = $_FILES['file']['tmp_name'];
            $targetPath = '../img/'.$fileName; 
            move_uploaded_file($sourcePath,$targetPath);
            $uploadedFile = $fileName; 
            updateProfilePicture(); 
        }
    }
}




