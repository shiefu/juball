<?php
require_once "functions.php";

/*
$source_url = 'http://99shishicai.com/index.php?c=member&a=login&run=1';
$ch = curl_init( $source_url );
curl_setopt($ch, CURLOPT_COOKIEFILE, "/tmp/cookiefile");
//curl_setopt( $ch, CURLOPT_COOKIE, "99sport_auth=".AUTH_COOKIE);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array("username" => "M61130", "password" => "QAZ0609")));
//curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
//curl_setopt( $ch, CURLOPT_HEADER, 1);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
$html = curl_exec( $ch );
curl_close($ch);
echo $html;
*/
/*
$ch = curl_init();
curl_setopt($ch, CURLOPT_COOKIEJAR, "/tmp/cookiefile");
//curl_setopt($ch, CURLOPT_URL,"http://www.skcai99.com/index.php?c=member&a=login&run=1");
curl_setopt($ch, CURLOPT_URL,"http://www.99shishicai.com/index.php?c=member&a=login&run=1");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "username=M61130&password=QAZ0609");

ob_start();      // prevent any output
curl_exec ($ch); // execute the curl command
ob_end_clean();  // stop preventing output

curl_close ($ch);
unset($ch);
*/

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_COOKIEFILE, "/tmp/cookiefile");
//curl_setopt($ch, CURLOPT_URL,"http://slcai1.com/?c=cqssc&a=yxwm_latest_show");
//curl_setopt($ch, CURLOPT_URL,"http://cp658658.net/getLiveData.php?c=cqssc&a=yxqm_data_show&planType=yxqm");
curl_setopt($ch, CURLOPT_URL,"http://cp658658.net/getLiveData.php?c=cqssc&a=yxwm_latest_show&planType=yxwm");
//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array("digit"=>"w", "plan"=>"a")));
//curl_setopt($ch, CURLOPT_URL,SOURCE_DOMAIN."/?c=cqssc&a=yxwm&digit=q&plan=a");
//curl_setopt($ch, CURLOPT_URL,"http://cp658658.net/getPage.php?pagename=index.php&c=cqssc&a=yxwm&digit=q&plan=a");

$html = curl_exec($ch);

curl_close ($ch);

echo $html;
//echo "<PRE>".htmlentities($buf2);
//echo htmlentities($buf2);

//$html = replace_html('cqssc', $html);

//echo html_entity_decode($html);
