<?php
require_once "functions.php";

//將傳進來的參數名稱、值轉成小寫
$request = array_change_key_case($_REQUEST, CASE_LOWER);

//檢查是否有傳入參數
if (isset($request)){
    //帳號登入
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_COOKIEJAR, "/tmp/cookiefile");
    curl_setopt($ch, CURLOPT_URL, SOURCE_DOMAIN."/?c=member&a=login&run=1");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "username=".USERNAME."&password=".PASSWORD);
    ob_start();      // prevent any output
    curl_exec($ch); // execute the curl command
    ob_end_clean();  // stop preventing output
    curl_close ($ch);
    unset($ch);
    $request_uri = $_SERVER["REQUEST_URI"];
    $request_parameter = str_replace(basename(__FILE__),'',$request_uri);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEFILE, "/tmp/cookiefile");
    curl_setopt($ch, CURLOPT_URL, SOURCE_DOMAIN.$request_parameter);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $_POST);
    $response = curl_exec($ch);
    curl_close($ch);

    /*if ($request_parameter == '/?c=cqssc&a=yxwm_latest_show'){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, "/tmp/cookiefile");
        curl_setopt($ch, CURLOPT_URL, SOURCE_DOMAIN.$request_parameter);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $_POST);
        $response = curl_exec($ch);
        curl_close($ch);
    }
    elseif ($request_parameter == '/?c=cqssc&a=yxwm_data_show'){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, "/tmp/cookiefile");
        curl_setopt($ch, CURLOPT_URL, SOURCE_DOMAIN.$request_parameter);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        $response = curl_exec($ch);
        curl_close($ch);
    }
    //遺漏值-分析資料
    elseif ($request_parameter == '/?c=cqssc&a=yilou_analysis_show'){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, "/tmp/cookiefile");
        curl_setopt($ch, CURLOPT_URL, SOURCE_DOMAIN.$request_parameter);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        $response = curl_exec($ch);
        curl_close($ch);
    }
    //遺漏值-圖表資料
    elseif ($request_parameter == '/?c=cqssc&a=yilou_chart'){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, "/tmp/cookiefile");
        curl_setopt($ch, CURLOPT_URL, SOURCE_DOMAIN.$request_parameter);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        $response = curl_exec($ch);
        curl_close($ch);
    }
    //遺漏值-開獎記錄
    elseif ($request_parameter == '/?c=cqssc&a=yilou_latest_show'){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, "/tmp/cookiefile");
        curl_setopt($ch, CURLOPT_URL, SOURCE_DOMAIN.$request_parameter);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        $response = curl_exec($ch);
        curl_close($ch);
    }
    else{
        $response = '';
    }*/

    echo $response;
}
//沒有傳入參數
else{
    die("No parameter passed !");
}
