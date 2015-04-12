<?php

class Link extends AppModel {

	var $name = 'Link';
	
	public $hasMany = array(
        'LinkTags' => array(
            'className'    => 'LinkTagXref' //,
            //'dependent'    => true
        )
	);
	
}

?>