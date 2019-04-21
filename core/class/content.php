<?php
class Content{
    private $db;
    public function __construct(){
        $this->db = new Connection();
        $this->db = $this->db->dbConnect();
        $this->db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
    }
    public function Ekle($aciklama){
      $maxBoyut = 7000000;
      $uzanti = substr($_FILES["foto"]["name"], -4,4);
      $fotoAdi = rand(1,99999).$uzanti;
      $fotoYolu = "../../fotograflar/post/".$fotoAdi;
      $fotoTuru = $_FILES["foto"]["type"];
      $fotoSize = $_FILES["foto"]["size"];
      $fotoSahip = $_SESSION['kadi'];
      if($_FILES["foto"]["size"]>$maxBoyut){
        header('Location: ../../index.php?error=6');
      }else {
        $foto = $_FILES["foto"]["type"];
        if($foto == "image/jpeg" || $foto == "image/jpg" || $foto == "image/png"){
          if(is_uploaded_file($_FILES["foto"]["tmp_name"])){
            $tasi = move_uploaded_file($_FILES["foto"]["tmp_name"],$fotoYolu);
            $ekle = $this->db->prepare("INSERT INTO post(post_adi, post_turu, post_boyut, post_sahip, post_aciklama)
            VALUES( ?, ?, ?, ?, ?)");
            $ekle->bindParam(1, $fotoAdi, PDO::PARAM_STR);
            $ekle->bindParam(2, $fotoTuru, PDO::PARAM_STR);
            $ekle->bindParam(3, $fotoSize, PDO::PARAM_STR);
            $ekle->bindParam(4, $fotoSahip, PDO::PARAM_STR);
            $ekle->bindParam(5, $aciklama, PDO::PARAM_STR);
            $ekle->execute();
            if($tasi && $ekle){
              header('Location: ../../index.php');
            }else{
              header('Location: ../../index.php?error=7');
            }
          }else{
            header('Location: ../../index.php?error=7');
          }
        }else {
          header('Location: ../../index.php?error=8');
        }
      }
    }
    public function PostUserVeri($kadi,$istedigin_veri){
      $pp = $this->db->prepare("SELECT * FROM users WHERE kadi=?");
      $pp->execute(array($kadi));
      $pp_r = $pp->fetch(PDO::FETCH_ASSOC);
      return $pp_r["$istedigin_veri"];
    }
    public function IdtoVeri($id,$istedigin_veri){
      $pp = $this->db->prepare("SELECT * FROM post WHERE post_id=?");
      $pp->execute(array($id));
      $pp_r = $pp->fetch(PDO::FETCH_ASSOC);
      return $pp_r["$istedigin_veri"];
    }
    public function Goster(){
      $fotogoster = $this->db->prepare("SELECT * FROM post ORDER BY post_id DESC");
      $fotogoster->execute(array());
      $f = $fotogoster->fetchAll(PDO::FETCH_ASSOC);
      if($f){
        foreach ($f as $m) {
          $pp = $this->PostUserVeri($m["post_sahip"],"pp");
          $yorumlar = $this->db->prepare("SELECT * FROM comment WHERE post_id=? ORDER BY id DESC");
          $yorumlar->execute(array($m["post_id"]));
          $yorum = $yorumlar->fetchAll(PDO::FETCH_OBJ);
          echo '
          <div class="post-comment">
            <div class="post-ust">
              <img class="pp" src="fotograflar/pp/'.$pp.'">
              <a class="post-sahip" href="views/profil.php?os='.$m["post_sahip"].'">@'.$m["post_sahip"].'</a>';

              if($m["post_sahip"]== $_SESSION["kadi"]){
                echo '<form action="core/controller/post-sil.php" method="POST">
                  <input name="postsil" type="hidden" value="'.$m["post_id"].'" />
                  <input name="postsilsubmit" class="postsil-button"  type="submit" value="Sil">
                </form>';
              }
              echo '
              <a class="post-aciklama">'.$m["post_aciklama"].'</a>
            </div>
            <div class="post-orta">
              <img src= "fotograflar/post/'.$m["post_adi"].'" class="post-image" alt="post">
            </div>
            <div class="post-son">
              <div class="yorum-ekle">
                <form action="core/controller/yorum-ekle.php" method="POST">
                  <input name="post_id" type="hidden" value="'.$m["post_id"].'" />
                  <input required  type="text" placeholder="Yorumunuzu yazınız.." class="yorum-input" name="yorum">
                  <input name="yorumsubmit" class="yorum-button"  type="submit" value="Paylaş">
                </form>
              </div>
              <div class="yorumlar">
              ';
              foreach ($yorum as $keyYorum) {
                $yorum_pp = $this->PostUserVeri($keyYorum->yazan,"pp");
                echo '<div class="yorum"><img class="yorum_pp" src="fotograflar/pp/'.$yorum_pp.'">
                 <a class="yorum-sahip" href="views/profil.php?os='.$keyYorum->yazan.'">@'.$keyYorum->yazan.'</a>
                 <a class="yorum-aciklama">'.$keyYorum->yorum.'</a>';
                 if($m["post_sahip"]== $_SESSION["kadi"]){
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

        }}else{echo '</br><a style="font-weight:bold;">Henüz hiç bir gönderi paylaşılmamış. Hadi ilk sen ol!</a>';}
    }
    public function YorumEkle($yorum,$post_id){
      $yazan = $_SESSION['kadi'];
      $ekle = $this->db->prepare("INSERT INTO comment(yazan, yorum, post_id)
      VALUES( ?, ?, ?)");
      $ekle->bindParam(1, $yazan, PDO::PARAM_STR);
      $ekle->bindParam(2, $yorum, PDO::PARAM_STR);
      $ekle->bindParam(3, $post_id, PDO::PARAM_STR);
      $ekle->execute();
      $sonId = $this->db->lastInsertId();
      if($ekle){
        $yazilan = $this->IdtoVeri($post_id,'post_sahip');
        if($yazan != $yazilan){
        $notf = $this->db->prepare("INSERT INTO notification(yazan, yorum_id, yazilan)
        VALUES( ?, ?, ?)");
        $notf->bindParam(1, $yazan, PDO::PARAM_STR);
        $notf->bindParam(2, $sonId, PDO::PARAM_STR);
        $notf->bindParam(3, $yazilan, PDO::PARAM_STR);
        $notf->execute();
        if($notf){
          header('Location: ../../index.php');
        }else{
          header('Location: ../../index.php?error=7');
        }}else  {header('Location: ../../index.php');}
      }else{
        header('Location: ../../index.php?error=7');
      }
    }
    public function YorumSil($yorum_id){
      $yorum_sil = $this->db->prepare("DELETE FROM comment WHERE id=?");
      $silindi = $yorum_sil->execute(array($yorum_id));
      if ($silindi){
        $notf_sil = $this->db->prepare("DELETE FROM notification WHERE yorum_id=?");
        $notf_silindi = $notf_sil->execute(array($yorum_id));
        if($notf_silindi){
          header('Location: ../../index.php');
        }else{echo "<h2>Silinemedi</h2>"; header('Refresh: 2; url=../../index.php');}
      }else{
        header('Location: ../../index.php?error=7');
      }
    }
    public function Sil($silinecek_id){
      $sil = $this->db->prepare("SELECT * FROM post WHERE post_id=?");
      $sil->execute(array($silinecek_id));
      $bul = $sil->fetch(PDO::FETCH_ASSOC);

      $foto_yolu = '../../fotograflar/post/'.$bul["post_adi"].'';
      unlink($foto_yolu);
      $db_sil = $this->db->prepare("DELETE FROM post WHERE post_id=?");
      $siliindi = $db_sil->execute(array($silinecek_id));
      if ($siliindi){
        $siil = $this->db->prepare("SELECT * FROM comment WHERE post_id=?");
        $siil->execute(array($silinecek_id));
        $bull = $siil->fetch(PDO::FETCH_ASSOC);
        $yorum_id = $bull['id'];
        $yorum_sil = $this->db->prepare("DELETE FROM comment WHERE post_id=?");
        $silindi = $yorum_sil->execute(array($silinecek_id));
        if($silindi){
          $notf_sil = $this->db->prepare("DELETE FROM notification WHERE yorum_id=?");
          $notf_silindi = $notf_sil->execute(array($yorum_id));
          if($notf_silindi){
            header('Location: ../../index.php');
          }else{echo "<h2>Silinemedi</h2>"; header('Refresh: 2; url=../../index.php');}
        }else{echo "<h2>Silinemedi</h2>"; header('Refresh: 2; url=../../index.php');}
      }else{
        header('Location: ../../index.php?error=7');
      }
    }

}?>
