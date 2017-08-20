<?php
/**
 * Created by PhpStorm.
 * User: alfasens
 * Date: 15.07.17
 * Time: 15:34
 */

namespace TasksApp;

/**
 * Class LogoutController represents log out from system.
 * @package TasksApp
 */
class LogoutController extends Controller
{
    public function __construct($view, $model)
    {
        $auth = new Auth();
        $auth->logout();
        $this->goToController("Index");
        parent::__construct(null, null);
    }
}