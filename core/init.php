<?php
    session_start();
    require_once 'database/connect.php';
    require_once 'class/users.php';
    require_once 'class/content.php';
    require_once 'class/profil.php';
    require_once 'class/search.php';
    require_once 'class/notification.php';

    function GirisYapti(){
        if(!empty($_SESSION['kadi']) || !empty($_SESSION['eposta'])){
            return true;
        }
        else{
            return false;
        }
    };
    function Alert($msg){
      echo "<script type='text/javascript'>alert('$msg');</script>";
    }
?>
