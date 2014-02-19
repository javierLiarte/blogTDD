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
}