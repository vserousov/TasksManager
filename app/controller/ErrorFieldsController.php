<?php
/**
 * Created by PhpStorm.
 * User: alfasens
 * Date: 14.07.17
 * Time: 21:32
 */

namespace TasksApp;

/**
 * Class ErrorController.
 * @package TasksApp
 */
class ErrorFieldsController extends Controller
{
    /**
     * ErrorFieldsController constructor.
     */
    public function __construct()
    {
        parent::__construct(new View("error"), array("title" => "Ошибка!",
            "text" => "Все поля должны быть заполнены." . 
                      "<a href='#' onclick='window.history.back(); return false'>Еще раз</a>."));
    }
}