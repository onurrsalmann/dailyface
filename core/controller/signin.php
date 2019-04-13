<?php
require '../init.php';
    if(isset($_POST['signsubmit'])){
        $eposta = trim(strip_tags($_POST['eposta']));
        $kadi = trim(strip_tags($_POST['kadi']));
        $sifre = trim(strip_tags($_POST['sifre']));
        $k_token     = uniqid($kadi,true);
        
        $signin = new Users();
        $signin->Signin($kadi, $sifre, $eposta,$k_token);
    }else{
        echo 'hata';
    }
?>
