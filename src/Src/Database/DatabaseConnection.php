<?php

declare(strict_types=1);


namespace Src\Database;

use Components\ComponentsTrait;
use PDO;
use PDOStatement;

/**
 * Provides a class to receive a connection with the database.
 *
 * @package src\Database
 */
abstract class DatabaseConnection {

  use ComponentsTrait;

  /**
   * The PDO definition.
   *
   * @var \PDO
   */
  protected PDO $pdo;

  /**
   * The PDO statement definition.
   *
   * @var \PDOStatement
   */
  protected PDOStatement $statement;

  /**
   * The values to be used in the query.
   *
   * @var string[]
   */
  protected array $values = [];

  /**
   * The last inserted ID.
   *
   * @var int
   */
  protected int $lastInsertedId = 0;

  /**
   * Connect with the database and execute the query.
   *
   * @param string $query
 *   The query to execute.
   * @param string[] $values
 *   The values to bind to the query.
   *
   * @throws \PDOException
   */
  final public function __construct(string $query, array $values) {
    $this->pdo = $this->getConnection();

    $this->statement = $this->pdo->prepare($query);
    $this->values = $values;

    $this->bindValues($values);
    $this->statement->execute();

    $this->lastInsertedId = (int) $this->pdo->lastInsertId();
  }

  /**
   * Gets the connection with the database.
   *
   * @return \PDO
   */
  protected function getConnection(): PDO {
    $dsn = $this->request()->env('database_server') . ';';
    $dbName = 'dbname=' . $this->request()->env('database_name') . ';';
    $charset = 'charset=' . $this->request()->env('database_charset') . ';';
    $port = 'port=' . $this->request()->env('database_port') . ';';

    return new PDO(
          $dsn . $dbName . $charset . $port,
      $this->request()->env('database_username'),
      $this->request()->env('database_password'),
          [
            PDO::ATTR_EMULATE_PREPARES,
            $this->request()->env('PDO_ATTR_EMULATE_PREPARES'),
            PDO::ATTR_ERRMODE => $this->request()->env('PDO_ATTR_ERROR_MODE'),
          ]
      );
  }

  /**
   * Bind each value to the specified column in the query.
   *
   * @param string[] $values
   *   The values to bind to the query.
   *
   * @throws \PDOException
   * @codeCoverageIgnore
   */
  abstract protected function bindValues(array $values): void;

  /**
   * Fetch all records from the database with the given fetch method.
   *
   * @param int $fetchMethod
   *   The used method to fetch the database records.
   *
   * @return string[]|object[]|null
   */
  abstract public function fetchAll(int $fetchMethod): ?array;

  /**
   * Fetch one record from the database with the given fetch method.
   *
   * @param int $fetchMethod
   *   The used method to fetch the database record.
   *
   * @return string[]|object|null
   */
  abstract public function fetch(int $fetchMethod);

}
