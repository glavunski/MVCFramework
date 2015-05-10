<?php

class AdminController extends BaseController {
    private $db;
    private $users;

    public function onInit() {
        $this->title = "Admin";
        $this->auth->authorizeAdmin();
        $this->db = new AdminModel();
    }

    public function index() {
        $this->users = $this->db->getAll();
    }

    public function delete($id) {
        if ($this->db->delete($id)) {
            $this->messages->addInfoMessage("User deleted.");
        } else {
            $this->messages->addErrorMessage("Cannot delete user.");
        }
        $this->redirect('users');
    }
}