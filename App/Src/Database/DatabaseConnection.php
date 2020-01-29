<?php
declare(strict_types=1);


namespace Src\Database;

use PDO;
use PDOException;
use PDOStatement;
use Src\Core\Request;

abstract class DatabaseConnection
{
    protected PDO $pdo;
    protected PDOStatement $statement;
    protected array $values = [];
    protected int $lastInsertedId = 0;

    /**
     * Connect with the database and execute the query.
     *
     * @param string $query The query to execute
     * @param string[] $values The values to bind to the query
     *
     * @throws PDOException
     */
    final public function __construct(string $query, array $values)
    {
        $request = new Request();

        $dsn = $request->env('database_server') . ';';
        $dbName = 'dbname=' . $request->env('database_name') . ';';
        $charset = 'charset=' . $request->env('database_charset') . ';';
        $port = 'port=' . $request->env('database_port') . ';';

        $this->pdo = new PDO(
            $dsn . $dbName . $charset . $port,
            $request->env('database_username'),
            $request->env('database_password'),
            [
                PDO::ATTR_EMULATE_PREPARES,
                $request->env('PDO_ATTR_EMULATE_PREPARES'),
                PDO::ATTR_ERRMODE => $request->env('PDO_ATTR_ERROR_MODE')
            ]
        );

        $this->statement = $this->pdo->prepare($query);
        $this->values = $values;

        $this->bindValues($values);
        $this->statement->execute();

        $this->lastInsertedId = (int)$this->pdo->lastInsertId();
    }

    /**
     * Bind each value to the specified column in the query.
     *
     * @param string[] $values The values to bind to the query.
     *
     * @throws PDOException
     * @codeCoverageIgnore
     */
    abstract protected function bindValues(array $values): void;

    /**
     * Fetch all records from the database with the given fetch method.
     *
     * @param int $fetchMethod The used method to fetch the database records.
     *
     * @return string[]|object[]|null
     */
    abstract public function fetchAll(int $fetchMethod): ?array;

    /**
     * Fetch one record from the database with the given fetch method.
     *
     * @param int $fetchMethod The used method to fetch the database record.
     *
     * @return string[]|object|null
     */
    abstract public function fetch(int $fetchMethod);
}
