<?php
require '../init.php';
    if($_POST){
      $kad = $_POST["kad"];
      $sifre = $_POST["sif"];
      $eposta = $_POST["eposta"];
      $duzenle = new Admin();
      $duzenle->Duzenle($kad,$sifre,$eposta);
    }else{
        header('Location: ../../index.php');
    }
?>
