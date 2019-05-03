<?php
include_once 'core/init.php';
$s = isset($_GET["s"]) ? intval(trim($_GET["s"])) : 1;
$g = isset($_GET["g"]) ? intval(trim($_GET["g"])) : 1;
$p = isset($_GET["p"]) ? intval(trim($_GET["p"])) : 1;
$error = isset($_GET["error"]) ? intval(trim($_GET["error"])) : 0;
if(GirisYapti()){
  include 'views/home/navigation.php';
  if($s ==1){
    include 'views/home/home-index.php';
  }else if($s ==2){
    include 'views/home/notification.php';
  }else if($s ==3){
    include 'views/home/icerik-ekle.php';
  }else if($s == 4){
    include 'views/home/profilduzenle.php';
  }else if($s == 5){
    include 'views/home/search.php';
  }else if($s == 6){
    include 'views/home/profil.php';
  }
  include 'views/home/footer.php';
}else{
  if($g ==1){
    include 'views/welcome/log-in.php';
  }else if($g ==2){
    include 'views/welcome/sign-in.php';
  }else if($g ==3){
    include 'views/welcome/sifremi-unuttum.php';
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
  Alert("Silinemedi. Tekrar deneyin..");
}
else if($error == 8){
  Alert("Format sadece jpeg,png,jpg olmalıdır.");
}
?>
