<?php 
require '../core/init.php';
if(isset($_GET['token']) == "token"){
		// Gelen Token Linki
		$token = $_GET['token'];
		echo'<form action="" method="post">
		<table class="panel">
			<tr>
				<td>Yeni Şifreniz</td>
				<td>:</td>
				<td><input type="password" style="width:300px;height:25px" name="sifre" placeholder="Yeni Şifrenizi Giriniz..." /></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><input type="submit" value="Şifreyi Güncelle" /></td>
			</tr>
		</table>
		</form>';
		
		// Eşlesen Token değeri ile Şifreyi Değiştir.
		if($_POST){
			$sifre = $_POST['sifre'];//buraya md5 tagı ekle
			$reset = new Users();
            $reset->PassReset($sifre, $token);
		}
	}else{
			header("Location:index.php");
    }
?>