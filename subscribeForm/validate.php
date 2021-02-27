<?php



if(isset($_POST["userid"]))
{
$userid = $_POST["userid"];
$userid = urlencode($userid);

$xml = file_get_contents("http://localhost:3000/api/subscribers/count?where=%7B%20%20%20%20%20%22userId%22%3A%20%22" . $userid . "%22%20%20%20%7D");

if (isset($xml))
	echo $xml;
else echo "error";
}

else if(isset($_POST["email"]))
{
$email = $_POST["email"];
$email = urlencode($email);

$xml = file_get_contents("http://localhost:3000/api/subscribers/count?where=%7B%20%20%20%20%20%22email%22%3A%20%22" . $email . "%22%20%20%20%7D");

if (isset($xml))
	echo $xml;
}

else if(isset($_POST["phonenumber"]))
{
$phonenumber = $_POST["phonenumber"];
$phonenumber = urlencode($phonenumber);

$xml = file_get_contents("http://localhost:3000/api/subscribers/count?where=%7B%20%20%20%20%20%22phonenumber%22%3A%20%22" . $phonenumber . "%22%20%20%20%7D");

if (isset($xml))
	echo $xml;
}

else echo "empty end";
?>
