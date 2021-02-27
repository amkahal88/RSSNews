<?php

$id=$_GET['id'];
$url = "http://localhost:3000/api/subscribers/update?where=%7B%22_id%22%3A%22" . $id . "%22%7D";

//Initiate cURL.
$ch = curl_init($url);

//The JSON data.
$jsonData = array(
    'status' => false
);

//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);

//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 

//Execute the request
$result = curl_exec($ch);

echo "<h2>you are unsubscribed from CodnLoc Newsletter.</h2>";
?>