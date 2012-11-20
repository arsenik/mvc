<?php
class myContactQuery extends mySQLDatabase
{
  
  const PHONE_TYPE_MOBILE = 1,
        PHONE_TYPE_HOME   = 2,
        PHONE_TYPE_OFFICE = 3,
        PHONE_TYPE_OTHER  = 4;
  
  static public $phone_type = array(
    self::PHONE_TYPE_MOBILE => 'mobile', 
    self::PHONE_TYPE_HOME   => 'home', 
    self::PHONE_TYPE_OFFICE => 'office', 
    self::PHONE_TYPE_OTHER  => 'other'  
  );



  static public function getContacts($page_number = 0, $page_size = 100){
    $sql = 'select c.id, c.first_name, c.last_name, pn.number, pt.name 
              from contact c 
              left join phone_number pn on c.id = pn.contact_id
              left join phone_type pt on pn.phone_type_id = pt.id
              order by c.last_name
              limit :limit offset :offset
              ';
    
    $db = mySQLDatabase::getInstance();
    $stmt = $db->execute($sql, array(
      'limit' => array('int', $page_size), 
      'offset' => array('int', $page_number > 0 ? $page_number - 1 : $page_number),        
      ));
    
    $contacts = array();
    while($res = $stmt->fetch(PDO::FETCH_ASSOC))
    {                 
      $res[$res['name']] = $res['number'];
      unset($res['name'], $res['number']);
      
      if(isset($contacts[$res['id']])){
        $contacts[$res['id']] = $contacts[$res['id']]->fromArray($res);
      }else{
        $c = new myContact();
        $contacts[$res['id']] = $c->fromArray($res);
      }
    }
       
    return $contacts;    
  }
  
  static public function save($contact){
    $sql = 'insert into contact(first_name, last_name) 
              values (:first_name, :last_name)';
    $db = mySQLDatabase::getInstance();
    $stmt = $db->execute($sql, array(
      'first_name' => array('string', $contact->first_name), 
      'last_name' => array('string', $contact->last_name),        
      ));
    
    $id = $db->lastInsertId();
    
    
    foreach(self::$phone_type as $key => $type){
      if($contact->$type){
        $sql = 'insert into phone_number(phone_type_id, contact_id, number) 
            values (:phone_type_id, :contact_id, :number)';
        $db = mySQLDatabase::getInstance();
        $stmt = $db->execute($sql, array(
          'phone_type_id' => array('int', $key), 
          'contact_id' => array('int', $id),        
          'number' => array('string', $contact->$type),        
          ));
      }
    }
    
  }
  
  
  static public function deleteContact($id){
    $sql = 'delete from contact where id = :id';
    $db = mySQLDatabase::getInstance();
    $stmt = $db->execute($sql, array(
      'id' => array('int', $id), 
      ));    
  }
      
}
