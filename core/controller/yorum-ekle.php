<?php
require '../init.php';

    if($_POST){
      $yorum = $_POST["yorum"];
      $post_id = $_POST["post_id"];
      $yorumGonder = new Content();
      $yorumGonder->YorumEkle($yorum, $post_id);
    }else{
        header('Location: ../../index.php');
    }
?>
