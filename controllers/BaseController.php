<?php

abstract class BaseController {
    protected $controller;
    protected $action;
    protected $layout = DEFAULT_LAYOUT;
    protected $viewBag = [];
    protected $messages;
    protected $viewRendered = false;
    protected $title;
    protected $auth;

    public function __construct($controller, $action) {
        $this->controller = $controller;
        $this->action = $action;
        $this->messages = new Message();
        $this->auth = Auth::get_instance();
        $this->onInit();
    }

    public function __get($name) {
        // Properties come from $this->viewBag
        if (isset($this->viewBag[$name])) {
            return $this->viewBag[$name];
        }
        // Fallback to $this
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }

    public function __set($name, $value) {
        // Non-existing properties are stored in $this->viewBag
        $this->viewBag[$name] = $value;
    }

    protected function onInit() {
        // Override this function in subclasses to initialize
        // the controller
    }

    public function index() {
        $this->renderView();
    }

    public function renderView($viewName = null, $isPartial = false) {
        if (!$this->viewRendered) {
            if ($viewName == null) {
                $viewName = $this->action;
            }
            if (!$isPartial) {
                include_once('views/layouts/' . $this->layout . '/header.php');
            }
            include_once('views/' . $this->controller . '/' . $viewName . '.php');
            if (!$isPartial) {
                include_once('views/layouts/' . $this->layout . '/footer.php');
            }
            $this->viewRendered = true;
        }
    }

    protected function redirectToUrl($url) {
        header("Location: $url");
        die;
    }

    protected function redirect($controller = null, $action = null, $params = []) {
        if ($controller == null) {
            $controller = $this->controller;
        }
        $url = "/$controller/$action";
        $paramsUrlEncoded = array_map('urlencode', $params);
        $paramsJoined = implode('/', $paramsUrlEncoded);
        if ($paramsJoined != '') {
            $url .= '/' . $paramsJoined;
        }
        $this->redirectToUrl($url);
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public function logout(){
        session_destroy();
        $this->redirect("home");
    }

}
