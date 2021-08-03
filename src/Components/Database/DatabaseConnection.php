<?php
declare(strict_types=1);

namespace Components\Database;

use Components\ComponentsTrait;
use PDO;
use PDOStatement;

/**
 * Provides a class to receive a connection with the database.
 *
 * @package src\Database
 */
abstract class DatabaseConnection implements DatabaseConnectionInterface {

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
   * Connects with the database and executes the query.
   *
   * @param string $query
 *   The query to execute.
   * @param string[] $values
 *   The values to bind to the query.
   *
   * @throws \PDOException
   */
  public function __construct(string $query, array $values) {
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
   *   The PDO object.
   */
  protected function getConnection(): PDO {
    $dsn = $this->request()->env('database_server') . ';';
    $dsn .= 'dbname=' . $this->request()->env('database_name') . ';';
    $dsn .= 'charset=' . $this->request()->env('database_charset') . ';';
    $dsn .= 'port=' . $this->request()->env('database_port') . ';';

    $username = $this->request()->env('database_username');
    $password = $this->request()->env('database_password');

    $options = [
      PDO::ATTR_EMULATE_PREPARES => $this->request()->env('PDO_ATTR_EMULATE_PREPARES'),
      PDO::ATTR_ERRMODE => $this->request()->env('PDO_ATTR_ERROR_MODE')
    ];

    return new PDO($dsn, $username, $password, $options);
  }

  /**
   * Binds each value to the specified column in the query.
   *
   * @param string[] $values
   *   The values to bind to the query.
   *
   * @throws \PDOException
   */
  abstract protected function bindValues(array $values): void;

  /**
   * {@inheritDoc}
   */
  abstract public function fetchAll(int $fetchMethod, int $fetchArgument = NULL, array $ctorArgs = []): ?array;

  /**
   * {@inheritDoc}
   */
  abstract public function fetch(int $fetchMethod, int $cursorOrientation = PDO::FETCH_ORI_NEXT, int $cursorOffset = 0): array|object|null;

}
