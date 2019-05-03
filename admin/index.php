<?php
include_once 'core/init.php';
$s = isset($_GET["s"]) ? intval(trim($_GET["s"])) : 1;
$error = isset($_GET["error"]) ? intval(trim($_GET["error"])) : 0;
include 'views/header.php';
if(GirisYapti()){
  if($s ==1){
    include 'views/home.php';
  }else if($s ==2){
    include 'views/uyegoster.php';
  }else if($s ==3){
    include 'views/degistir.php';
  }
}else{
  include 'views/login.php';
}
include 'views/footer.php';
if($error == 1){
  Alert("Kullanıcı adı ve ya şifre yanlış!!");
}else if($error == 2){
  Alert("Bilgiler Güncellenemedi!!");
}else if($error == 3){
  Alert("SQL dosyanız Core altındaki Yedekler klasorüne kaydedildi.");
}
?>
