<?php

$retVal = "";
$isValid = true;
$status = 400;

$extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
$folderName = "NBI-Clearance";
$fileDestination = "../../images/uploads/$folderName";
$allowed = array("jpg", "jpeg", "png", "pdf");
$newFileName = "";
// $_FILES['file']['name'] -> gets the file name where 'file' is the name of the input feild

// Function that reformats the file name to random name
function renameFile($ext) {
    $basename = bin2hex(random_bytes(50)); // see http://php.net/manual/en/function.random-bytes.php
    $filename = sprintf('%s.%0.8s', $basename, $ext);
    return $filename;
}

// File Validation - Error Upload
if($_FILES['file']['error']){
    $isValid = false;
    $retVal = "There was an error uploading the file. Please try again.";
}

// File Validation - Incorrect Extension
if(!in_array($extension, $allowed)){
    $isValid = false;
    $retVal = "You cannot upload files of this type. Please upload jpg, png or pdf files only.";
}

// File Validation - Size Exceeds limit
if($_FILES['file']['size'] > 5000000){
    $isValid = false;
    $retVal = "Please upload images less than 5MB.";
}

// ensure that the folder location exists
if(!file_exists($fileDestination)){
    $isValid = false;
    $retVal = "Specified Folder does not exist.";
}

//while file exists in the folder, create new names until arriving at unique name
if($isValid){
    do{
        $newFileName = renameFile($extension);
    }
    while(file_exists("$fileDestination/$newFileName"));
}

// Upload the file
if($isValid){ 
    //$fileDestination
    // $result = move_uploaded_file($_FILES['file']['tmp_name'],  dirname(__FILE__)."/../../images/uploads/NBI-Clearance/$newFileName");
    $result = move_uploaded_file($_FILES['file']['tmp_name'],  dirname(__FILE__)."/$fileDestination/$newFileName");
    $status = $result == false? 400 : 200;
    $retVal = $result == false? "There was something wrong with the file transfer" : "File was uploaded successfully.";
}

// debug tests
// $status = 200;
// $retVal = file_exists($fileDestination);
// $retVal = file_exists("$fileDestination/$newFileName");
// $retVal = file_exists("../../images/uploads/NBI-Clearance");

// return the new name
$data = [];
$data['newFileName'] = $newFileName;
$data['fileDestination'] = "$fileDestination/";

$myObj = array(
    "status" => $status,
    "message" => $retVal,
    "data" => $data
);

$myJSON = json_encode($myObj, JSON_FORCE_OBJECT);

$db_conn_upload = null;

echo $myJSON;

?>