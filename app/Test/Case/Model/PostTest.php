<?php
App::uses('Post', 'Model');

class PostTest extends CakeTestCase {
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

	/**
	 * @test
	 */
	public function aNewPostIsSavedAndReflectsOriginalData() {
		$postData = array(
			'title'   => 'Test Post Title',
			'body'    => 'We love TDD. Yeah!',
			'created' => '2012-07-04 10:43:23',
			'updated' => '2012-07-04 10:45:31'
		);

		$numRecordsBeforePostSave = $this->Post->find('count');
		$result = $this->Post->addPost($postData);
		$numRecordsAfterPostSave = $this->Post->find('count');

		$expected = array(
            'Post' => array(
                'id'      => '4',
                'title'   => 'Test Post Title',
                'body'    => 'We love TDD. Yeah!',
                'created' => '2012-07-04 10:43:23',
                'updated' => '2012-07-04 10:45:31'
            )
        );

        $this->assertEquals($numRecordsBeforePostSave+1, $numRecordsAfterPostSave);
        $this->assertTrue($numRecordsBeforePostSave != $numRecordsAfterPostSave);
        $this->assertEquals($expected, $result);
	}

	/**
	 * @test
	 */
	public function editedPostShouldReflectNewData() {
		$this->Post->id = 3;
		$postData = array (
			'title' => 'Test Post Title. Updated.',
			'body' => 'We love TDD. Yeah! Yeah!',
			'created' => '2012-07-04 10:43:23',
			'updated' => '2012-07-04 10:49:51'
		);
		$postRecordBeforeEdit = $this->Post->read();
		$numRecordsBeforePostEdit = $this->Post->find('count');
		$result = $this->Post->editPost($postData);
		$numRecordsAfterPostEdit = $this->Post->find('count');

		$expected = array (
			'Post' => array (
				'id' => '3',
                'title' => 'Test Post Title. Updated.',
                'body' => 'We love TDD. Yeah! Yeah!',
                'created' => '2012-07-04 10:43:23',
                'updated' => '2012-07-04 10:49:51'
			)
		);

		$this->assertEquals($expected, $result);
		$this->assertTrue($numRecordsBeforePostEdit == $numRecordsAfterPostEdit);

		$recordCompare = array_diff($postRecordBeforeEdit['Post'], $result['Post']);
		$expectedArrayDiffResult = array (
			'title' => 'Title strikes back',
        	'body' => 'This is really exciting! Not.',
        	'updated' => '2012-07-04 10:45:31'
		);

		$this->assertEquals($expectedArrayDiffResult, $recordCompare);
	}

	/**
	 * @test
	 */
	public function postWithEmptyTitleDoesNotValidateModel () {
		$postData = array (
			'title' => '',
			'body'  => 'Oh no, this post has and empty title!'
		);
		$result = $this->Post->addPost($postData);
		$invalidFields = $this->Post->invalidFields();

		$this->assertFalse($result);
		$this->assertContains('This field cannot be left blank', $invalidFields['title']);
	}

	/**
	 * @test
	 */
	public function postWithEmptyBodyDoesNotValidateModel () {
		$postData = array (
			'title' => 'No body in the post? Impossible.',
			'body'  => ''
		);
		$result = $this->Post->addPost($postData);
		$invalidFields = $this->Post->invalidFields();

		$this->assertFalse($result);
		$this->assertContains('This field cannot be left blank', $invalidFields['body']);
	}

	/**
	 * @test
	 */
	public function postWithNotEmptyTitleAndBodyValidatesModel () {
		$postData = array (
			'title' => 'Title...',
			'body' => '... and body.'
		);
		$result = $this->Post->addPost($postData);
		$invalidFields = $this->Post->invalidFields();

		$this->assertFalse(empty($result));
		$this->assertTrue(empty($invalidFields));
	}	
}