<?php

namespace App\Core;

use PDO;
use PDOException;
use PDOStatement;

/**
 * Core Model Class
 * Connect to database
 * Create prepared statements
 */
class Model
{
    private string $host = DB_HOST;
    private string $user = DB_USER;
    private string $pass = DB_PASS;
    private string $dbName = DB_NAME;

    // Database handler
    private PDO $dbh;

    //Database statement
    private PDOStatement $stmt;

    //Error handler
    private string $error;

    private string $query = '';
    private array $conditionValues = [];

    public function __construct()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbName}";
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    private function resetVariables()
    {
        $this->conditionValues = [];
        $this->query = '';
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case  is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case  is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case  is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    private function execute($values = []): bool
    {
        $this->stmt = $this->dbh->prepare($this->query);
        return $this->stmt->execute($values);
    }

    protected function results(): array
    {
        $this->execute($this->conditionValues);
        $results = $this->stmt->fetchAll(PDO::FETCH_OBJ);

        $this->resetVariables();
        return $results;
    }

    protected function row()
    {
        $this->execute($this->conditionValues);
        $result = $this->stmt->fetch(PDO::FETCH_OBJ);

        $this->resetVariables();
        return $result;
    }

    protected function select(string $fields)
    {
        $this->query .= "SELECT {$fields}";
    }

    protected function from(string $tableName)
    {
        $this->query .= " FROM {$tableName}";
    }

    protected function where($fieldName, $value)
    {
        if(count($this->conditionValues) > 0) {
            $this->query .= " AND {$fieldName} = :{$fieldName}";
        } else {
            $this->query .= " WHERE {$fieldName} = :{$fieldName}";
        }

        $this->conditionValues[$fieldName] = $value;
    }

    protected function insert(string $tableName, array $data): bool
    {
        $keys = array_keys($data);
        $keysString = implode(', ', $keys);
        $params = array_map(function ($item) {
            return ":{$item}";
        }, $keys);
        $paramsString = implode(', ', $params);

        $this->query .= "INSERT INTO {$tableName}({$keysString}) values({$paramsString})";
        $result = $this->execute($data);

        $this->resetVariables();
        return $result;
    }
}