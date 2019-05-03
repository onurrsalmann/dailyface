<?php
require '../init.php';
$p = isset($_GET["p"]) ? intval(trim($_GET["p"])) : 1;
    if($_POST){
      $yorum_id = $_POST["yorum_id"];
      $yorumSil = new Content();
      $yorumSil->YorumSil($yorum_id,$p);
    }else{
        header('Location: ../../index.php');
    }
?>
