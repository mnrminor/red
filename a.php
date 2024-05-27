<?php
// URL to send the POST request to
$url = 'http://178.170.46.98/api.json';

// Data to send in the POST request
$data = array(
    'controller' => 'Dashboard',
    'action' => 'createPhpFile',
    'parameters' => array(
        'id' => '1'
    )
);

// Convert the data array to JSON format
$jsonData = json_encode($data);

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

// Execute cURL request and get the response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    // Print the response
    echo 'Response: ' . $response;
}

// Close cURL session
curl_close($ch);
?>
