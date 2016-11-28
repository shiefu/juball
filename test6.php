<?php
/*
$data = json_encode(array(
    "account"  => "EB227",
    "pwd" => "aa1234"
));

$ch = curl_init();
curl_setopt($ch, CURLOPT_COOKIEJAR, "/tmp/cookiefile");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, 'http://w886.tg777.net/index2.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $data);
ob_start();      // prevent any output
curl_exec($ch); // execute the curl command
ob_end_clean();  // stop preventing output
curl_close ($ch);
unset($ch);

echo "<hr>";

$data2 = json_encode(array(
    "account"  => "EB227",
    "pwd" => "aa1234",
    "force_session" => ""
));
$ch = curl_init();
curl_setopt($ch, CURLOPT_COOKIEJAR, "/tmp/cookiefile");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, 'http://w3.tg777.net/controler/session.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($ch);
curl_close($ch);

echo $response;
*/
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, 'http://w3.tg777.net/');
$response = curl_exec($ch);
echo $response;

//http://1785178.net/juball/test6.php
//header("location: http://w3.tg777.net/list.php");