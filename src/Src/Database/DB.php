<?php

declare(strict_types=1);


namespace Src\Database;

use Src\Database\Statements\BasicStatements;
use Src\Database\Statements\DataProcessingStatements;
use Src\Database\Statements\SelectStatements;
use Src\Database\Statements\WhereStatements;

/**
 * Provides a class to build queries and interact with the database.
 *
 * @package src\Database
 */
final class DB {
  use BasicStatements;
  use SelectStatements;
  use WhereStatements;
  use DataProcessingStatements;

  /**
   * The table to interact with.
   *
   * @var string
   */
  protected static string $table = '';

  /**
   * The query to be executed.
   *
   * @var string
   */
  protected string $query = '';

  /**
   * The values to be used in the query.
   *
   * @var string[]
   */
  protected array $values = [];

  /**
   * Set the table.
   *
   * @param string $table
   *   The table to execute the query on.
   *
   * @return DB
   */
  public static function table(string $table): DB {
    self::$table = $table;

    return new DB();
  }

  /**
   * Execute a self written query.
   *
   * @param string $query
   *   The query to be executed.
   * @param string[] $values
   *   The values to bind to the query.
   *
   * @return DatabaseProcessor
   *
   * @throws \PDOException
   */
  public static function query(
        string $query,
        array $values = []
    ): DatabaseProcessor {
    return new DatabaseProcessor($query, $values);
  }

  /**
   * @inheritDoc
   */
  public function execute(): DatabaseProcessor {
    $this->addHooksForInnerJoins();

    return new DatabaseProcessor($this->query, $this->values);
  }

  /**
   * Add a statement to the query.
   *
   * @param string $statement
   *   the statement to be added to the query.
   *
   * @return DB
   */
  public function addStatement(string $statement): DB {
    if (str_contains($this->query, 'WHERE')) {
      $statement = preg_replace(
            '/\b(WHERE)\b/',
            'AND',
            $statement
        );
    }

    $this->query .= $statement;

    return $this;
  }

  /**
   * Add a statement with values to the query.
   *
   * @param string $statement
   * @param string[] $values
   *
   * @return DB
   */
  public function addStatementWithValues(string $statement, array $values): DB {
    if (str_contains($this->query, 'WHERE')) {
      $statement = replace_string(
            'WHERE',
            'AND',
            $statement
        );
    }
    elseif (preg_match_all('/\b(WHERE)\b/', $statement) !== FALSE) {
      $statement = replace_all_except_first_string(
            'WHERE',
            'AND',
            $statement
            );
    }

    $this->query .= $statement;
    $this->addValues($values);

    return $this;
  }

  /**
   * Gets the query.
   *
   * @return string
   */
  public function getQuery(): string {
    $this->addHooksForInnerJoins();

    return $this->query;
  }

  /**
   * Add values to the query. These values will be used when the query is
   * going to be executed.
   *
   * @param string[] $values
   *
   * @return void
   */
  public function addValues(array $values): void {
    foreach ($values as $column => $condition) {
      $this->values[$column] = $condition;
    }
  }

  /**
   * Gets the values of the query.
   *
   * @return string[]
   */
  public function getValues(): array {
    return $this->values;
  }

  /**
   * Counts the amount of inner joins in the query.
   *
   * @return int
   */
  protected function countInnerJoinsInQuery(): int {
    return (int) preg_match_all('/\b(JOIN)\b/', $this->query);
  }

  /**
   * Add hooks for inner joins to the query. The hooks will only be added
   * when there are inner joins used.
   *
   * This function should be called when
   * the query is going to be executed or
   * you want to get the query.
   */
  protected function addHooksForInnerJoins(): void {
    if ($this->countInnerJoinsInQuery() === 0) {
      return;
    }

    $hooks = '';
    for ($x = 0; $x < $this->countInnerJoinsInQuery(); $x++) {
      $hooks .= '(';
    }

    $this->query = (string) preg_replace(
          '/\b(FROM)\b/',
          "FROM {$hooks}",
          $this->query
      );

    if ($this->countInnerJoinsInQuery() === 1) {
      $this->query = (string) preg_replace(
            '/[()]/',
            '',
            $this->query
        );
    }
  }

}
