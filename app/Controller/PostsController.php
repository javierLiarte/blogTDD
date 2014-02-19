<?php
App::uses('AppController', 'Controller');

class PostsController extends AppController {
	public function index() {
		$this->set('posts', $this->Post->getAllPosts());
	}

	public function view($id = null) {
		$this->set('post', $this->Post->getSinglePost($id));
	}
}