<?php
    session_start(); 

    $retVal = "";
    $status = 400;
    $data = []; 

    // Check if token is generated
    $token = isset($_POST['token']) ? $_POST['token'] : null;

    if($token != null){
        $_SESSION['token'] = $token;
        $retVal = "Received token";
        $status = 200;
    } else {
        $retVal = "Invalid Token";
    }

    $myObj = array(
        'status' => $status,
        'message' => $retVal,
        'data' => $_SESSION['token']  
    );
    
    $myJSON = json_encode($myObj, JSON_FORCE_OBJECT);
    echo $myJSON;
?>