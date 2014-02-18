<?php
class PostFixture extends CakeTestFixture {
	public $fields = array (
		'id'      => array('type' => 'integer',
					'key' => 'primary'),
		'title'   => array ('type' => 'string', 'length' => 255, 'null' => false),
		'body'    => 'text',
        'created' => 'datetime',
        'updated' => 'datetime'
	);
	public $records = array(
		array('id' => 1, 'title' => 'The title', 'body' => 'This is the post body.', 'created' => '2012-07-04 10:39:23', 'updated' => '2012-07-04 10:41:31'),
        array('id' => 2, 'title' => 'A title once again', 'body' => 'And the post body follows.', 'created' => '2012-07-04 10:41:23', 'updated' => '2012-07-04 10:43:31'),
        array('id' => 3, 'title' => 'Title strikes back', 'body' => 'This is really exciting! Not.', 'created' => '2012-07-04 10:43:23', 'updated' => '2012-07-04 10:45:31')
	);
}