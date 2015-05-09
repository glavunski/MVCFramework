<?php

class UsersController extends BaseController {
    private $db;

    public function onInit() {
        $this->title = "Users";
        $this->db = new UsersModel();
    }

    public function index() {
        $this->users = $this->db->getAll();
    }

    public function delete($id) {
        if ($this->db->delete($id)) {
            $this->addInfoMessage("User deleted.");
        } else {
            $this->addErrorMessage("Cannot delete user.");
        }
        $this->redirect('users');
    }
}