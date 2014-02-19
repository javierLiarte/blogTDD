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
}