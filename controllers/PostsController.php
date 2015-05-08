<?php

class PostsController extends BaseController {
    private $db;

    public function onInit() {
        $this->title = "Posts";
        $this->db = new PostsModel();
    }

    public function index() {
        $this->posts = $this->db->getAll();
    }

    public function create() {
        if ($this->isPost()) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            if ($this->db->create($title,$content)) {
                $this->addInfoMessage("Post created.");
                $this->redirect('posts');
            } else {
                $this->addErrorMessage("Error creating post.");
            }
        }
    }

    public function delete($id) {
        if ($this->db->deletePost($id)) {
            $this->addInfoMessage("Post deleted.");
        } else {
            $this->addErrorMessage("Cannot delete post.");
        }
        $this->redirect('posts');
    }
}