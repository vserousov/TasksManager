<?php
namespace TasksApp;

/**
 * Class AuthController represents admin authorization.
 * @package TasksApp
 */
class AuthController extends Controller 
{
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        parent::__construct(new View("auth"), array("auth" => new Auth()));
    }

    /**
     * Post method handler.
     */
    protected function post()
    {
        $auth = new Auth();
        if ($auth->login($_POST["login"], $_POST["password"])) {
            $this->goToController("Index");
        } else {
            $this->goToController("errorAuth");
        }
    }
}