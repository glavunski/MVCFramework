<?php

class PostsController extends BaseController {
    private $db;

    public function onInit() {
        $this->title = "Posts";
        $this->db = new PostsModel();
    }

    public function index(){
        $this->redirect("home");
    }

    public function create() {
        $this->auth->authorizeUser();
        if ($this->isPost()) {
            $userId = $this->auth->get_logged_user()[1];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $tags = $_POST['tags'];
            if ($this->db->create($title,$content,$tags,$userId)) {
                $this->messages->addInfoMessage("Post created.");
                $this->redirect('posts');
            } else {
                $this->messages->addErrorMessage("Error creating post.");
            }
        }
    }

    public function delete($id) {
        $this->auth->authorizeUser();
        if ($this->db->delete($id)) {
            $this->messages->addInfoMessage("Post deleted.");
        } else {
            $this->messages->addErrorMessage("Cannot delete post.");
        }
        $this->redirect('home');
    }

    public function view($id){
        $post = $this->db->find($id);
        if(empty($post)) {
            die('No post to view here');
        }
        $this->post = $post;
    }

    public function page($p = 0,$ps = 5){
        $this->page = $p;
        $this->pagesize = $ps;

        if($p <= 1){
            $this->redirect('home');
        }
        $this->posts = $this->db->getFilteredPosts($p,$ps);
    }

    public function tags($tagname){

    }
}