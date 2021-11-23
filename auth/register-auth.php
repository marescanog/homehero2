<?php
    session_start(); 

    $retVal = "";
    $status = 400;
    $data = []; 

    // Check if token is generated
    $token = isset($_POST['registration_token']) ? $_POST['registration_token'] : null;

    $hasRegistered = isset($_POST['hasRegistered']) ? $_POST['hasRegistered'] : null;
    // $skill = isset($_POST['skill']) ? $_POST['skill'] : null;
    // $city = isset($_POST['city']) ? $_POST['city'] : null;


    if($token != null){
        $_SESSION['registration_token'] = $token;
        $_SESSION['hasRegistered'] = $hasRegistered ;
        // $_SESSION['initials'] = $initials;
        $retVal = "Received Registration token";
        $status = 200;
    } else {
        $retVal = "Invalid Token";
    }

    $myObj = array(
        'status' => $status,
        'message' => $retVal,
        'data' => $_SESSION['registration_token']  
    );
    
    $myJSON = json_encode($myObj, JSON_FORCE_OBJECT);
    echo $myJSON;
?>