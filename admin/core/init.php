<?php
session_start();
require_once 'database/connect.php';
require_once 'class/admin.php';
require_once 'class/users.php';
require_once 'class/yedekle.php';
function GirisYapti(){
    if(!empty($_SESSION['admin-kadi']) || !empty($_SESSION['admin-eposta'])){
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
