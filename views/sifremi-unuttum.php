<?php
if(GirisYapti()){
    header('Location: index.php');
}else{
    echo '
<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" href="images/icon/favicon.ico" type="image/x-icon" />
    <title>dailyface-sifre-güncelle</title>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-4 bg-white border-right border-light">
                <div class="log-logo">
                    <div class=""><a href="index.php"><img src="images/logo/logom.png" class="logom"/></a></div>
                </div>
                <div class="log">
                    <div class="log-in">
                        <div class="log-in-baslik-div">
                        <a class="log-in-baslik">Şifre Sıfırlama İsteği Gönder</a></div>
                        <div class="log-in-form">
                                <form action="core/controller/passreset.php" method="POST" class="log-in-formm">
                                    <input required class="form-input" type="text" placeholder="Kullanıcı Adı" name="kadi"><br/>
                                    <input required class="form-input" type="email" placeholder="E-posta" name="eposta"><br/>
                                    <input name="passsubmit" class="form-button" type="submit" value="Sıfırlama İsteği Gönder">
                                </form>
                        </div>

                    </div>
                    <div class="sing-in">
                        <a class="sing-in-yazi" style="color:black;">Şifreni hatırladın mı? </a><a class="sing-link" href="index.php" style="color:#b40ef0;">Giriş Yap.</a>
                    </div>
                </div>
                <div class="log-footer">
                    <a class="log-footer-yazi">@2019 Tüm Hakları Saklıdır.<br>github.com/onurrsalmann/dailyface<br>Trakya Üniversitesi NYP Projesi</a>
                </div>
            </div>
            <div class="col-8"></div>
        </div>
    </div>
</body>
</html>
'; } ?>
