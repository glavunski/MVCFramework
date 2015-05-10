<?php

class Auth {

    private static $session = null;
    private static $isLogged = false;
    private static $loggedUser = array();
    private static $isAdmin = false;

    private function __construct() {
        // Session lifetime = 30min
        session_set_cookie_params(1800,"/");
        session_start();

        if (!empty($_SESSION['username'])) {
            self::$isLogged = true;
            self::$loggedUser = Array($_SESSION['username'],$_SESSION['user_id'],
            isset($_SESSION['is_admin']));
            self::$isAdmin = isset($_SESSION['isAdmin']);
        }
    }

    public static function get_instance() {
        static $instance = null;

        if ( null === $instance ) {
            $instance = new static();
        }
        return $instance;
    }

    public function login( $username, $password ) {
        $db = Database::get_instance();
        $dbconn = $db->get_db();

        $statement = $dbconn->prepare("SELECT id,username,password,is_admin FROM users WHERE username = ? LIMIT 1" );
        $statement->bind_param('s',$username );
        $statement->execute();
        $result_set = $statement->get_result();
        $row = $result_set->fetch_assoc();

        if ($row !== null && password_verify($password,$row['password']) ) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id'];
            if($row['is_admin'] == 1){
                $_SESSION['isAdmin'] = 1 ;
            }
            return true;
        }

        return false;
    }

    public function register($username,$password,$confirm_password,$email) {

        if ($username == '' || $password == '') {
            return false;
        }
        if(strlen($username) < 5 || strlen($password) < 5) {
            return false;
        }
        if(strcmp($password,$confirm_password) != 0){
            return false;
        }
        $db = Database::get_instance();
        $dbconn = $db->get_db();

        $statement = $dbconn->prepare("SELECT COUNT(id) FROM users WHERE username = ?");
        $statement->bind_param('s',$username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        if($result['COUNT(id)']){
            return false;
        }

        $pass_hash = password_hash($password,PASSWORD_BCRYPT);

        $statement = $dbconn->prepare(
            "INSERT INTO users(username, password, email) VALUES(?, ?, ?)");
        $statement->bind_param('sss', $username,$pass_hash,$email);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function get_logged_user() {
        return self::$loggedUser;
    }

    public function isLoggedIn() {
        return self::$isLogged;
    }

    public function isAdmin() {
        return self::$isAdmin;
    }

    public function authorizeAdmin() {
        if (! $this->isAdmin()) {
            die('Administrator account is required!');
        }
    }

    public function authorizeUser() {
        if (! $this->isLoggedIn()) {
            die('User account is required!');
        }
    }

}