<?php
namespace TasksApp;

/**
 * Class TaskEditController
 * @package TasksApp
 */
class TaskEditController extends Controller
{
    /**
     * TaskEditController constructor.
     */
     public function __construct()
     {
         $task = Task::getById((int)$_GET["id"]);
         $auth = new Auth();

         if (! $auth->isLoggedIn()) {
             $this->goToController("Index");
         }

         parent::__construct(new View("edit"), array('task' => $task, 'auth' => $auth));
     }

    /**
     * Post method handler.
     */
    protected function post()
    {
        $task = Task::getById((int)$_GET["id"]);
        $task->setDone(isset($_POST["done"]) && $_POST["done"] == "yes");
        $task->setText(htmlspecialchars(trim($_POST["text"])));
        $task->save();
        $this->goToController("Index");
    }
}