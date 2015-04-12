<?php
class LinksController extends AppController {

  var $name = 'Links';
  
  public function beforeFilter() {
//  	$this->Auth->allow('index', 'indox', 'post', 'add');
  }
  			
  function index() {
  	$links = $this->Link->find('all', array('order' =>  'Link.id DESC'));
    $this->set('links', $links);
  }
  
  function add() {
    $this->Link->save($this->data);
    $this->redirect(array('action' => 'index'));
  }
  
  function delete($id) {
  	$this->Link->delete($id);
    $this->redirect(array('action' => 'index'));
  }

}
?>
