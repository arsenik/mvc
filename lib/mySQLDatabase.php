<?php
class mySQLDatabase {
  
  private static $instance = null;
  private static $conn;
  
  public function __construct() {
    
    try
    {
      self::$conn = new PDO('mysql:host='.MY_DB_SERVER.';dbname='.MY_DB_NAME, MY_DB_USER, MY_DB_PASS);      
      self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      return false;
    }
    
  }
  
  static public function getInstance() {
    
    if(!isset(self::$instance))
    {
      self::$instance = new mySQLDatabase();
    }
    
    return self::$instance;    
  }
  
   
  
  public function execute($query, $params = null) {
    
    $stmt = self::$conn->prepare($query);

    foreach($params as $name => $p){
      if('int' === $p[0]){
        $type = PDO::PARAM_INT;
      }else if('string' === $p[0]){
        $type = PDO::PARAM_STR;
      }      
      $stmt->bindValue(':'.$name, $p[1], $type);     
    }
    $stmt->execute();
    return $stmt;
  }
  
  
  public function lastInsertId(){
    return self::$conn->lastInsertId();
  }
  
  
  
  
}