<?php
namespace TasksApp;

require_once 'config.php';

/**
 * Class DBConnection.
 * @package TasksApp
 */
class DBConnection
{
    /**
     * @var \mysqli Link to connection.
     */
    private static $connection;

    /**
     * MySQLi open connection.
     */
    public static function open()
    {
        self::$connection = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
        mysqli_select_db(self::$connection, MYSQL_DB);
        mysqli_query(self::$connection, "SET NAMES " . MYSQL_CHARSET);
    }

    /**
     * MySQLi close connection.
     */
    public static function close()
    {
        mysqli_close(self::$connection);
    }

    /**
     * @return \mysqli Get link to connection.
     */
    public static function get()
    {
        return self::$connection;
    }
}