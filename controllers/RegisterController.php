<?php

class RegisterController extends BaseController{

    protected function onInit() {
        if(!empty( $this->logged_user )){
            $this->redirect("home");
        }
        $this->title = "Register";
    }

    public function index(){
        if ($this->isPost()) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $cpassword = $_POST['confirm-password'];
            $email = $_POST['email'];

            if ($this->auth->login($username,$password,$cpassword,$email)) {
                $this->messages->addInfoMessage("Registration successful.");
                $this->redirect('home');
            } else {
                $this->messages->addErrorMessage("Error registering.");
            }
        }
    }

}
