<?php
    session_start();
    require_once 'database/connect.php';
    require_once 'class/users.php';
    require_once 'class/content.php';
    require_once 'class/profil.php';

    function GirisYapti(){
        if(!empty($_SESSION['kadi']) || !empty($_SESSION['eposta'])){
            return true;
        }
        else{
            return false;
        }
    }
?>
