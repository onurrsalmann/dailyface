<?php
include_once 'core/init.php';
$s = isset($_GET["s"]) ? intval(trim($_GET["s"])) : 1;
$g = isset($_GET["g"]) ? intval(trim($_GET["g"])) : 1;
$error = isset($_GET["error"]) ? intval(trim($_GET["error"])) : 0;
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
  if($g ==1){
    include 'views/log-in.php';
  }else if($g ==2){
    include 'views/sign-in.php';
  }else if($g ==3){
    include 'views/sifremi-unuttum.php';
  }
}
if($error == 1){
  Alert("Kullanıcı adı ve ya şifre yanlış!!");
}
else if($error == 2){
  Alert("Bu kullanıcı adı kullanılıyor!!");
}
else if($error == 3){
  Alert("Bu kullanıcı adı izin verilmeyen karakterler içeriyor!!");
}
else if($error == 4){
  Alert("Bir hata oluştu. Lütfen tekrar deneyiniz..");
}
else if($error == 5){
  Alert("Bu eposta sistemde bulunmuyor");
}
else if($error == 6){
  Alert("Dosya Boyunu Aşıldı(en fazla 7mb)");
}
else if($error == 7){
  Alert("Bir hata oluştu. Tekrar deneyin..");
}
else if($error == 8){
  Alert("Format sadece jpeg,png,jpg olmalıdır.");
}
?>
