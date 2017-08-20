<?php
namespace TasksApp;

/**
 * Class TaskCreateController represents task creating form and process.
 * @package TasksApp
 */
class TaskCreateController extends Controller
{
    /**
     * TaskCreateController constructor.
     */
    public function __construct()
    {
        parent::__construct(new View("create"), array("auth" => new Auth()));
    }

    /**
     * Post method handler.
     */
    public function post()
    {
        if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["text"])
            || empty($_FILES["image"]["name"])) {
            $this->goToController("ErrorFields");
        }

        $imageUploader = new ImageUploader(320, 240);
        $imageUploader->execute();
        $task = new Task(null,
            htmlspecialchars($_POST["name"]),
            htmlspecialchars($_POST["email"]),
            htmlspecialchars($_POST["text"]),
            $imageUploader->getImgUrl(),
            "no"
        );

        $task->insert();

        $this->goToController("Index");
    }
}