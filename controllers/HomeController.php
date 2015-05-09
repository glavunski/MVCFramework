<?php

class HomeController extends BaseController {
    private $db;

    protected function onInit() {
        $this->title = 'Welcome';
        $this->db = new PostsModel();
    }

    public function index() {
        $this->posts = $this->db->getAll();
    }
}
