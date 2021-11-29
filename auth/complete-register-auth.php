<?php
    session_start(); 

    $curlResult = "";
    $retVal = "";
    $status = 400;
    $data = []; 
    $isValid = true;

// Grab the registration token from the session
$registrationToken = isset($_SESSION['registration_token']) ? $_SESSION['registration_token'] : null;

// Check if the user has a registration token set
if($registrationToken == null){
    $isValid = false;
    $status = 401;
    $retVal = "No registration token found. Please login and re-submit application.";
}

// If token still valid, send a request to mark user as registered and submit a support ticket so agent can review worker's records
if($isValid){
    // Curl pre-initialization - Api Call to mark worker as registered and submit a ticket
    // $url = "http://localhost/slim3homeheroapi/public/registration/submit-application"; // DEV
    $url = "https://slim3api.herokuapp.com/registration/submit-application"; // PROD
    
    $headers = array(
        "Authorization: Bearer ".$_SESSION["registration_token"],
        'Content-Type: application/json',
    );

    $post_data = array(
        'hasRegistered' => 'true'
    );

    // 1. Initialize
    $ch = curl_init();
    
    // 2. set options
        // URL to submit to
        curl_setopt($ch, CURLOPT_URL, $url);

        // Return output instead of outputting it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Type of request = POST
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        

        // Set headers for auth
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Adding the post variables to the request
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        // Execute the request and fetch the response. Check for errors
        $output = curl_exec($ch);

        if($output === FALSE){
            $curlResult =  curl_error($ch);
            $isValid = false;
            $status = 500;
            $retVal = "There was a problem with the curl request.";
        }

        curl_close($ch);

        // $output =  json_decode(json_encode($output), true);
        $curlResult =  json_decode($output);

}

// If Curl was successful, update current token to reflect that registration is complete
if($isValid){
    // =======================================================================
    //  === Change the Current Session Variable to Reflect the newchanges in DB
    $hasRegistered = isset($_SESSION['registration_token']) ? $_SESSION['registration_token'] : null;

    if(   $hasRegistered != null){
        $_SESSION['hasRegistered'] = true ;
        // $_SESSION['initials'] = $initials;
        $retVal = "updated Registration token";
        $status = 200;
    } else {
        $retVal = "Invalid Token";
    }
}
    
    $myObj = array(
        'status' => $status,
        'message' => $retVal,
        'data' => $_SESSION['registration_token'] , 
        'curlResult' =>  $curlResult
    );
    
    $myJSON = json_encode($myObj, JSON_FORCE_OBJECT);
    echo $myJSON;
?>