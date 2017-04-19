<?
session_start();

    function setSessionData($key, $object) {
        $_SESSION[$key] = $object;
    }

    function getSessionData($key) {
        return $_SESSION[$key];
    }

    

?>
