<?php
namespace TasksApp;

/**
 * Class Auth  Authorization/user class. Simplified class just for tests
 * @package TasksApp
 */
class Auth
{
    /** Admin login constant. */
    const ADMIN_LOGIN = "admin";

    /** Admin password constant. */
    const PASSWORD = "123";

    /**
     * Authorize with login & password.
     * @param string $login Login.
     * @param string $password Password.
     * @return bool  True, if login and password are correct.
     */
    public function login($login, $password)
    {
        if ($login == self::ADMIN_LOGIN && $password == self::PASSWORD) {
            setcookie("pass", md5(self::PASSWORD . self::ADMIN_LOGIN . self::PASSWORD), time() + 3600 * 24);
            return true;
        }
        return false;
    }

    /**
     * Log out from account.
     */
    public function logout()
    {
        setcookie("pass", "");
    }

    /**
     * Checks if user is logged in.
     */
    public function isLoggedIn()
    {
        return $_COOKIE["pass"] == md5(self::PASSWORD . self::ADMIN_LOGIN . self::PASSWORD);
    }
}