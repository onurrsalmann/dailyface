<?php
require '../init.php';

    if($_POST){
      $yorum_id = $_POST["yorum_id"];
      $yorumSil = new Content();
      $yorumSil->YorumSil($yorum_id);
    }else{
        header('Location: ../../index.php');
    }
?>
