<?php
class Connection{
    public function dbConnect(){
        $host = 'localhost';
        $db_name = 'df';
        $db_username = 'root';
        $db_password = '';
        try
        {
            return new PDO('mysql:host='. $host .';dbname='.$db_name, $db_username, $db_password);
        }
        catch (PDOException $e)
        {
            exit('Veritabanı Baglantı Hatası');
        }
    }
}
?>
