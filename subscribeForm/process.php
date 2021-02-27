<?php
echo "warm up";

	$name = $_POST['name'];
	$email = $_POST['email'];
	$phonenumber = $_POST['phonenumber'];
	$userId = $_POST['userId'];
	
echo $name . " " .$email. " " .$phonenumber . " " . $userId;

//API Url
$url = 'http://localhost:3000/api/subscribers';

//Initiate cURL.
$ch = curl_init($url);

//The JSON data.
$jsonData = array(
    'name' => $name,
    'phonenumber' => $phonenumber,
	 'userId' => $userId,
	  'email' => $email
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

?>