<?php
require '../init.php';
    if(isset($_POST['loginsubmit'])){
        @$kadi = trim(strip_tags($_POST['kadi']));
        @$sifre = trim(strip_tags($_POST['sifre']));

        $login = new Admin();
        $login->Login($kadi, $sifre);
    }else{
        echo 'hata';
    }
?>
