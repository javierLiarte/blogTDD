<?php
class Post extends AppModel {
	public function getAllPosts() {
		return $this->find('all', array(
			'fields' => array ('id', 'title')
			));
	}
}