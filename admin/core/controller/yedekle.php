<?php
require '../init.php';
$db = new Yedekle(array(
	'driver' => 'mysql',
	'host' => 'localhost',
	'user' => 'root',
	'password' => '',
	'database' => 'df'
));
$backup = $db->backup();
if(!$backup['error']){
	$fp = fopen('../yedekler/file.sql', 'w+');fwrite($fp, $backup['msg']);fclose($fp);
	header('Location: ../../index.php?error=3');
} else {
	Alert("Hata Oluştu");
}
?>
