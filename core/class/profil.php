<?php
class Profil{
  private $db;

  public function __construct(){
      $this->db = new Connection();
      $this->db = $this->db->dbConnect();
      $this->db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
  }
  public function ProfilVeriCek($kadi,$istedigin){
    $pp = $this->db->prepare("SELECT * FROM users WHERE kadi=?");
    $pp->execute(array($kadi));
    $pp_r = $pp->fetch(PDO::FETCH_ASSOC);
    return $pp_r["$istedigin"];
  }
  public function Postlar($kadi){
    $query = $this->db->query("SELECT * FROM post WHERE post_sahip='$kadi'", PDO::FETCH_ASSOC);
     foreach( $query as $row ){
        echo '<div class="profil-post-kalip"><img src= "fotograflar/post/'.$row["post_adi"].'" class="profil-post-image" alt="post"></div>';
     }
  }
  public function Duzenle($ad,$kad,$sifre,$eposta){
    $fotoAdi = $kad.'.jpg';
    $fotoSahip = $_SESSION['kadi'];
    if(empty($_FILES['pp']['name'])){
      if(empty($ad)){
        $pp = $this->db->prepare("SELECT * FROM users WHERE kadi=?");
        $pp->execute(array($_SESSION['kadi']));
        $pp_r = $pp->fetch(PDO::FETCH_ASSOC);
        $ad = $pp_r['adi'];
      }
      if(empty($kad)){
        $kad = $_SESSION['kadi'];
      }
      if(empty($sifre)){
        $pp = $this->db->prepare("SELECT * FROM users WHERE kadi=?");
        $pp->execute(array($_SESSION['kadi']));
        $pp_r = $pp->fetch(PDO::FETCH_ASSOC);
        $sifre = $pp_r['sifre'];
      }
      if(empty($eposta)){
        $pp = $this->db->prepare("SELECT * FROM users WHERE kadi=?");
        $pp->execute(array($_SESSION['kadi']));
        $pp_r = $pp->fetch(PDO::FETCH_ASSOC);
        $ad = $pp_r['eposta'];
      }
      $ekle = $this->db->prepare("UPDATE users SET adi= ?, kadi= ?, sifre= ?, eposta= ? WHERE kadi=? ");
      $ekle->bindParam(1, $ad, PDO::PARAM_STR);
      $ekle->bindParam(2, $kad, PDO::PARAM_STR);
      $ekle->bindParam(3, $sifre, PDO::PARAM_STR);
      $ekle->bindParam(4, $eposta, PDO::PARAM_STR);
      $ekle->bindParam(5, $fotoSahip, PDO::PARAM_STR);
      $ekle->execute();
      $dd = $this->db->prepare("UPDATE post SET post_sahip= ? WHERE post_sahip=? ");
      $dd->bindParam(1, $kad, PDO::PARAM_STR);
      $dd->bindParam(2, $fotoSahip, PDO::PARAM_STR);
      $dd->execute();
      $tt = $this->db->prepare("UPDATE comment SET yazan= ? WHERE yazan=? ");
      $tt->bindParam(1, $kad, PDO::PARAM_STR);
      $tt->bindParam(2, $fotoSahip, PDO::PARAM_STR);
      $tt->execute();
      if($ekle && $tt && $dd){
        echo '<h2>Başarılı</h2>';
        $_SESSION['kadi'] = $kad;
        header('Refresh: 1; url=../../index.php');
      }else{
        echo '<h2>Hata oluştu. Tekrar Deneyin.</h2>';
        header('Refresh: 2; url=../../views/profilduzenle.php');
      }

    }else {
      if(empty($ad)){
        $pp = $this->db->prepare("SELECT * FROM users WHERE kadi=?");
        $pp->execute(array($_SESSION['kadi']));
        $pp_r = $pp->fetch(PDO::FETCH_ASSOC);
        $ad = $pp_r['adi'];
      }
      if(empty($kad)){
        $kad = $_SESSION['kadi'];
      }
      if(empty($sifre)){
        $pp = $this->db->prepare("SELECT * FROM users WHERE kadi=?");
        $pp->execute(array($_SESSION['kadi']));
        $pp_r = $pp->fetch(PDO::FETCH_ASSOC);
        $sifre = $pp_r['sifre'];
      }
      if(empty($eposta)){
        $pp = $this->db->prepare("SELECT * FROM users WHERE kadi=?");
        $pp->execute(array($_SESSION['kadi']));
        $pp_r = $pp->fetch(PDO::FETCH_ASSOC);
        $ad = $pp_r['eposta'];
      }
      $maxBoyut = 7000000;
      $uzanti = substr($_FILES["pp"]["name"], -4,4);
      $fotoAdi = $kad.'.jpg';
      $fotoYolu = "../../fotograflar/pp/".$fotoAdi;
      $fotoSahip = $_SESSION['kadi'];
      if($_FILES["pp"]["size"]>$maxBoyut){
        echo "<h2>Dosya Boyunu Aşıldı(en fazla 7mb)</h2>";
        header('Refresh: 2; url=../../views/icerik-ekle.php');
      }else {
        $foto = $_FILES["pp"]["type"];
        if($foto == "image/jpeg" || $foto == "image/jpg"){
          if(is_uploaded_file($_FILES["pp"]["tmp_name"])){
            $tasi = move_uploaded_file($_FILES["pp"]["tmp_name"],$fotoYolu);
            $ekle = $this->db->prepare("UPDATE users SET adi= ?, kadi= ?, sifre= ?, pp= ?, eposta=? WHERE kadi=? ");
            $ekle->bindParam(1, $ad, PDO::PARAM_STR);
            $ekle->bindParam(2, $kad, PDO::PARAM_STR);
            $ekle->bindParam(3, $sifre, PDO::PARAM_STR);
            $ekle->bindParam(4, $fotoAdi, PDO::PARAM_STR);
            $ekle->bindParam(5, $eposta, PDO::PARAM_STR);
            $ekle->bindParam(6, $fotoSahip, PDO::PARAM_STR);
            $ekle->execute();
            $dd = $this->db->prepare("UPDATE post SET post_sahip= ? WHERE post_sahip=? ");
            $dd->bindParam(1, $kad, PDO::PARAM_STR);
            $dd->bindParam(2, $fotoSahip, PDO::PARAM_STR);
            $dd->execute();
            $tt = $this->db->prepare("UPDATE comment SET yazan= ? WHERE yazan=? ");
            $tt->bindParam(1, $kad, PDO::PARAM_STR);
            $tt->bindParam(2, $fotoSahip, PDO::PARAM_STR);
            $tt->execute();
            if($tasi && $ekle && $tt && $dd){
              echo '<h2>Başarılı</h2>';
              $_SESSION['kadi'] = $kad;
              header('Refresh: 1; url=../../index.php');
            }else{
              echo '<h2>Fotoğraf paylaşılırken hata oluştu. Tekrar Deneyin.</h2>';
              header('Refresh: 2; url=../../views/icerik-ekle.php');
            }
          }else{
            echo '<h2>Fotoğraf yüklenirken hata oluştu. Tekrar Deneyin.</h2>';
            header('Refresh: 2; url=../../views/icerik-ekle.php');
          }
        }else {
          echo '<h2>Format sadece jpeg,jpg olmalıdır.</h2>';
          header('Refresh: 2; url=../../views/icerik-ekle.php');
        }

      }

    }
  }
}
?>
