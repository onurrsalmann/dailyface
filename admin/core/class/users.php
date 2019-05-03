<?php
class Users{
    private $db;

    public function __construct(){
        $this->db = new Connection();
        $this->db = $this->db->dbConnect();
        $this->db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
    }
    public function userListele(){
      $query = $this->db->query("SELECT * FROM users", PDO::FETCH_ASSOC);
      if ( $query->rowCount() ){
        foreach( $query as $row ){
          echo '
          <tr>
              <td>'.$row["eposta"].'</td>
              <td>'.$row["kadi"].'</td>
              <td>'.$row["adi"].'</td>
              <td>'.$row["kayit-tarih"].'</td>
          </tr>';
        }
      }else{echo "Kullanıcı Yok";}
    }
}?>
