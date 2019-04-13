<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
    <title>dailyface</title>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<div class="container-fluid h-100">
    <div class="row h-100">
      <div class="col-1 border-right border-secondary">
        <div class="logo-blok">
            <div class="logo-bolum">
                <a href="index.php" ><img src="images/logo/logo2.png" class="logo"/></a><br></div>
            <a href="index.php" class="logo-yazi">dailyface</a>
        </div>
        <div class="sayfalar-blok" >
            <div class="menu-bolum"><a href="?s=1" ><img src="images/icon/home.png" class="menu-icon"/></a></div>
            <div class="menu-bolum"><a href="?s=2"><img src="images/icon/nf.png" class="menu-icon"/></a><br></div>
            <div class="menu-bolum"><a href="?s=3"><img src="images/icon/foto-ekle.png" class="menu-icon"/></a></div>
        </div>
        <div class="logout-blok">
          <a href="core/controller/logout.php"><img src="images/icon/logout.png" class="menu-icon"/></a>
        </div>
      </div>
      <div class="col-8">
        <div class="foto-ekleme-kismi">
          <br/>
          <h2>Profil Düzenle</h2>
          <form action="core/controller/profil-duzenle.php" method="POST" enctype="multipart/form-data" class="foto-form">
              <input class="form-input" type="file" name="pp">
              <input class="form-input" type="text" placeholder="Yeni adınız:" name="ad"><br/>
              <input class="form-input" type="text" placeholder="Yeni kullanıcı adınız(isteğe bağlı)" name="kad"><br/>
              <input class="form-input" type="text" placeholder="Yeni şifreniz(isteğe bağlı)" name="sif"><br/>
              <input class="form-input" type="text" placeholder="Yeni epostanız(isteğe bağlı)" name="eposta"><br/>
              <input name="fotosubmit" class="form-button" type="submit" value="Güncelle">
          </form>
        </div>
      </div>
      <div class="col-3">
        <div class="search">
          <form class="search-form">
              <button onclick="JavaScript:alert('You will love this book!')">
                  <img class="search-icon" src="images/icon/search.png" alt="Read book">
                </button>
                &nbsp; &nbsp; <input type="search" name="search" style="background: none; border:none; font-size: 120%;color:black;" placeholder="Ara">
          </form>
        </div>
        <div class="profil">
          <?php $kadi = $_SESSION["kadi"]; $profil = new Profil();?>
          <div class="baslik" style="padding:3%;">
            <a style="font-size: 150%;">Profil</a>
          </div>
          <div class="profil-bilgi">
            <img class="profil-pp" src="fotograflar/pp/<?php echo $profil->ProfilVeriCek($kadi,'pp'); ?>">
            <a class="profil-bilgi-baslik">Ad: </a><a class="profil-bilgi-icerik"> <?php echo $profil->ProfilVeriCek($kadi,'adi'); ?></a></br>
            <a class="profil-bilgi-baslik">Kullanıcı Adı:</a><a class="profil-bilgi-icerik"> @<?php echo $profil->ProfilVeriCek($kadi,'kadi'); ?></a></br>
            <a class="profil-bilgi-baslik">E-posta:</a><a class="profil-bilgi-icerik"><?php echo $profil->ProfilVeriCek($kadi,'eposta'); ?></a>
          </div>
          <div class="profil-post">
            <?php $profil->Postlar($kadi);?>
          </div>
          <div class="profil-ayarlar">
            <a href="?s=4">Profili Düzenle</a>
          </div>

        </div>
      </div>
    </div>
  </div>


  </body>
</html>