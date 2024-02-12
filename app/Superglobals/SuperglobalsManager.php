<?php

namespace App\Superglobals;
class SuperglobalsManager
{
    public function getRequestData($key = null)
    {
        if ($key !== null) {
            return isset($_REQUEST[$key]) ? $_REQUEST[$key] : null;
        }
        return $_REQUEST;
    }

    public function getSessionData($key = null)
    {
        if ($key !== null) {
            return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
        }
        return $_SESSION;
    }
}
