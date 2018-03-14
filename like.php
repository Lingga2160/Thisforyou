<?php
function autolike($link, $jml){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://sandromau.tk/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"nohp=".$link."&jml=".$jml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_REFERER, 'http://sandromau.tk/');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36');
        $server_output = curl_exec ($ch);
        curl_close ($ch);
		echo "SUKSES & Follow @yaelahngga_";
        flush();
		
    }
	
print "Auto Like IG SGB TEAM & Thx To Sandro Putra\n";
print "https://fb.me/anggaid157\n\n\n";

echo "Link Foto lu (ex : https://www.instagram.com/p/Be7xfXBFA4m/?taken-by=yaelahngga_)\nInput : ";
$link = trim(fgets(STDIN));
echo "Jumlah Like\nInput : ";
$jml = trim(fgets(STDIN));
$execute = autolike($link, $jml);
print $execute;
?>