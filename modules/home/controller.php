<?php
class homeController extends myController {
  
  public function index() {
    
    $this->getView('home', 'index')->display(array(
        'contacts' => myContactQuery::getContacts(),
    ));  
        

  }
  
  public function addContact() {
    
    $request = new myRequest();   
    $res = myContact::validate($request->getPostParameter('contact'));
    if($res['err']){
      $this->getView('home', 'index')->display(array(
        'form' => $res,  
        'contacts' => myContactQuery::getContacts(),
      ));
      exit;
    }
    
    $contact = new myContact();
    $contact->fromArray($res['val']);
    $contact->save();
    
    $this->getView('home', 'addContact')->display(array(
        'contacts' => myContactQuery::getContacts(),
      ), false);
    exit;
    
  }
  
    
  public function deleteContact() {
    
    $request = new myRequest();   
    myContactQuery::deleteContact($request->getPostParameter('id'));
    
    $this->getView('home', 'addContact')->display(array(
        'contacts' => myContactQuery::getContacts(),
      ), false);
    exit;
  }
  
}
