<?php
require '../init.php';
$p = isset($_GET["p"]) ? intval(trim($_GET["p"])) : 1;
    if($_POST){
      $yorum = $_POST["yorum"];
      $post_id = $_POST["post_id"];
      $yorumGonder = new Content();
      $yorumGonder->YorumEkle($yorum, $post_id, $p);
    }else{
        header('Location: ../../index.php');
    }
?>
