<?php
namespace TasksApp;

/** 
 * MVC Controller class.
 * @package TasksApp
 */
class Controller
{
    /** @var View  View object. */
    protected $view;
    
    /** @var object  Model object. */ 
    protected $model;

    /**
     * Controller constructor.
     * @param null $view View object.
     * @param null $model Model object.
     */
    public function __construct($view = null, $model = null)
    {
        $this->view = $view;
        $this->model = $model;
    }

    /**
     * System execute function.
     */
    public function execute()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $ajax = $_SERVER["HTTP_X_REQUESTED_WITH"] == 'XMLHttpRequest';

        if ($ajax) {
            if ($requestMethod == "POST") {
                $this->ajaxPost();
            } else {
                $this->ajaxGet();
            }
            die;
        } else {
            if ($requestMethod == "POST") {
                $this->post();
            } else {
                $this->get();
            }
        }

        if ($this->view instanceof View) {
            $this->view->output($this->model);
        }
    }

    /**
     * Change page to another controller.
     * @param string $controller  Controller name
     */
    protected function goToController($controller) 
    {
        header("Location: /index.php?method=".$controller);
        die;
    }
    
    /**
     * Http Get handler.
     */
    protected function get() {}

    /**
     * Http Post handler
     */
    protected function post() {}
    
    /** 
     * Http Ajax Get handler.
     */
    protected function ajaxGet() {}

    /**
     * Http Ajax Post handler.
     */
    protected function ajaxPost() {}
}

