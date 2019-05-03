<?php
require '../init.php';
$p = isset($_GET["p"]) ? intval(trim($_GET["p"])) : 1;
    if($_POST){
      $post_id = $_POST["post_id"];
      $begen = new Content();
      $begen->Begen($post_id,$p);
    }else{
        header('Location: ../../index.php');
    }
?>
