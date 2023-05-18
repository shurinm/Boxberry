<?php

namespace config;

use Exception;
use PDO;
use PDOException;

class DB
{
    private $host = 'localhost';
    private $dbname = 'boxberry';
    private $user = 'root';
    private $password = 'root';
    private $pdo;
    private static $instance;

    private function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->dbname,
                $this->user,
                $this->password
            );
            $this->pdo->exec('SET NAMES UTF8');
        } catch (PDOException $e) {
            echo 'Error!: ' . $e->getMessage();
        }

    }

    /**
     * Prepare and Execute SQL query
     * @param string $sql
     * @param array $params
     * @return array|null
     * @throws Exception
     */
    public function query(string $sql, $params = []): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);
        if (false === $result) {
            throw new Exception(implode('; ', $sth->errorInfo()));
        }
        return $sth->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Connect to the database
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}