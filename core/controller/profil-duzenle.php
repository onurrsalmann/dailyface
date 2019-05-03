<?php
require '../init.php';

    if($_POST){
      $ad = $_POST["ad"];
      $kad = $_POST["kad"];
      $sifre = $_POST["sif"];
      $eposta = $_POST["eposta"];
      $duzenle= new Profil();
      $duzenle->Duzenle($ad,$kad,$sifre,$eposta);
    }else{
        header('Location: ../../index.php');
    }
?>
