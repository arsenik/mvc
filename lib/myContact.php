<?php
class myContact extends myObject
{
    public $id;
    public $first_name;
    public $last_name; 
    public $mobile; 
    public $home; 
    public $office; 
    public $other; 
    
    public static $form_fields = array(
        array('key' => 'first_name', 'label' => 'First name'),
        array('key' => 'last_name', 'label' => 'Last name'),
        array('key' => 'mobile', 'label' => 'Mobile'),
        array('key' => 'home', 'label' => 'Home'),
        array('key' => 'office', 'label' => 'Office'),
        array('key' => 'other', 'label' => 'Other'),
    );


    public static function validate($values){
      
      $errors = array();
      
      if(is_array($values))
      foreach($values as $key => $value)
      {
        switch ($key){
          case 'first_name':
          case 'last_name':
            if(strlen($values[$key]) < 2){
              $errors[$key] = '2 characters minimum';
            }else if(strlen($values[$key]) > 30){
              $errors[$key] = '30 characters maximum';
            }
            break;
          case 'mobile':
          case 'home':
          case 'office':
          case 'other':
            if($values[$key] && strlen($values[$key]) != 10){
              $errors[$key] = 'Enter a 10 digit phone number';
            }
            break;
        }
      }
      
      if(!isset($values['first_name']) || !$values['first_name']){
        $errors['first_name'] = 'First name is required';
      }
                  
      if(!isset($values['last_name']) || !$values['last_name']){
        $errors['last_name'] = 'Last name is required';
      }        
                    
      if(!isset($values['mobile']) || !$values['mobile']){
        $errors['mobile'] = 'Mobile is required';
      }
      
      
     return array(
       'val' => $values,
       'err' => $errors,
     );
                       
    }
    
    
    public function save(){
      myContactQuery::save($this);
    }
    
}
