<?php
class myRequest extends myObject {
  
   protected $get_parameters = null;
   protected $post_parameters = null;
   
   /**
    * Get POST and GET parameters in a secure way
    */
   public function __construct(){
     $this->get_parameters = get_magic_quotes_gpc() ? myTools::stripslashes_deep($_GET) : $_GET;
     $this->post_parameters = get_magic_quotes_gpc() ? myTools::stripslashes_deep($_POST) : $_POST;     
   }
   
   public function getGetParameter($var = null, $default = null){    
     if(null === $var){
       return $this->get_parameters;
     }
     return isset($this->get_parameters[$var]) ? $this->get_parameters[$var] : $default;
   }
   
   public function getPostParameter($var =null, $default = null){
     if(null === $var){
       return $this->post_parameters;
     }
     return isset($this->post_parameters[$var]) ? $this->post_parameters[$var] : $default;
   }
   
   public function getMethod(){
     return $_SERVER['REQUEST_METHOD'];
   }
   
   
   
  
}
