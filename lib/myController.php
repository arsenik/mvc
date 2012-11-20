<?php
class myController extends myObject {
  
  /**
   * Initiatlie the view compoment
   * @param type $module
   * @param type $action
   * @return myView 
   */
  public function getView($module, $action) {
    $view = new myView();
    $view->setModule($module);
    $view->setAction($action); 
    return $view;
  }

  
  
}
