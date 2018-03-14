<?php

####Copyright By Janu fb.com/lastducky####
####Thanks For Indra Swastika(fungsi.php)####
####Change This Copyright Doesn't Make You a Coder :) ####


require_once('func.php');
echo "Username?\nInput : ";
$username = trim(fgets(STDIN));
if (!file_exists("$username.ig")) {
    echo "Password?\nInput : ";
    $password = trim(fgets(STDIN));
    $log = masuk($username, $password);
    if ($log == "data berhasil diinput") {
        echo "Berhasil Input Data\n";
    } else {
        echo "Gagal Input Data\n";
    }
} else {
    $gip    = file_get_contents($username.'.ig');
    $gip    = json_decode($gip);
    $cekuki = instagram(1, $gip->useragent, 'feed/timeline/', $gip->cookies);
    $cekuki = json_decode($cekuki[1]);
    if ($cekuki->status != "ok") {
        $ulang = masuk($username, $password);
        if ($ulang != "data berhasil diinput") {
            echo "Cookie Telah Mati, Gagal Membuat Ulang Cookie\nSilahkan Ketik 'rm $username.ig' untuk membuat ulang cookie\n";
        } else {
            echo "Cookie Telah Mati, Sukses Membuat Ulang Cookie\n";
        }
    } else {
        echo "Type? (1 = Followers)\n Input : ";
        $type = trim(fgets(STDIN));
        if($type==1){
            $type = "followers";
        }else{
            $type = "following";
        }
        echo "Kamu Memilih type $type\n";
        echo "Target? (Tanpa @)\nInput : ";
        $target = trim(fgets(STDIN));
        echo "Ekse? (Ekse itu adalah brp kali kita eksekusi (follow orang) sebelum dijeda (120 detik), maksimal 10\nInput : ";
        $jeda = trim(fgets(STDIN));
        if($jeda>10) $jeda = 10;
        $data = file_get_contents($username.'.ig');
        $data = json_decode($data);
        
        $userid = instagram(1, $data->useragent, 'users/' . $target . '/usernameinfo', $data->cookies);
        $userid = json_decode($userid[1]);
        $userid = $userid->user->pk;
        
        if ($type == "followers") {
            $cekfoll = instagram(1, $data->useragent, 'friendships/' . $userid . '/followers/', $data->cookies);
            $cekfoll = json_decode($cekfoll[1]);
            $cekfoll = array_slice($cekfoll->users, 0, $jumlah);
            foreach ($cekfoll as $ids) {
                if(!file_exists('jedafft-'.$username)){ 
                     $no = 0;
                }else{
                     $no = file_get_contents('jedafft-'.$username);
                }
                if($no%$jeda==0 AND $no>0){
                     echo "Jeda 120 detik.\n";
                     $h=fopen("jedafft-".$username,"w");
                     fwrite($h,"0");
                     fclose($h);
                     sleep(120);
                }
                $follow = instagram(1, $data->useragent, 'friendships/create/' . $ids->pk . "/", $data->cookies, generateSignature('{"user_id":"' . $ids->pk . '"}'));
                $follow = json_decode($follow[1]);
                if($follow->status<>"fail"){
                     echo "Success Follow @" . $ids->username . "\n";
                     $h=fopen("jedafft-".$username,"w");
                     fwrite($h,$no+1);
                     fclose($h);
                     sleep(1);
                }else{
                     echo "Fail Follow @" . $ids->username . " (" . $status->message . ")\n";
                     $h=fopen("jedafft-".$username,"w");
                     fwrite($h,0);
                     fclose($h);
                     break;
                }
            }
        } else {
            $cekfoll = instagram(1, $data->useragent, 'friendships/' . $userid . '/following/', $data->cookies);
            $cekfoll = json_decode($cekfoll[1]);
            $cekfoll = array_slice($cekfoll->users, 0, $jumlah);
            foreach ($cekfoll as $ids) {
                $follow = instagram(1, $data->useragent, 'friendships/create/' . $ids->pk . "/", $data->cookies, generateSignature('{"user_id":"' . $ids->pk . '"}'));
                $follow = json_decode($follow[1]);
                if($follow->status<>"fail"){
                     echo "Success Follow @" . $ids->username . "\n";
                     $h=fopen("jedafft-".$username,"w");
                     fwrite($h,$no+1);
                     fclose($h);
                     sleep(1);
                }else{
                     echo "Fail Follow @" . $ids->username . " (" . $status->message . ")\n";
                     $h=fopen("jedafft-".$username,"w");
                     fwrite($h,0);
                     fclose($h);
                     break;
                }
            }
        }
    }
}
?>
