<?php
####Copyright By Janu fb.com/lastducky####
####Thanks For Indra Swastika(fungsi.php)####
####Change This Copyright Doesn't Make You a Coder :) ####
#######EDIT THIS AREA#########
#######END OF EDIT AREA########
require_once('func.php');
echo "Username?\nInput : ";
$username =  trim(fgets(STDIN));
if (!file_exists("$username.ig")) {
echo "Password?\nInput : ";
$password = trim(fgets(STDIN));
    $log = masuk($username, $password);
    if ($log == "data berhasil diinput") {
        echo "Berhasil Input Data, silahkan jalankan ulang\n";
    } else {
        echo "Gagal Input Data";
    }
} else {
    $gip    = file_get_contents($username.'.ig');
    $gip    = json_decode($gip);
    echo "Hai, $gip->username [".$gip->id."] Klik Enter Untuk Melanjutkan..";
    $skip = trim(fgets(STDIN));
    echo "Jeda Per Sesi?\nInput : ";
    $jeda = trim(fgets(STDIN));
    if($jeda<60){
        echo "Waktu telah diatur 60 detik, karena waktu yang ada masukan rentan terhadap keamanan akun.\n";
        $jeda = 60;
    }
    $cekuki = instagram(1, $gip->useragent, 'feed/timeline/', $gip->cookies);
    $cekuki = json_decode($cekuki[1]);
    if ($cekuki->status != "ok") {
        $ulang = masuk($gip->username, $gip->password);
        if ($ulang != "data berhasil diinput") {
            echo "Cookie Telah Mati, Gagal Membuat Ulang Cookie\n";
        } else {
            echo "Cookie Telah Mati, Sukses Membuat Ulang Cookie\n";
        }
    } else {
        
        $data = file_get_contents($gip->username.'.ig');
        $data = json_decode($data);
        
        $mid = instagram(1, $data->useragent, 'feed/timeline/', $data->cookies);
        $mid = json_decode($mid[1]);
       for($a=1;$a<31104000;$a++):
        foreach ($mid->items as $media) {
            $like = instagram(1, $data->useragent, 'media/' . $media->pk . '/like/', $data->cookies, generateSignature('{"media_id":"' . $media->pk . '"}'));
            $like = json_decode($like[1]);
            if($like->status<>"ok"){
            echo "Fail Like [" . $media->pk . "]\n";
                }else{
            echo "Success Like [" . $media->pk . "]\n";
            }
        }
        if($a%3==0){
            echo "Menunggu $jeda Detik Untuk Sesi Berikutnya.\n";
            sleep($jeda);
        }
       endfor;
    }
}
?>
