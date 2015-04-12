<?php
class WsLinksController extends AppController {

  var $name = 'WsLinks';
  
  public $components = array('RequestHandler');
  
  var $uses = array('Link', 'Tag', 'LinkTagXref');
  
  public function beforeFilter() {
   	$this->Auth->allow();
  }
  			
  function logout() {
   	$this->Auth->logout();
  	$this->setResult(NULL);
  }

  function login() {
  	$this->readRequest();
  	$this->Auth->logout();
  	$user = $this->Auth->identify($this->request, $this->response);
  	$this->request->data = array();
  	if ($user) {
  		$this->Auth->login($user);
  	}
  	$this->setResult($user ? $user : NULL);
  }
  
  function test() {
  	$xrefs = $this->LinkTagXref->find('all', array(
    	'conditions' => array('LinkTagXref.tag_id' => 3)
  	));
  	$this->setResult($this->unwrap($xrefs, 'Link'));
//   	pr($links);
  }
  
  function getLinks() {
  	if ($this->loggedIn()) {
	  	$tagId = $this->request->data['Link']['tag'];
	  	$xrefs = $this->LinkTagXref->find('all', array(
	    	'conditions' => array('LinkTagXref.tag_id' => $tagId)
	  	));
	  	$this->setResult($this->unwrap($xrefs, 'Link'));
  	}
  }
  
  function getTags() {
  	$this->queryDb($this->Tag, array(), 'Tag');
  }
  
  function queryDb($model, $condition, $objName) {
  	if ($this->loggedIn()) {
 	  	$this->setResult($this->unwrap($model->find('all', $condition), $objName));
  	}
  }

  private function loggedIn() {
  	$this->readRequest();
  	$loggedIn = $this->Auth->loggedIn();
 		$this->setResult(NULL);
  	return $loggedIn;
  }
  
  private function unwrap($wrappedObjects, $objName) {
  	$links = array();
  	foreach ($wrappedObjects as &$obj) {
  		array_push($links, $obj[$objName]);
  	}
  	return $links;
  }
  
  private function readRequest() {
  	$input = $this->request->input('json_decode');
  	if ($input == null) {
  		// no json input available when using browser to test actions 
  		$input = array();
  	}
  	$this->request->data = $this->objectToArray(array_pop($input));
  }
  
  private function setResult($resultData) {
  	$result = array('data' => $resultData);
  	$result['request'] = $this->request->data;
  	$result['loggedIn'] = $this->Auth->loggedIn();
  	$this->set('result', $result);
  	$this->set('_serialize', 'result');
  }
  
  private function objectToArray($object) {
  	if (!is_object($object) && !is_array($object)) {
  		return $object;
  	}
  	if (is_object($object)) {
  		$object = get_object_vars( $object );
  	}
  	return array_map(array(&$this, 'objectToArray'), $object);
  }
  
  function add() {
  	if ($this->loggedIn()) {
  		$this->Link->save($this->data);
  		$newLink = $this->Link->find('first', array(
        'conditions' => array('Link.id' => $this->Link->id)
    	));
  		$this->setResult($newLink['Link']);
  	}
  }
  
  function delete() {
  	if ($this->loggedIn()) {
  		foreach ($this->request->data['links'] as $id) {
 	  		$this->Link->delete($id);
  		}
  		$this->setResult(NULL);
  	}
  }

}
?>
