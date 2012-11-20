<?php
class myView extends myObject {
  
  protected $module = null;
  protected $action = null;

  public function setModule($module) {
    $this->module = $module;
  }
  
  public function setAction($action) {
    $this->action = $action;
  }
  
  /**
   * Display the templates - body only optional
   * @param type $vars
   * @param type $header 
   */
  public function display($vars, $header = true) {
    
    if($header)include MY_ROOT_DIR.'templates/header.php';
    include MY_ROOT_DIR.'modules/'.$this->module.'/view/'.$this->action.'.php';
    if($header)include MY_ROOT_DIR.'templates/footer.php';
    
    
  }
  
}
