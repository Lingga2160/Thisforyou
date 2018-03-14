<?php
echo "List Tools :\n[1]Unfollow Not Followback Instagram\n[2]Like Timeline Instagram\n[3]Bomb Sms Tri\n[4]Bomb Sms Tsel\nMasukan Pilihanmu (1-4) : ";
$pilih = trim(fgets(STDIN));
if($pilih>4 OR $pilih<1){
    echo "Pilihan Tidak ada, silahkan pilih yang ada!\nMasukan Pilihanmu : ";
    $pilih = trim(fgets(STDIN));
    if($pilih>4 OR $pilih<1) $type = "fuck";
}
if($pilih==1){
    $type = "unfoll";
    $n = "Unfollow Not Followback Instagram";
}elseif($pilih==2){
    $type = "liketl";
    $n = "Like Timeline Instagram";
}elseif($pilih==3){
    $type = "bomb3";
    $n = "Bomb Sms Tri";
}elseif($pilih==4){
    $type = "bombtsel";
    $n = "Bomb Sms Tsel";
}
if($type=="fuck"){
    echo "Kamu Tidak Memilih Tools Manapun.\n";
}else{
    echo "Kamu Telah Memilih Tools $n , Silahkan Tekan Enter untuk Melanjutkan..";
    $lanjut = trim(fgets(STDIN));
    require_once($type.".php");
}
