<?php
App::uses('Post', 'Model');

class PostTest extends CakeTestCase {
	public $fixtures = array('app.post');

	public function setUp () {
		parent::setUp();
		$this->Post = ClassRegistry::init('Post');
	}

	//@test
	public function testAllPostsReturnsAllPostsIdsAndTitles() {
		 $result = $this->Post->getAllPosts();
		 $expected = array (
		 	array('Post' => array('id' => 1, 'title' => 'The title')),
            array('Post' => array('id' => 2, 'title' => 'A title once again')),
            array('Post' => array('id' => 3, 'title' => 'Title strikes back'))
		 );

		 $this->assertEquals($expected, $result);
	}
}