<?php
class Message{
    public function addMessage($msgSessionkey, $msgText) {
        if (!isset($_SESSION[$msgSessionkey])) {
            $_SESSION[$msgSessionkey] = [];
        }
        array_push($_SESSION[$msgSessionkey], $msgText);

    }

    public function addErrorMessage($errorMsg)
    {
        $this->addMessage(ERROR_MESSAGES_SESSION_KEY, $errorMsg);
    }

    public function addInfoMessage($infoMsg)
    {
        $this->addMessage(INFO_MESSAGES_SESSION_KEY, $infoMsg);
    }
}