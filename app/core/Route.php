<?php
namespace TasksApp;

require_once 'Controller.php';
require_once 'View.php';
require_once 'DBConnection.php';

/**
 * Class Route.
 * @package TasksApp
 */
class Route
{
    public static $applicationPath;

    /**
     * Application init method.
     */
    public static function init()
    {
        // Set application path
        self::$applicationPath = $_SERVER["DOCUMENT_ROOT"] . '/app/';
        
        // Load classes
        self::classLoad('controller/');
        self::classLoad('model/');
        
        // Open mysql db connection
        DBConnection::open();

        // Detect controller name by method
        if (isset($_GET["method"])) {
            $method = htmlspecialchars($_GET["method"]);
        } else {
            $method = "index";
        }

        // Controller class name
        $controllerClass = __NAMESPACE__ . '\\' . $method . "Controller";

        // Create controller object and execute
        $controller = new $controllerClass();
        if ($controller instanceof Controller) {
            $controller->execute();
        }

        // Close mysql db connection
        DBConnection::close();
    }

    /**
     * Class load function
     * @param $path string  Path with classes
     */
    private static function classLoad($path)
    {
        // Scan dir
        $files = scandir(self::$applicationPath . $path);
        
        // Remove dots from list
        array_shift($files);
        array_shift($files);
        
        // Include all files from dir
        foreach ($files as $file) {
            /** @noinspection PhpIncludeInspection */
            include self::$applicationPath . $path . $file;
        }
    }
}