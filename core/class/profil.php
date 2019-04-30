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
  public function Postlar($kadi, $adres, $adres2){
    $query = $this->db->query("SELECT * FROM post WHERE post_sahip='$kadi' ORDER BY post_id DESC", PDO::FETCH_ASSOC);
    if($query->rowCount()){
     foreach( $query as $row ){
        echo '<a href="'.$adres.'index.php?s=6&os='.$row["post_sahip"].'&p='.$row["post_id"].'">
        <div class="profil-post-kalip">
        <img src= "'.$adres2.'fotograflar/post/'.$row["post_adi"].'" class="profil-post-image" alt="post">
        </div>
        </a>';
     }}else{
       echo 'Henüz hiç gönderi yok';
     }
  }
  public function PostGoster($p, $po){
    $pp = $this->db->prepare("SELECT * FROM post WHERE post_id=?");
    $pp->execute(array($p));
    $pp_r = $pp->fetch(PDO::FETCH_ASSOC);
    $yorumlar = $this->db->prepare("SELECT * FROM comment WHERE post_id=? ORDER BY id DESC");
    $yorumlar->execute(array($pp_r["post_id"]));
    $yorum = $yorumlar->fetchAll(PDO::FETCH_OBJ);
    echo '
    <div id="os-post-comment">
      <div class="post-ust">
        <img class="pp" src="fotograflar/pp/'.$po.'">
        <a id="os-post-sahip" href="index.php?s=6&os='.$pp_r["post_sahip"].'">@'.$pp_r["post_sahip"].'</a>';
        if($pp_r["post_sahip"]== $_SESSION["kadi"]){
          echo '<form action="core/controller/post-sil.php" method="POST">
            <input name="postsil" type="hidden" value="'.$pp_r["post_id"].'" />
            <input name="postsilsubmit" class="postsil-button"  type="submit" value="Sil">
          </form>';
        }
        echo '
        <a class="post-aciklama">'.$pp_r["post_aciklama"].'</a>
      </div>
      <div id="os-post-orta">
        <img src= "fotograflar/post/'.$pp_r["post_adi"].'" class="post-image" alt="post">
      </div>
      <div id="os-post-son">
        <div class="yorum-ekle">
          <form action="core/controller/yorum-ekle.php" method="POST">
            <input name="post_id" type="hidden" value="'.$pp_r["post_id"].'" />
            <input required  type="text" placeholder="Yorumunuzu yazınız.." class="yorum-input" name="yorum">
            <input name="yorumsubmit" class="yorum-button"  type="submit" value="Paylaş">
          </form>
        </div>
        <div class="yorumlar">';
        foreach ($yorum as $keyYorum) {
          $yorum_pp = $this->ProfilVeriCek($keyYorum->yazan,"pp");
          echo '<div class="yorum"><img class="yorum_pp" src="fotograflar/pp/'.$yorum_pp.'">
           <a class="yorum-sahip" href="index.php?p=6&os='.$keyYorum->yazan.'">@'.$keyYorum->yazan.'</a>
           <a class="yorum-aciklama">'.$keyYorum->yorum.'</a>';
           if($pp_r["post_sahip"]== $_SESSION["kadi"]){
             echo '<form action="core/controller/yorum-sil.php" method="POST">
               <input name="yorum_id" type="hidden" value="'.$keyYorum->id.'" />
               <input name="yorumsubmit" class="yorum-button"  type="submit" value="Sil">
             </form></div>';
           }
           else if($keyYorum->yazan ==$_SESSION["kadi"]){
             echo '<form action="core/controller/yorum-sil.php" method="POST">
               <input name="yorum_id" type="hidden" value="'.$keyYorum->id.'" />
               <input name="yorumsubmit" class="yorum-button"  type="submit" value="Sil">
             </form></div>';
           }else{echo '</div>';}
        }
        echo '
          </div>
      </div>
    </div>';
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
        $eposta = $pp_r['eposta'];
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
      $ff = $this->db->prepare("UPDATE notification SET yazan= ? WHERE yazan=? ");
      $ff->bindParam(1, $kad, PDO::PARAM_STR);
      $ff->bindParam(2, $fotoSahip, PDO::PARAM_STR);
      $ff->execute();
      $cc = $this->db->prepare("UPDATE notification SET yazilan= ? WHERE yazilan=? ");
      $cc->bindParam(1, $kad, PDO::PARAM_STR);
      $cc->bindParam(2, $fotoSahip, PDO::PARAM_STR);
      $cc->execute();
      if($ekle && $tt && $dd && $ff && $cc){
        $_SESSION['kadi'] = $kad;
        header('Location: ../../index.php');
      }else{
        header('Location: ../../index.php?error=4');
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
        $eposta = $pp_r['eposta'];
      }
      $maxBoyut = 7000000;
      $uzanti = substr($_FILES["pp"]["name"], -4,4);
      $fotoAdi = $kad.'.jpg';
      $fotoYolu = "../../fotograflar/pp/".$fotoAdi;
      $fotoSahip = $_SESSION['kadi'];
      if($_FILES["pp"]["size"]>$maxBoyut){
        header('Location: ../../index.php?error=6');
      }else {
        $foto = $_FILES["pp"]["type"];
        if($foto == "image/jpeg" || $foto == "image/jpg" || $foto == "image/png"){
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
            $ff = $this->db->prepare("UPDATE notification SET yazan= ? WHERE yazan=? ");
            $ff->bindParam(1, $kad, PDO::PARAM_STR);
            $ff->bindParam(2, $fotoSahip, PDO::PARAM_STR);
            $ff->execute();
            $cc = $this->db->prepare("UPDATE notification SET yazilan= ? WHERE yazilan=? ");
            $cc->bindParam(1, $kad, PDO::PARAM_STR);
            $cc->bindParam(2, $fotoSahip, PDO::PARAM_STR);
            $cc->execute();
            if($tasi && $ekle && $tt && $dd && $ff && $cc){

              $_SESSION['kadi'] = $kad;
              header('Location: ../../index.php');
            }else{
              header('Location: ../../index.php?s=3&error=4');
            }
          }else{
            header('Location: ../../index.php?s=3&error=4');
          }
        }else {
          header('Location: ../../index.php?s=3&error=8');
        }

      }

    }
  }
}
?>
