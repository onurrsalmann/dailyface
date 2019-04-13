<?php
require '../init.php';

    if($_POST){
      $post_id= $_POST["postsil"];
      $postSil = new Content();
      $postSil->Sil($post_id);
    }else{
        header('Location: ../../index.php');
    }
?>
