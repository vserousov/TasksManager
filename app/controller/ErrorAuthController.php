<?php
/**
 * Created by PhpStorm.
 * User: alfasens
 * Date: 15.07.17
 * Time: 15:30
 */

namespace TasksApp;

/**
 * Class ErrorAuthController.
 * @package TasksApp
 */
class ErrorAuthController extends Controller
{
    /**
     * ErrorFieldsController constructor.
     */
    public function __construct()
    {
        parent::__construct(new View("error"), array("title" => "Ошибка!",
            "text" => "Неверный логин или пароль" .
                "<a href='#' onclick='window.history.back(); return false'>Еще раз</a>."));
    }
}