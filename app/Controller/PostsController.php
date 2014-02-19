<?php
App::uses('AppController', 'Controller');

class PostsController extends AppController {
	public function index() {
		$this->set('posts', $this->Post->getAllPosts());
	}

	public function view($id = null) {
		$this->set('post', $this->Post->getSinglePost($id));
	}

	public function add() {
		if ($this->request->is('post')) {
			if ($this->Post->addPost($this->request->data)) {
				$this->Session->setFlash('Your post has been saved.');
				return $this->redirect(array('action' => 'index'));
			}
		}
		$this->Session->setFlash('Unable to add your post.');
	}
}