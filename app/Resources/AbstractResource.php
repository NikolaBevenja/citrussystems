<?php


class AbstractResource
{
    public $pdo;
    public $host;
    public $database;
    public $user;
    public $pass;

    public function __construct()
    {
        $this->prepareResource();
    }

    public function prepareResource(){
        $host_file = BASE_DIR.DS.'app'.DS.'Db'.DS.'host.conf';
        if(file_exists($host_file)){
            $hostObj = json_decode(file_get_contents($host_file));
            $this->host = $hostObj->host;
            $this->database = $hostObj->database;
            $this->user = $hostObj->user;
            $this->pass = $hostObj->pass;
            $this->getPdo();
        }
    }

    /**
     * @return PDO Object
     */
    public function getPdo(){
        if(empty($this->pdo)){
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8mb4", $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->setPdo($pdo);
        }
        return $this->pdo;
    }

    /**
     * @param PDO $pdo
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}