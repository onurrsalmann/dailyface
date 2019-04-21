<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="shortcut icon" href="images/icon/favicon.ico" type="image/x-icon" />
    <title>dailyface</title>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<div class="container-fluid h-100">
    <div class="row h-100">
      <div style= "height: 100%;" class="col-1 border-right border-secondary">
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
      <div class="col-8" style="height:100%;">
        <div class="posts">
          <?php $goster = new Content();  $goster->Goster();?>
        </div>
      </div>
      <div class="col-3" style="height:100%;">
        <div class="search">
          <form action="views/search.php" method="GET" class="search-form">
              <button>
                  <img class="search-icon" src="images/icon/search.png" alt="Search Button">
                </button>
                &nbsp; &nbsp; <input required type="text" name="search" style="background: none; border:none; font-size: 120%;color:black;" placeholder="Ara">
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
            <?php $profil->Postlar($kadi,'views/','');?>
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
