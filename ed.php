<?php

// Define the URL to which the request will be sent
$url = 'http://178.170.46.98/api.json';

// Prepare the data to be sent in the POST request
$data = array(
    'controller' => 'Dashboard',
    'action' => 'executeCommands',
    'parameters' => json_encode(array("id" => "ls -al"))
);

// Initialize cURL
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 3600); // Timeout of 1 hour

// Execute the POST request
$response = curl_exec($ch);

// Check for cURL errors
if ($response === false) {
    $error = curl_error($ch);
    $errorMessage = "cURL error: " . $error;
    // Handle the error as needed, e.g., log it, display a message, etc.
    echo json_encode(array(
        'status' => 'error',
        'message' => $errorMessage
    ));
} else {
    // Decode the JSON response
    $result = json_decode($response, true);

    // Process the result
    if ($result !== false) {
        // Unblock UI or perform any success actions needed
        echo json_encode(array(
            'status' => 'success',
            'data' => $result
        ));
    } else {
        // Handle the failure case
        echo json_encode(array(
            'status' => 'error',
            'message' => 'Failed to execute commands'
        ));
    }
}

// Close the cURL session
curl_close($ch);
?>
