<?php
class Users{
    private $db;

    public function __construct(){
        $this->db = new Connection();
        $this->db = $this->db->dbConnect();
        $this->db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
    }
    public function EpostaUserVeri($eposta,$istedigin_veri){
      $pp = $this->db->prepare("SELECT * FROM users WHERE eposta=?");
      $pp->execute(array($eposta));
      $pp_r = $pp->fetch(PDO::FETCH_ASSOC);
      return $pp_r["$istedigin_veri"];
    }
    public function Login($kadi, $sifre){
        $gy = $this->db->prepare("select * from users where kadi=? and sifre=?");
        $gy->bindParam(1, $kadi);
        $gy->bindParam(2, $sifre);
        $gy->execute();

        if($gy->rowCount() == 1){
            $_SESSION['kadi']=$kadi;
            header('Location: ../../index.php');
        }else{
            $gy = $this->db->prepare("select * from users where eposta=? and sifre=?");
            $gy->bindParam(1, $kadi);
            $gy->bindParam(2, $sifre);
            $gy->execute();

            if($gy->rowCount() == 1){
                $_SESSION['email']=$kadi;
                $_SESSION['kadi']=$this->EpostaUserVeri($_SESSION['email'],'kadi');

                header('Location: ../../index.php');
            }else{
                header('Location: ../../index.php?error=1');
            }
        }
    }

    public function Signin($kadi, $sifre, $eposta,$adi, $k_token){
        $ko = $this->db->prepare("SELECT (kadi) FROM users WHERE kadi = :kadi");
            $ko->execute(array("kadi" => $kadi));
            if($ko->rowCount() > 0)
            { header('Location: ../../index.php?g=2&error=2'); }
            else{
                if (preg_match('/[^A-Za-z0-9-_]/i', $kadi)) { header('Location: ../../index.php?g=2&error=3');}
                else{
                    $a = $this->db->prepare("INSERT INTO users(eposta, kadi, sifre, adi, token) VALUES ( ?, ?, ?, ?, ?)");
                    $a->bindParam(1, $eposta, PDO::PARAM_STR);
                    $a->bindParam(2, $kadi, PDO::PARAM_STR);
                    $a->bindParam(3, $sifre, PDO::PARAM_STR);
                    $a->bindParam(4, $adi, PDO::PARAM_STR);
                    $a->bindParam(5, $k_token, PDO::PARAM_STR);
                    $a->execute();
                    if ($a) {  $login = new Users();
                        $login->Login($kadi, $sifre);
                    }
                    else { header('Location: ../../index.php?g=2&error=4'); }
                }
            }
    }
    public function PassResetMail($eposta){
		$bul = $this->db->query('SELECT * FROM users WHERE eposta="'.$eposta.'"');
		$bul = $bul->fetch(PDO::FETCH_ASSOC);
		if($bul){
			$token =  $bul['token'];
			// Şifre Sıfırlama Link Mail Gönderme ;
			include 'phpmailer.php';
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
			$mail->Username = 'dailyface2019@gmail.com'; // G-Mail Adresi
			$mail->Password = 'DailyFace2019';  // G-Mail Şifresi
			$mail->SetFrom($mail->Username, 'DailyFace.com'); // Sitenizin Adı
			$mail->AddAddress($eposta);
			$mail->CharSet = 'UTF-8';
			$mail->Subject = 'Şifre Sıfırlama'; // Mail Başlığı
			$content = '<div style="background: #eee; padding: 10px; font-size: 14px">
			Merhabalar ! <br />
			DailyFace.com sitesinin size özel şifre sıfırlama linki aşağıdadır.Aşağıda ki linke tıklayarak şifrenizi sıfırlayabilirsiniz.<br />
			<a href="http://localhost/df/views/sifirla.php?token='.$token.'">Şifrenizi Sıfırlayın</a>
			</div>';
			$mail->MsgHTML($content);
			if($mail->Send()) {
				// e-posta başarılı ile gönderildi
				echo '<div style="padding:10px 10px 10px 10px;border-top:1px solid #ddd;line-height:23px">E-posta başarıyla gönderildi, lütfen kontrol edin.</div>';
				header("Refresh:2;url=../../index.php");
			} else {
				// bir sorun var, sorunu ekrana bastıralım
				echo '<div style="padding:10px 10px 10px 10px;border-top:1px solid #ddd;line-height:23px">'.$mail->ErrorInfo.'</div>';
				header("Refresh:1;url=../../index.php");
			}
		}else{
			header('Location: ../../index.php?g=3&error=5');
		}
    }
    public function PassReset($sifre, $token){
        $update = $this->db->exec("UPDATE users set sifre = '$sifre' where token = '$token' ");
			if($update){
				echo '<div style="padding:10px 10px 10px 10px;border-top:1px solid #ddd;line-height:23px">
				<strong>Tebrikler !</strong> <br />
				Şifreniz Güncellendi. Yönlendiriliyorsunuz . . .
				</div>';
				header("Refresh:2;url=../index.php");
			}else{
				echo '<div style="padding:10px 10px 10px 10px;border-top:1px solid #ddd;line-height:23px">
				Hata ! <br />
				Lütfen Daha Sonra Tekrar Deneyiniz. Yönlendiriliyorsunuz . . .
				</div>';
				header("Refresh:2;url=../index.php");
			}
    }
    public function Logout(){
        session_destroy();
        header('Location: ../../index.php');
    }
}

?>
