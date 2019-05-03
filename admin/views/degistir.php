<div id="degistir-div">
  <img style="width:20%;"src="image/logom.png">
  <h1 style="font-family:Arial;">Giriş Bilgilerini Güncelle</h1>
  <div id="degistir-form">
    <form action="core/controller/duzenle.php" method="POST">
        <input class="form-input" type="text" placeholder="Yeni kullanıcı adınız(isteğe bağlı)" name="kad"><br/>
        <input class="form-input" type="text" placeholder="Yeni şifreniz(isteğe bağlı)" name="sif"><br/>
        <input class="form-input" type="text" placeholder="Yeni epostanız(isteğe bağlı)" name="eposta"><br/>
        <input name="fotosubmit" class="form-button" type="submit" value="Güncelle">
    </form>
  </div>
  <div class="home-button" style="margin-top:5%;">
    <a href="index.php" class="home-button-text">Geri Dön</a>
  </div>
</div>
