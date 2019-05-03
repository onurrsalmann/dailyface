<?php
class Notf{
    private $db;
    public function __construct(){
        $this->db = new Connection();
        $this->db = $this->db->dbConnect();
        $this->db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
    }
    public function YorumuCek($id, $istedigin_veri){
      $yc = $this->db->prepare("SELECT * FROM comment WHERE id=?");
      $yc->execute(array($id));
      $yc_r = $yc->fetch(PDO::FETCH_ASSOC);
      return $yc_r["$istedigin_veri"];
    }
    public function IdtoFoto($id,$istedigin_veri){
      $ll = $this->db->prepare("SELECT * FROM post WHERE post_id=?");
      $ll->execute(array($id));
      $ll_l = $ll->fetch(PDO::FETCH_ASSOC);
      return $ll_l["$istedigin_veri"];
    }
    public function NotfGoster(){
      $nf = $this->db->prepare("SELECT * FROM notification WHERE yazilan=? AND sakla='0'");
      $nf->execute(array($_SESSION['kadi']));
      $nfg = $nf->fetchAll(PDO::FETCH_ASSOC);
      if($nfg){
        foreach ($nfg as $f) {
          $post_adi = $this->IdtoFoto($f["post_id"],"post_adi");

          $simdi=date_create(date("Y-m-d H:i:s"));
          $bildirimtarih=date_create($f['time']);
          $fark=date_diff($bildirimtarih,$simdi);
          $yorum = $this->YorumuCek($f["yorum_id"], "yorum");
          echo '
          <div onclick="location.href=`index.php?s=6&os='.$f["yazilan"].'&p='.$f["post_id"].'`;" class="notf">
            <img class="pp" src="fotograflar/post/'.$post_adi.'">
            <a id="notf-yazan">'.$f["yazan"].' </a><a>&nbsp;yandaki';if($f['yorum_id']==0){echo ' fotografı beğendi';}else{echo' fotoğrafa yorum yaptı: '.$yorum;} echo '</a>
            <form action="core/controller/notf-sil.php" method="POST">
              <input name="notfsil" type="hidden" value="'.$f["id"].'" />
              <input name="notfsilsubmit" class="notfsil-button" type="submit" value="Okundu">
            </form>
            <a id="notf-tarih">
          ';
          if($fark->format('%m') == 0){
            if($fark->format('%d') == 0){
              if($fark->format('%h') == 0){
                if($fark->format('%i') == 0){
                  echo $fark->format('%s saniye önce');
                }else{
                  echo $fark->format('%i dakika önce');
                }
              }else{
                echo $fark->format('%h saat önce');
              }
            }else{
              echo $fark->format('%d gün önce');
            }
          }else {
            echo $fark->format('%m ay önce');
          }
          echo '</a>
          </div>';
        }}else { echo 'Henüz bir bildirimin yok';}
    }
    public function Okundu($id){
      $okundu = $this->db->prepare("UPDATE notification SET sakla='1'  WHERE id= ? ");
      $okundu->execute(array($id));
      if($okundu){ header('Location: ../../index.php?s=2');}else { echo 'hata'; header('Refresh: 1; url=../../index.php');}
    }
}
