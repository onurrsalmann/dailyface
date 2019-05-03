<?php
class Yedekle{
	private $host;
	private $driver;
	private $user;
	private $password;
	private $dbName;
	private $dsn;
	private $tables = array();
	private $handler;
	private $error = array();
	private $final;
	public function __construct($args){
		if(!$args['host']) $this->error[] = 'Host bulunamadı';
		if(!$args['user']) $this->error[] = 'Kullanıcı bulunamadı';
		if(!isset($args['password'])) $this->error[] = 'Şifre bulunamadı';
		if(!$args['database']) $this->error[] = 'Veritabanı bulunamadı';
		if(!$args['driver']) $this->error[] = 'Sürücü bulunamdı';
		if(count($this->error)>0){
			return;
		}
		$this->host = $args['host'];
		$this->driver = $args['driver'];
		$this->user = $args['user'];
		$this->password = $args['password'];
		$this->dbName = $args['database'];
		$this->final = 'CREATE DATABASE ' . $this->dbName.";\n\n";
		if($this->host=='localhost'){
			$this->host = '127.0.0.1';
		}
		$this->dsn = $this->driver.':host='.$this->host.';dbname='.$this->dbName;

		$this->connect();
		$this->getTables();
		$this->generate();
	}
	public function backup(){
		if(count($this->error)>0){
			return array('error'=>true, 'msg'=>$this->error);
		}
		return array('error'=>false, 'msg'=>$this->final);
	}
	private function generate(){
		foreach ($this->tables as $tbl) {
			$this->final .= '--CREATING TABLE '.$tbl['name']."\n";
			$this->final .= $tbl['create'] . ";\n\n";
			$this->final .= '--INSERTING DATA INTO '.$tbl['name']."\n";
			$this->final .= $tbl['data']."\n\n\n";
		}
		$this->final .= '-- Son'."\n\n";
	}
	private function connect(){
		try {
			$this->handler = new PDO($this->dsn.';charset=UTF8', $this->user, $this->password);
		} catch (PDOException $e) {
			$this->handler = null;
			$this->error[] = $e->getMessage();
			return false;
		}
	}
	private function getTables(){
		try {
			$stmt = $this->handler->query('SHOW TABLES');
			$tbs = $stmt->fetchAll();
			$i=0;
			foreach($tbs as $table){
				$this->tables[$i]['name'] = $table[0];
				$this->tables[$i]['create'] = $this->getColumns($table[0]);
				$this->tables[$i]['data'] = $this->getData($table[0]);
				$i++;
			}
			unset($stmt);
			unset($tbs);
			unset($i);

			return true;
		} catch (PDOException $e) {
			$this->handler = null;
			$this->error[] = $e->getMessage();
			return false;
		}
	}
	private function getColumns($tableName){
		try {
			$stmt = $this->handler->query('SHOW CREATE TABLE '.$tableName);
			$q = $stmt->fetchAll();
			$q[0][1] = preg_replace("/AUTO_INCREMENT=[\w]*./", '', $q[0][1]);
			return $q[0][1];
		} catch (PDOException $e){
			$this->handler = null;
			$this->error[] = $e->getMessage();
			return false;
		}
	}
	private function getData($tableName){
		try {
			$stmt = $this->handler->query('SELECT * FROM '.$tableName);
			$q = $stmt->fetchAll(PDO::FETCH_NUM);
			$data = '';
			foreach ($q as $pieces){
				foreach($pieces as &$value){
					$value = addslashes($value);
				}
				$data .= 'INSERT INTO '. $tableName .' VALUES (\'' . implode('\',\'', $pieces) . '\');'."\n";
			}
			return $data;
		} catch (PDOException $e){
			$this->handler = null;
			$this->error[] = $e->getMessage();
			return false;
		}
	}
}
?>
