<?php
class Admin{
    private $db;

    public function __construct(){
        $this->db = new Connection();
        $this->db = $this->db->dbConnect();
        $this->db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
    }
    public function EpostaUserVeri($eposta,$istedigin_veri){
      $pp = $this->db->prepare("SELECT * FROM admin WHERE eposta=?");
      $pp->execute(array($eposta));
      $pp_r = $pp->fetch(PDO::FETCH_ASSOC);
      return $pp_r["$istedigin_veri"];
    }
    public function Login($kadi, $sifre){
        $gy = $this->db->prepare("select * from admin where kadi=? and sifre=?");
        $gy->bindParam(1, $kadi);
        $gy->bindParam(2, $sifre);
        $gy->execute();

        if($gy->rowCount() == 1){
            $_SESSION['admin-kadi']=$kadi;
            header('Location: ../../index.php');
        }else{
            $gy = $this->db->prepare("select * from admin where eposta=? and sifre=?");
            $gy->bindParam(1, $kadi);
            $gy->bindParam(2, $sifre);
            $gy->execute();

            if($gy->rowCount() == 1){
                $_SESSION['admin-email']=$kadi;
                $_SESSION['admin-kadi']=$this->EpostaUserVeri($_SESSION['email'],'kadi');
                header('Location: ../../index.php');
            }else{
                header('Location: ../../index.php?error=1');
            }
        }
    }
    public function Duzenle($kadi,$sifre,$eposta){
        if(empty($kadi)){
          $kadi = $_SESSION['admin-kadi'];
        }
        if(empty($sifre)){
          $pp = $this->db->prepare("SELECT * FROM admin WHERE kadi=?");
          $pp->execute(array($_SESSION['admin-kadi']));
          $pp_r = $pp->fetch(PDO::FETCH_ASSOC);
          $sifre = $pp_r['sifre'];
        }
        if(empty($eposta)){
          $pp = $this->db->prepare("SELECT * FROM admin WHERE kadi=?");
          $pp->execute(array($_SESSION['admin-kadi']));
          $pp_r = $pp->fetch(PDO::FETCH_ASSOC);
          $eposta = $pp_r['eposta'];
        }
              $ekle = $this->db->prepare("UPDATE admin SET kadi= ?, sifre= ?, eposta=? WHERE kadi=? ");
              $ekle->bindParam(1, $kadi, PDO::PARAM_STR);
              $ekle->bindParam(2, $sifre, PDO::PARAM_STR);
              $ekle->bindParam(3, $eposta, PDO::PARAM_STR);
              $ekle->bindParam(4, $_SESSION["admin-kadi"], PDO::PARAM_STR);
              $ekle->execute();
              if($ekle){
                $_SESSION['admin-kadi'] = $kadi;
                header('Location: ../../index.php');
              }else{
                header('Location: ../../index.php?s=3&error=2');
              }

    }
    public function Logout(){
        session_destroy();
        header('Location: ../../index.php');
    }
}
?>
