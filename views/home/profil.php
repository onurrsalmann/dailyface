<?php $os = $_GET["os"];  $profil = new Profil(); $kadi = $_SESSION["kadi"];
$p = isset($_GET["p"]) ? intval(trim($_GET["p"])) : 0; $pp = $profil->ProfilVeriCek($os,'pp');?>
      <div class="col-8" style="height:100%;">
        <div class="os-profil">
          <div id="os-profil-aciklama">
            <img class="os-profil-pp" src="fotograflar/pp/<?php echo $pp; ?>"><div id= "os-profil-bilgi">
            <a class="profil-bilgi-baslik">Ad: </a><a class="profil-bilgi-icerik"> <?php echo $profil->ProfilVeriCek($os,'adi'); ?></a></br>
            <a class="profil-bilgi-baslik">Kullanıcı Adı:</a><a class="profil-bilgi-icerik"> @<?php echo $profil->ProfilVeriCek($os,'kadi'); ?></a></br>
            <a class="profil-bilgi-baslik">E-posta:</a><a class="profil-bilgi-icerik"><?php echo $profil->ProfilVeriCek($os,'eposta'); ?></a></div>
          </div>
          <div id="os-profil-post">
            <?php
            if($p == 0){
              $profil->Postlar($os,'','');
            }else if($p != 0){
              $profil->PostGoster($p,$pp);
            }
            ?>
          </div>
        </div>
      </div>
