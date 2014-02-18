<?php
class Post extends AppModel {
	public function getAllPosts() {
		return $this->find('all', array(
			'fields' => array ('id', 'title')
			));
	}

	public function getSinglePost($id = null) {
		return $this->find('first', array (
			'conditions' => array('id' => $id)
		));
	}

	public function addPost ($postData) {
		return $this->save($postData);
	}
}