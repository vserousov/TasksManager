<?php
namespace TasksApp;

use Exception;

/**
 * Class Task
 * @package TasksApp
 */
class Task
{
    /** @var int  Task id. */
    protected $id;

    /** @var string  Task name. */
    protected $name;

    /** @var string  Task email. */
    protected $email;

    /** @var string  Task text. */
    protected $text;

    /** @var string  Task image url. */
    protected $imgUrl;

    /** @var boolean  Is task done. */
    protected $done;

    /**
     * Task constructor.
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string $text
     * @param string $imgUrl
     * @param boolean $done
     */
    public function __construct($id, $name, $email, $text, $imgUrl, $done)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->text = $text;
        $this->imgUrl = $imgUrl;
        $this->done = $done;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    /**
     * @param string $imgUrl
     */
    public function setImgUrl($imgUrl)
    {
        $this->imgUrl = $imgUrl;
    }

    /**
     * @return boolean
     */
    public function isDone()
    {
        return $this->done;
    }

    /**
     * @param boolean $done
     */
    public function setDone($done)
    {
        $this->done = $done;
    }

    /**
     * Save task, update database.
     */
    public function save()
    {
        mysqli_query(DBConnection::get(),
            "UPDATE tasks SET `name` = '" . mysqli_real_escape_string(DBConnection::get(), $this->name) . "'," .
            "`email` = '" . mysqli_real_escape_string(DBConnection::get(), $this->email) . "'," .
            "`text` = '" . mysqli_real_escape_string(DBConnection::get(), $this->text) . "'," .
            "`imgUrl` = '" . mysqli_real_escape_string(DBConnection::get(), $this->imgUrl) . "'," .
            "`done` = '" . mysqli_real_escape_string(DBConnection::get(), $this->done) . "'" .
            " WHERE id='" . mysqli_real_escape_string(DBConnection::get(), $this->id) . "'")
        or die(mysqli_error(DBConnection::get()));
    }

    /**
     * Insert task object data in database.
     */
    public function insert()
    {
        mysqli_query(DBConnection::get(),
            "INSERT INTO tasks (`name`, `email`, `text`, `imgUrl`, `done`)" .
            "VALUES ('" . mysqli_real_escape_string(DBConnection::get(), $this->name) . "'," .
            "'" . mysqli_real_escape_string(DBConnection::get(), $this->email) . "'," .
            "'" . mysqli_real_escape_string(DBConnection::get(), $this->text) . "'," .
            "'" . mysqli_real_escape_string(DBConnection::get(), $this->imgUrl) . "'," .
            "'" . mysqli_real_escape_string(DBConnection::get(), $this->done) . "'" .
            ")");

    }

    /**
     * Returns this object to array format.
     * @return array  Array object.
     */
    public function toArray()
    {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'text' => $this->text,
            'imgUrl' => $this->imgUrl,
            'done' => $this->done
        );
    }

    /**
     * @param array $tasks Array of tasks.
     * @return mixed  JSON format of tasks.
     */
    public static function toJSON($tasks)
    {
        $jsonTasks = array();
        foreach ($tasks as $task) {
            $jsonTasks[] = $task->toArray();
        }

        return json_encode($jsonTasks);
    }

    /**
     * @param Pager $pager Pager object.
     * @param string $sortBy Sort parameter.
     * @return array Array of tasks.
     * @throws Exception  Throws, if illegal sort parameted is used
     */
    public static function getList($pager, $sortBy = "id")
    {
        // Sort allow parameters
        $sortAllow = array('id', 'name', 'email', 'done');

        // Disallow sorting by other parameters, throw exception
        if (!in_array($sortBy, $sortAllow)) {
            throw new Exception("Task can't be sorted by that parameter.");
        }

        $number = $pager->getElementsPerPage();
        $page = $pager->getCurrentPage();

        // Array with tasks
        $arrayTasks = array();

        // Start parameter for query
        $start = $number * $page;

        // Query to database
        $query = mysqli_query(DBConnection::get(),
            "SELECT `id`, `name`, `email`, `text`, `imgUrl`, `done` FROM tasks ORDER BY " . $sortBy . " DESC LIMIT "
            . $start . ", " . $number);

        // Extract data from db to array
        while ($arr = mysqli_fetch_assoc($query)) {
            $done = $arr["done"] == "yes" ? true : false;
            $arrayTasks[] = new Task($arr["id"], $arr["name"], $arr["email"], $arr["text"], $arr["imgUrl"], $done);
        }

        return $arrayTasks;
    }

    /**
     * Get task by id
     * @param int $id Task id
     * @return Task  Task object
     */
    public static function getById($id)
    {
        // Query to database
        $query = mysqli_query(DBConnection::get(),
            "SELECT `id`, `name`, `email`, `text`, `imgUrl`, `done` FROM tasks WHERE id = '" . $id . "' LIMIT 1");

        // Extract data from db to array
        $arr = mysqli_fetch_assoc($query);
        $done = $arr["done"] == "yes" ? true : false;
        $task = new Task($arr["id"], $arr["name"], $arr["email"], $arr["text"], $arr["imgUrl"], $done);
        return $task;
    }
}