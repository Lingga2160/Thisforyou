<?php
$uniqueid = "2214ba4d".rand(12345678,99999999);
function send_otp($no){
	global $uniqueid;
	$no = "+".$no;
	$post = "{\"phone\":\"$no\"}";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://api.gojekapi.com/v4/customers/login_with_phone');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_POST, 1);
	$headers = array();
	$headers[] = 'X-Appversion: 3.25.2';
	$headers[] = 'X-Uniqueid: '.$uniqueid;
	$headers[] = 'X-Platform: Android';
	$headers[] = 'X-Appid: com.gojek.app';
	$headers[] = 'Accept: application/json';
	$headers[] = 'X-Session-Id: 62119d77-1201-4fca-b0b7-8a6845075a49';
	$headers[] = 'D1: F9:67:3D:96:9E:0B:A5:E3:3B:EA:F9:3B:48:1E:45:78:11:7C:4E:F3:C4:AF:81:82:B9:C1:09:F3:28:0E:C4:90';
	$headers[] = 'X-Phonemodel: Xiaomi,Redmi 5A';
	$headers[] = 'X-Pushtokentype: FCM';
	$headers[] = 'X-Deviceos: Android,5.1.1';
	$headers[] = 'User-Uuid: ';
	$headers[] = 'X-Devicetoken: ';
	$headers[] = 'Authorization: Bearer';
	$headers[] = 'Accept-Language: en-ID';
	$headers[] = 'X-User-Locale: en_ID';
	$headers[] = 'Content-Type: application/json; charset=UTF-8';
	$headers[] = 'Content-Length: '.strlen($post);
	$headers[] = 'Host: api.gojekapi.com';
	$headers[] = 'Connection: close';
	
	$headers[] = 'User-Agent: okhttp/3.12.1';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = json_decode(curl_exec($ch),true)['data']['login_token'];
	curl_close ($ch);
	return $result;
}
function verify_otp($otp,$token){
	global $uniqueid;
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://api.gojekapi.com/v4/customers/login/verify');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"client_name\":\"gojek:cons:android\",\"client_secret\":\"83415d06-ec4e-11e6-a41b-6c40088ab51e\",\"data\":{\"otp\":\"$otp\",\"otp_token\":\"$token\"},\"grant_type\":\"otp\",\"scopes\":\"gojek:customer:transaction gojek:customer:readonly\"}");
	curl_setopt($ch, CURLOPT_POST, 1);

	$headers = array();
	$headers[] = 'X-Appversion: 3.25.2';
	$headers[] = 'X-Uniqueid: '.$uniqueid;
	$headers[] = 'X-Platform: Android';
	$headers[] = 'X-Appid: com.gojek.app';
	$headers[] = 'Accept: application/json';
	$headers[] = 'X-Session-Id: 62119d77-1201-4fca-b0b7-8a6845075a49';
	$headers[] = 'D1: F9:67:3D:96:9E:0B:A5:E3:3B:EA:F9:3B:48:1E:45:78:11:7C:4E:F3:C4:AF:81:82:B9:C1:09:F3:28:0E:C4:90';
	$headers[] = 'X-Phonemodel: Xiaomi,Redmi 5A';
	$headers[] = 'X-Pushtokentype: FCM';
	$headers[] = 'X-Deviceos: Android,5.1.1';
	$headers[] = 'User-Uuid: ';
	$headers[] = 'X-Devicetoken: ';
	$headers[] = 'Authorization: Bearer';
	$headers[] = 'Accept-Language: en-ID';
	$headers[] = 'X-User-Locale: en_ID';
	$headers[] = 'Content-Type: application/json; charset=UTF-8';
	$headers[] = 'Content-Length: 245';
	$headers[] = 'Host: api.gojekapi.com';
	$headers[] = 'Connection: close';
	
	$headers[] = 'User-Agent: okhttp/3.12.1';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = json_decode(curl_exec($ch), true)['data']['access_token'];
	curl_close ($ch);
	return $result;
}
function make_payment($acttoken){
	global $uniqueid;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://api.gojekapi.com/bills-bff/v1/inquiry');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"billerTag\":\"GOO_WALLET\",\"productTag\":\"GOO_500K\"}");
	curl_setopt($ch, CURLOPT_POST, 1);
	$headers = array();
	$headers[] = 'X-Appversion: 3.25.2';
	$headers[] = 'X-Uniqueid: '.$uniqueid;
	$headers[] = 'X-Platform: Android';
	$headers[] = 'X-Appid: com.gojek.app';
	$headers[] = 'Accept: application/json';
	$headers[] = 'X-Session-Id: 62119d77-1201-4fca-b0b7-8a6845075a49';
	$headers[] = 'D1: F9:67:3D:96:9E:0B:A5:E3:3B:EA:F9:3B:48:1E:45:78:11:7C:4E:F3:C4:AF:81:82:B9:C1:09:F3:28:0E:C4:90';
	$headers[] = 'X-Phonemodel: Xiaomi,Redmi 5A';
	$headers[] = 'X-Pushtokentype: FCM';
	$headers[] = 'X-Deviceos: Android,5.1.1';
	$headers[] = 'User-Uuid: 626320735';
	$headers[] = 'X-Devicetoken: eNB6f-zQEkw:APA91bHEBDw3Orh-0PWFNcQ9fCuO_u2VQKjnkpajANidgTvfsi9MXJoVtVGUqzmjZe8cds95DcTDY_pNnY3wda_eVCfvvc4oaRcTBhMJ54Xtkcr0FuvxtU_wEWKv42OuXYtF-2JDJyjs';
	$headers[] = 'Authorization: Bearer '.$acttoken;
	$headers[] = 'Accept-Language: en-ID';
	$headers[] = 'X-User-Locale: en_ID';
	$headers[] = 'X-Location: 0,0';
	$headers[] = 'X-Location-Accuracy: 3.9';
	$headers[] = 'Content-Type: application/json; charset=UTF-8';
	$headers[] = 'Content-Length: 50';
	$headers[] = 'Host: api.gojekapi.com';
	$headers[] = 'Connection: close';
	
	$headers[] = 'User-Agent: okhttp/3.12.1';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = json_decode(curl_exec($ch),true)['data']['id'];
	curl_close ($ch);
	return $result;
}
function buy_pay($acttoken,$inqid,$pin){
	global $uniqueid;
	$body = "{\"inquiryId\":\"$inqid\",\"pin\":\"$pin\",\"productTag\":\"GOO_500K\",\"requestId\":\"34f11b83-5faf-4e06-9b03-a492c69c5aab\"}";
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://api.gojekapi.com/gobills/v3/payment');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	curl_setopt($ch, CURLOPT_POST, 1);

	$headers = array();
	$headers[] = 'X-Appversion: 3.25.2';
	$headers[] = 'X-Uniqueid: '.$uniqueid;
	$headers[] = 'X-Platform: Android';
	$headers[] = 'X-Appid: com.gojek.app';
	$headers[] = 'Accept: application/json';
	$headers[] = 'X-Session-Id: 62119d77-1201-4fca-b0b7-8a6845075a49';
	$headers[] = 'D1: F9:67:3D:96:9E:0B:A5:E3:3B:EA:F9:3B:48:1E:45:78:11:7C:4E:F3:C4:AF:81:82:B9:C1:09:F3:28:0E:C4:90';
	$headers[] = 'X-Phonemodel: Xiaomi,Redmi 5A';
	$headers[] = 'X-Pushtokentype: FCM';
	$headers[] = 'X-Deviceos: Android,5.1.1';
	$headers[] = 'User-Uuid: 626320735';
	$headers[] = 'X-Devicetoken: eNB6f-zQEkw:APA91bHEBDw3Orh-0PWFNcQ9fCuO_u2VQKjnkpajANidgTvfsi9MXJoVtVGUqzmjZe8cds95DcTDY_pNnY3wda_eVCfvvc4oaRcTBhMJ54Xtkcr0FuvxtU_wEWKv42OuXYtF-2JDJyjs';
	$headers[] = 'Authorization: Bearer '.$acttoken;
	$headers[] = 'Accept-Language: en-ID';
	$headers[] = 'X-User-Locale: en_ID';
	$headers[] = 'X-Location: 0,0';
	$headers[] = 'X-Location-Accuracy: 3.9';
	$headers[] = 'Content-Type: application/json; charset=UTF-8';
	$headers[] = 'Content-Length: '.strlen($body);
	$headers[] = 'Host: api.gojekapi.com';
	$headers[] = 'Connection: close';
	
	$headers[] = 'User-Agent: okhttp/3.12.1';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = json_decode(curl_exec($ch),true);
	curl_close ($ch);
	return $result;
}
function get_gpc($acttoken){
	global $uniqueid;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://api.gojekapi.com/gobills/v3/history?pageNumber=1&pageSize=20');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	$headers = array();
	$headers[] = 'X-Appversion: 3.25.2';
	$headers[] = 'X-Uniqueid: '.$uniqueid;
	$headers[] = 'X-Platform: Android';
	$headers[] = 'X-Appid: com.gojek.app';
	$headers[] = 'Accept: application/json';
	$headers[] = 'Content-Type: application/json';
	$headers[] = 'X-Session-Id: 62119d77-1201-4fca-b0b7-8a6845075a49';
	$headers[] = 'D1: F9:67:3D:96:9E:0B:A5:E3:3B:EA:F9:3B:48:1E:45:78:11:7C:4E:F3:C4:AF:81:82:B9:C1:09:F3:28:0E:C4:90';
	$headers[] = 'X-Phonemodel: Xiaomi,Redmi 5A';
	$headers[] = 'X-Pushtokentype: FCM';
	$headers[] = 'X-Deviceos: Android,5.1.1';
	$headers[] = 'User-Uuid: 626320735';
	$headers[] = 'X-Devicetoken: eNB6f-zQEkw:APA91bHEBDw3Orh-0PWFNcQ9fCuO_u2VQKjnkpajANidgTvfsi9MXJoVtVGUqzmjZe8cds95DcTDY_pNnY3wda_eVCfvvc4oaRcTBhMJ54Xtkcr0FuvxtU_wEWKv42OuXYtF-2JDJyjs';
	$headers[] = 'Authorization: Bearer '.$acttoken;
	$headers[] = 'Accept-Language: en-ID';
	$headers[] = 'X-User-Locale: en_ID';
	$headers[] = 'X-Location: 0,0';
	$headers[] = 'X-Location-Accuracy: 3.9';
	$headers[] = 'Host: api.gojekapi.com';
	$headers[] = 'Connection: close';
	
	$headers[] = 'User-Agent: okhttp/3.12.1';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = json_decode(curl_exec($ch),true)['data']['bills'][0]['context']['redemptionAccountNumber'];
	curl_close ($ch);
	return "This Your Code : $result";
}
function get(){
	return trim(fgets(STDIN));
}
echo "Number		";
$no = get();
$send = send_otp($no);
echo "OtpNum		";
$otp = get();
$acttoken = verify_otp($otp,$send);
$make = make_payment($acttoken);
echo "PinNum		";
$pin = get();
$buy = buy_pay($acttoken,$make,$pin);
print_r($buy);
sleep(3);
$gpc = get_gpc($acttoken);
echo "\nKode : $gpc\n\n";
