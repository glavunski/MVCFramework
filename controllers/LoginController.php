<?php

class LoginController extends BaseController{

    protected function onInit() {
        if(!empty( $this->logged_user )){
            $this->redirect("home");
        }
        $this->title = "Login";
    }

    public function index(){
        if ($this->isPost()) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($this->auth->login($username,$password)) {
                $this->messages->addInfoMessage("Login successful.");
                $this->redirect('home');
            } else {
                $this->messages->addErrorMessage("Error logging in.");
            }
        }
    }
}
