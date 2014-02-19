<?php
class PostControllerTest extends ControllerTestCase {
	public $fixtures = array ('app.post');

	/**
	 * @test
	 */
	public function indexMethodReturnsAllPosts() {
		$this->testAction('/posts/index');
		$this->assertInternalType('array', $this->vars['posts']);
		$expected = array(
			array(
				'id' => '2',
				'title' => 'A title once again'
			)
		);
		$result = Hash::extract($this->vars['posts'], '{n}.Post[id=2]');
		$this->assertEquals ($expected, $result);
	}

	/**
	 * @test
	 */
	public function viewActionSetsPostVarWithRequestedId() {
		$this->testAction('/posts/view/3');
		$this->assertInternalType('array', $this->vars['post']);
		$expected = array (
			'Post' => array (
				'id' => '3',
				'title' => 'Title strikes back',
				'body' => 'This is really exciting! Not.',
				'created' => '2012-07-04 10:43:23',
				'updated' => '2012-07-04 10:45:31'
			)
		);
		$this->assertEquals($expected, $this->vars['post']);
	}

	/**
	 * @test
	 */
	public function addPostWithValidDataShouldCreateNewPost () {
		$postData = array (
			'Post' => array (
				'title' => 'New Post Title',
				'body'  => 'TDD FTW!'
			)
		);

		$this->testAction('/posts/add', array(
			'data'   => $postData,
			'method' => 'post'
			));

		$this->assertStringEndsWith('/posts', $this->headers['Location']);
		$this->assertEquals(4, $this->controller->Post->find('count'));
	}

	/**
	 * @test
	 */
	public function addPostWithInalidDataShouldNotCreateNewPost () {
		$postData = array (
			'Post' => array (
				'title' => '',
				'body'  => 'TDD FTW!'
			)
		);

		$this->testAction('/posts/add', array(
			'data'   => $postData,
			'method' => 'post'
			));

		$this->assertTrue(!empty($this->controller->Post->validationErrors));
		$this->assertContains('This field cannot be left blank', $this->controller->Post->validationErrors['title']);
		$this->assertEquals(3, $this->controller->Post->find('count'));
		$this->assertTrue(empty($this->headers));
	}
}