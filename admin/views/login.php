<div id="login-div">
  <img style="width:20%;"src="image/logom.png">
  <h1 style="font-family:Arial;">Admin Girişi</h1>
  <div id="login-form">
    <form action="core/controller/login.php" method="POST" class="log-in-formm">
      <input required class="form-input" type="text" placeholder="Kullanıcı Adı veya Eposta" name="kadi" style="margin-top:2%;"><br/>
      <input required class="form-input"  type="password" placeholder="Şifre" name="sifre"><br>
      <input class="form-button" type="submit" name="loginsubmit" value="Giriş Yap">
    </form>
  </br><a>Varsayılan kullanıcı adı: root sifre: admin</a>
  <div class="home-button" style="width:80%; margin-top:10%;">
    <a href="../index.php" class="home-button-text">Admin Girişinden Çık</a>
  </div>
  </div>
</div>
