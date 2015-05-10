<?php


class HomeController extends BaseController {
    protected $db;
    protected $posts;

    protected function onInit() {
        $this->title = 'Welcome';
        $this->db = new PostsModel();
    }

    public function index() {
        $this->posts = $this->db->getAll();
    }

}
