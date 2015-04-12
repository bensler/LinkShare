<?php

class LinkTagXref extends AppModel {

	var $name = 'LinkTagXref';

	public $belongsTo = array(
		'Link', 'Tag'
	);
	
}

?>