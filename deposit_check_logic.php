<?php
session_start();
require_once("include_page.php");

$db = new DataBaseActions();


$timestamp = time();
$dt = new DateTime("now", new DateTimeZone('America/Los_Angeles')); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
$amount = 0;

$accountNumber = 0;

if($_POST){
    $amount = $_POST['deposit'];

    $accountNumber = $_POST['account_type'];
    $_POST['account_type'] = $db->recoverFullAccountNumber($accountNumber, $_POST['ssn']);
}

if(handleCheck($db, $dt)){
    header("location:Admin.php");
    die();
}

function handleCheck($db, $dataTime){
    $checkName = storePhotoAndReturnItsName($dataTime); //this is goes to the description field.
    $db->makeTransaction($dataTime->format('m.d.Y, H:i:s'), 'Check Deposit', $checkName, $_POST['deposit'], $_POST['account_type'],
        $checkName, Transaction::STATUS_COMPLETED, Transaction::TYPE_CHECK);
    if($checkName==-1){
        return false;
    } else return true;
}

function storePhotoAndReturnItsName($dataTime){
    $delim = ".";
    $fileParts = explode($delim, $_FILES["fileToUpload"]["name"]);
    $extension = end($fileParts);

    $target_dir = "checkScans/";
    $target_file = $target_dir . $_FILES["fileToUpload"]["name"]."__".$dataTime->format('Y-m-d_H-i-s').".".$extension;

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        return -1;
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    return $target_file;
}