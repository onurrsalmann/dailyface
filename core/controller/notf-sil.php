<?php
require '../init.php';

    if($_POST){
      $id= $_POST["notfsil"];
      $notfSil = new Notf();
      $notfSil->Okundu($id);
    }else{
        header('Location: ../../index.php');
    }
?>
