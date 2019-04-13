<?php 
require '../init.php';
    if(isset($_POST['passsubmit'])){
        @$kadi = trim(strip_tags($_POST['kadi']));
        @$eposta = trim(strip_tags($_POST['eposta']));
    
        $login = new Users();
        $login->PassResetMail($eposta);
    }else{
        echo 'hata';
    }
?>