<?php

namespace Src\repositories\database;

class DBContext
{

    private \PDO $conn;

    public function __construct()
    {
        try {
            $this->conn = new \PDO(
                'mysql:host=' . DBConfig::SERVER_NAME . ';' . 'DBNAME=' . DBConfig::SERVER_NAME,
                DBConfig::USERNAME,
                DBConfig::PASSWORD
            );
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch (\PDOException  $e) {
            echo 'Connection failed: ' . $e->getMessage();
            die();
        }
    }

    public function getConnection(): \PDO
    {
        return $this->conn;
    }

    public function closeConnection(): void
    {
        $this->conn = null;
    }

    public function __destruct()
    {
        $this->conn = null;
    }

}
