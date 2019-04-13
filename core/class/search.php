<?php
class Search{
    private $db;
    public function __construct(){
        $this->db = new Connection();
        $this->db = $this->db->dbConnect();
        $this->db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
    }
    public function Search($search){
      if (!$search) {
        echo 'kelime girin';
      }else{
        $sorgu = $this->db->prepare("SELECT * FROM users WHERE kadi LIKE :kadi");
        $sorgu->execute(array(':kadi' => '%'.$search.'%'));
        if($sorgu->rowCount()){
          echo '<div class="search-option-cart"><h3>Kullanıcı Adı Sonuçları</h3><a>';
          echo $search." Kelimesine ait (".$sorgu->rowCount()." adet) sonuç bulundu</a></br>";
          foreach ($sorgu as $row) {
            echo '<div onclick="location.href=`profil.php?os='.$row['kadi'].'`;" class="search-cart">
            <img class="search-pp" src="../fotograflar/pp/'.$row['pp'].'">
            <a href="profil.php?os='.$row['kadi'].'" class="search-bilgi-icerik" style="text-decarition:none;">@'.$row['kadi'].'</a></br>
            <a class="search-bilgi-icerik">'.$row['adi'].'</a>
            </div>';
          }echo '</div>';
        }else{
          echo "Bu harfi içeren bir kullanıcı adı yok.";
        }
        echo '</br>';
        $sorg = $this->db->prepare("SELECT * FROM users WHERE adi LIKE :adi");
        $sorg->execute(array(':adi' => '%'.$search.'%'));
        if($sorg->rowCount()){
          echo '<div class="search-option-cart"><h3>Ad Sonuçları</h3><a>';
          echo $search." Kelimesine ait (".$sorg->rowCount()." adet) sonuç bulundu</a></br>";
          foreach ($sorg as $row) {
            echo '<div onclick="location.href=`profil.php?os='.$row['kadi'].'`;" class="search-cart">
            <img class="search-pp" src="../fotograflar/pp/'.$row['pp'].'">
            <a href="profil.php?os='.$row['kadi'].'" class="search-bilgi-icerik" style="text-decarition:none;">@'.$row['kadi'].'</a></br>
            <a class="search-bilgi-icerik">'.$row['adi'].'</a>
            </div>';
          }echo '</div>';
        }else{
          echo "Bu harfi içeren bir ad yok.";
        }
      }

    }
}
?>
