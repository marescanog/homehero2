<?php
    session_start(); 

    $retVal = "";
    $status = 400;
    $data = []; 
    $isValid = true;

    // Check if token is generated
    $token = isset($_POST['token']) ? $_POST['token'] : null;
    $userType = isset($_POST['userType']) ? $_POST['userType'] : null;
    $firstName= null;
    $initials = null;
    $email = null;
    $supportRole = null;

    // Check if the user has a registration token set
    if($token == null || $userType == null){
        $isValid = false;
        $status = 401;
        $retVal = "No registration token found. Please login and re-submit application.";
    }

    // If token still valid, send a request to 
    // verify the JWT and based on the user type, retreive user data to set in session variables.
    // if($isValid){
    //     // Curl pre-initialization - Api Call to mark worker as registered and submit a ticket
    //     // $url = "http://localhost/slim3homeheroapi/public/registration/submit-application"; // DEV
    //     $url = "https://slim3api.herokuapp.com/registration/submit-application"; // PROD
        
    //     $headers = array(
    //         "Authorization: Bearer ".$_SESSION["registration_token"],
    //         'Content-Type: application/json',
    //     );

    //     $post_data = array(
    //         'hasRegistered' => 'true'
    //     );

    //     // 1. Initialize
    //     $ch = curl_init();
        
    //     // 2. set options
    //         // URL to submit to
    //         curl_setopt($ch, CURLOPT_URL, $url);

    //         // Return output instead of outputting it
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //         // Type of request = POST
    //         curl_setopt($ch, CURLOPT_HTTPGET, 1);
            

    //         // Set headers for auth
    //         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    //         // Adding the post variables to the request
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

    //         // Execute the request and fetch the response. Check for errors
    //         $output = curl_exec($ch);

    //         if($output === FALSE){
    //             $curlResult =  curl_error($ch);
    //             $isValid = false;
    //             $status = 500;
    //             $retVal = "There was a problem with the curl request.";
    //         }

    //         curl_close($ch);

    //         // $output =  json_decode(json_encode($output), true);
    //         $curlResult =  json_decode($output);

    // }

    // If Curl was successful, update session with the needed login variables
    if($isValid){
    // =======================================================================
        $_SESSION['token'] = $token;
        $_SESSION['userType'] = $token;

        $retVal = "Verified user token";
        $status = 200;
    }
    
    $myObj = array(
        'status' => $status,
        'message' => $retVal,
        'data' => $_SESSION['token'] , 
        //'curlResult' =>  $curlResult
    );

    $myJSON = json_encode($myObj, JSON_FORCE_OBJECT);
    echo $myJSON;
?>