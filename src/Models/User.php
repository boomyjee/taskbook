<?php

namespace Models;

class User {

    static function auth() {
        if (isset($_SESSION['user'])) {
            return (object)['login'=>$_SESSION['user']];
        } 
        return false;
    }

    static function login($login,$password) {
        if ($login=='admin' && $password=='123') {
            $_SESSION['user'] = $login;
            return self::auth();            
        } else {
            return false;
        }
    }

    static function logout() {
        unset($_SESSION['user']);
    }
}