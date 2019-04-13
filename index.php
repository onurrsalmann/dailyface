<?php
include_once 'core/init.php';
$s = isset($_GET["s"]) ? intval(trim($_GET["s"])) : 1;
if(GirisYapti()){
  if($s ==1){
    include 'views/home-index.php';
  }else if($s ==2){
    include 'views/notification.php';
  }else if($s ==3){
    include 'views/icerik-ekle.php';
  }else if($s == 4){
    include 'views/profilduzenle.php';
  }else if($s == 5){
    include 'views/search.php';
  }
}else{
    header('Location: views/log-in.php');
}
?>
