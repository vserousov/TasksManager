<?php
namespace TasksApp;

/**
 * Class IndexController represents main page.
 * @package TasksApp
 */
class IndexController extends Controller
{
    /**
     * @var int  Number of tasks per page.
     */
    protected $tasksPerPage = 3;

    /**
     * @var string  Page get parameter.
     */
    protected $pageGetParameter = "page";

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $pager = new Pager("tasks", $this->tasksPerPage, $this->pageGetParameter);
        $tasks = Task::getList($pager, isset($_GET["sortBy"]) ? $_GET["sortBy"] : "id");
        parent::__construct(new View("index"), array("tasks" => $tasks, "pager" => $pager, "auth" => new Auth()));
    }

    protected function ajaxGet()
    {
        $pager = new Pager("tasks", $this->tasksPerPage, $this->pageGetParameter);
        $tasks = Task::getList($pager, $_GET["sortBy"]);
        echo Task::toJSON($tasks);
    }
}