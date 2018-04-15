<?php

namespace App\Database;

use \PDO;

class Database
{
    private $dbname;
    private $hostname;
    private $username;
    private $password;
    private $pdo;

    /**
     * Database constructor.
     * @param $dbname
     * @param $hostname
     * @param $username
     * @param $password
     */
    public function __construct($dbname, $hostname = '127.0.0.1', $username = 'root', $password = 'root')
    {
        $this->dbname = $dbname;
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->pdo;
    }

    /**
     * @return PDO
     */
    private function getPdo(): PDO
    {
        if (!$this->pdo) {
            $pdo = new PDO("mysql:dbname={$this->dbname};host={$this->hostname}",
                "{$this->username}",
                "{$this->password}",
                [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8']
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    /**
     * @param $statement
     * @return array
     */
    public function query($statement): array
    {
        $res = $this->getPdo()->query($statement)->fetchAll();
        return $res;
    }

    /**
     * @param $statement
     * @param $params
     * @param bool $one
     * @return array|mixed
     */
    public function prepare($statement, $params, $one = true)
    {
        $req = $this->getPdo()->prepare($statement);
        $req->execute([$params]);
        if ($one) {
            return $req->fetch();
        } else {
            return $req->fetchAll();
        }
    }
}