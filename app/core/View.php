<?php
namespace TasksApp;

/**
 * MVC View class.
 * @package TasksApp
 */
class View
{
    /**
     * @var string View filename without extension.
     */
    protected $viewFile;

    /**
     * @var string View directory path.
     */
    protected $viewPath;

    /**
     * View constructor.
     * @param $viewFile string  View filename without extension.
     */
    public function __construct($viewFile)
    {
        $this->viewFile = $viewFile;
        $this->viewPath = $_SERVER["DOCUMENT_ROOT"] . '/app/view/';
    }

    /**
     * Outputs the generated view.
     * @param object $data Model data
     */
    public function output($data)
    {
        $this->loadHeader($data);
        include $this->viewPath . $this->viewFile . ".php";
        $this->loadFooter($data);
    }

    /**
     * Outputs header view.
     */
    private function loadHeader($data)
    {
        include $this->viewPath . "header.php";
    }

    /**
     * Outputs footer view.
     */
    private function loadFooter($data)
    {
        include $this->viewPath . "footer.php";
    }
}