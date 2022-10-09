<?php
class Database {
  // Db params
  private $host = 'localhost';
  private $db_name = 'blog_API';
  private $username = 'root';
  private $password = null;
  private $conn;

  // Db connect 
  public function connect(){
    $this->conn = null;

    try{
      $this->conn = new PDO('mysql:host=' .$this->host . ';dbname=' . $this->db_name, 
      $this->username, $this->password );

      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $ev){
      echo 'connection err' .$ev->getMessage();
    }
    return $this->conn;
  }
}