<?php
require '../init.php';

    if($_POST){
      $aciklama = $_POST["aciklama"];
      $postGonder = new Content();
      $postGonder->Ekle($aciklama);
    }else{
        header('Location: ../../index.php');
    }
?>
