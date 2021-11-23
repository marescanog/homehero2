<?php
    session_start(); 

    $retVal = "";
    $status = 400;
    $data = []; 

    // Check if token is generated
    $token = isset($_POST['token']) ? $_POST['token'] : null;

    $firstName = isset($_POST['first_name']) ? $_POST['first_name'] : null;
    $initials = isset($_POST['initials']) ? $_POST['initials'] : null;


    if($token != null){
        $_SESSION['token'] = $token;
        $_SESSION['first_name'] = $firstName ;
        $_SESSION['initials'] = $initials;
        $_SESSION['user_type'] = 1;
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