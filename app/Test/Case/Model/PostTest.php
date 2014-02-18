<?php
App::uses('Post', 'Model');

class PostTest extends PHPUnit_Framework_TestCase {
	public $fixtures = array('app.post');

	public function setUp () {
		parent::setUp();
		$this->Post = ClassRegistry::init('Post');
	}

	/**
	 * @test
	 */
	public function getAllPostsReturnsAllPostsIdsAndTitles() {
		 $result = $this->Post->getAllPosts();
		 $expected = array (
		 	array('Post' => array('id' => 1, 'title' => 'The title')),
            array('Post' => array('id' => 2, 'title' => 'A title once again')),
            array('Post' => array('id' => 3, 'title' => 'Title strikes back'))
		 );

		 $this->assertEquals($expected, $result);
	}

	/**
	 * @test
	 */
	public function getSinglePostForId2ReturnsCorrectPostData() {
		$result = $this->Post->getSinglePost (2);
		$expected = array (
			'Post' => array(
				'id' => '2',
				'title' => 'A title once again',
                'body' => 'And the post body follows.',
                'created' => '2012-07-04 10:41:23',
                'updated' => '2012-07-04 10:43:31'
			)
		);
		$this->assertEquals($expected,$result);
	}
}