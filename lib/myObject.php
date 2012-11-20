<?php
class myObject
{
  /**
   * Allow to set vatiable from an array to the object
   * @param type $arr
   * @return myObject 
   */  
  public function fromArray($arr) {
    $vars = get_class_vars(get_class($this));
    if(is_array($vars) && is_array($arr)){     
        foreach($vars as $name => $val){        
            if(isset($arr[$name])){                    
                $this->$name = $arr[$name];
            }
        }
    }
    return $this;
  }
    
}
