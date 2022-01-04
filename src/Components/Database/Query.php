<?php
declare(strict_types=1);

namespace Components\Database;

use JetBrains\PhpStorm\Pure;
use PDO;
use stdClass;

/**
 * Provides a class to build queries and interact with the database.
 *
 * @package Components\Database
 */
final class Query implements QueryInterface {

  /**
   * Query constructor.
   *
   * @param string $table
   *   The table to interact with
   * @param string $query
   *   The query to be built and executed.
   * @param array $values
   *   The values of the query.
   */
  public function __construct(
    protected readonly string $table,
    protected string $query = '',
    protected array $values = []
  ) {}

  /**
   * {@inheritDoc}
   */
  public function select(...$columns): QueryInterface {
    $queryColumns = $this->columnsToString($columns);
    $this->addStatement("SELECT {$queryColumns} FROM {$this->table} ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function selectUnion(...$columns): QueryInterface {
    $queryColumns = $this->columnsToString($columns);
    $this->addStatement("UNION SELECT {$queryColumns} FROM {$this->table} ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function selectUnionAll(...$columns): QueryInterface {
    $queryColumns = $this->columnsToString($columns);
    $this->addStatement("UNION ALL SELECT {$queryColumns} FROM {$this->table} ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function selectDistinct(...$columns): QueryInterface {
    $queryColumns = $this->columnsToString($columns);
    $this->addStatement("SELECT DISTINCT {$queryColumns} FROM {$this->table} ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function selectMin(...$columns): QueryInterface {
    $queryColumns = $this->columnsToString($columns);
    $this->addStatement("SELECT MIN({$queryColumns}) FROM {$this->table} ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function selectMax(...$columns): QueryInterface {
    $queryColumns = $this->columnsToString($columns);
    $this->addStatement("SELECT MAX({$queryColumns}) FROM {$this->table} ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function selectCount(...$columns): QueryInterface {
    $queryColumns = $this->columnsToString($columns);
    $this->addStatement("SELECT COUNT({$queryColumns}) FROM {$this->table} ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function selectAvg(...$columns): QueryInterface {
    $queryColumns = $this->columnsToString($columns);
    $this->addStatement("SELECT AVG({$queryColumns}) FROM {$this->table} ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function selectSum(...$columns): QueryInterface {
    $queryColumns = $this->columnsToString($columns);
    $this->addStatement("SELECT SUM({$queryColumns}) FROM {$this->table} ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function innerJoin(string $table, string $tableOneColumn, string $tableTwoColumn): QueryInterface {
    $this->addStatement("INNER JOIN {$table} ON {$tableOneColumn} = {$tableTwoColumn}) ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function leftJoin(string $table, string $tableOneColumn, string $tableTwoColumn): QueryInterface {
    $this->addStatement("LEFT JOIN {$table} ON {$tableOneColumn} = {$tableTwoColumn}) ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function rightJoin(string $table, string $tableOneColumn, string $tableTwoColumn): QueryInterface {
    $this->addStatement("RIGHT JOIN {$table} ON {$tableOneColumn} = {$tableTwoColumn}) ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function fullOuterJoin(string $table, string $tableOneColumn, string $tableTwoColumn): QueryInterface {
    $this->addStatement("FULL OUTER JOIN {$table} ON {$tableOneColumn} = {$tableTwoColumn}) ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function where(string $column, string $operator, string $condition): QueryInterface {
    $bindColumn = str_replace('.', '', $column);

    $this->addStatement("WHERE {$column} {$operator} :{$bindColumn} ");
    $this->addValues([$bindColumn => $condition]);

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function whereExists(string $query, array $values): QueryInterface {
    $this->addStatement("WHERE EXISTS ({$query}) ");
    $this->addValues($values);

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function whereAny(string $column, string $operator, string $query, array $values): QueryInterface {
    $this->addStatement("WHERE {$column} {$operator} ANY ({$query}) ");
    $this->addValues($values);

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function whereAll(string $column, string $operator, string $query, array $values): QueryInterface {
    $this->addStatement("WHERE {$column} {$operator} ALL ({$query}) ");
    $this->addValues($values);

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function whereNot(string $column, string $operator, string $condition): QueryInterface {
    $this->addStatement("WHERE NOT {$column} {$operator} :{$column} ");
    $this->addValues([$column => $condition]);

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function whereIsNull(...$columns): QueryInterface {
    $queryColumns = $this->columnsToString($columns);
    $this->addStatement("WHERE {$queryColumns} IS NULL ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function whereIsNotNull(...$columns): QueryInterface {
    $queryColumns = $this->columnsToString($columns);
    $this->addStatement("WHERE {$queryColumns} IS NOT NULL ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function whereInValue(string $column, array $condition): QueryInterface {
    $bindColumns = [];
    foreach ($condition as $key => $value) {
      $bindColumns[] = $column . $key;

      $this->addValues([$column . $key => $value]);
    }

    $bindColumns = ':' . implode(', :', $bindColumns);
    $this->addStatement("WHERE {$column} IN ({$bindColumns}) ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function whereNotInValue(string $column, ...$condition): QueryInterface {
    $bindColumns = [];
    foreach ($condition as $key => $value) {
      $bindColumns[] = $column . $key;

      $this->addValues([$column . $key => $value]);
    }

    $bindColumns = ':' . implode(', :', $bindColumns);
    $this->addStatement("WHERE {$column} NOT IN ({$bindColumns}) ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function whereOr(string $column, ...$values): QueryInterface {
    $query = '';
    foreach ($values as $key => $value) {
      $bindColumn = $column . $key;

      $this->addValues([$bindColumn => $value]);

      if (str_contains($query, 'WHERE')) {
        $query .= "OR {$column} = :{$bindColumn} ";
        continue;
      }

      $query .= "WHERE {$column} = :{$bindColumn} ";
    }

    $this->addStatement($query);

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function whereInQuery(string $column, string $query, array $values): QueryInterface {
    $this->addStatement("WHERE {$column} IN ({$query}) ");
    $this->addValues($values);

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function whereBetween(string $column, string $start, string $end): QueryInterface {
    $this->addStatement("WHERE {$column} BETWEEN :{$column}Start AND :{$column}End ");
    $this->addValues([$column . 'Start' => $start, $column . 'End' => $end,]);

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function whereNotBetween(string $column, string $start, string $end): QueryInterface {
    $this->addStatement("WHERE {$column} NOT BETWEEN :{$column}Start AND :{$column}End ");
    $this->addValues([$column . 'Start' => $start, $column . 'End' => $end,]);

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function whereOrBetween(string $column, string $start, string $end): QueryInterface {
    $this->addStatement("OR {$column} BETWEEN :{$column}Start AND :{$column}End ");
    $this->addValues([$column . 'Start' => $start, $column . 'End' => $end,]);

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function whereAttributes(array $attributes, string $operator = '='): QueryInterface {
    foreach ($attributes as $column => $value) {
      $this->where($column, $operator, $value);
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function having(...$conditions): QueryInterface {
    $implodedConditions = implode(', ', $conditions);
    $this->addStatement("HAVING {$implodedConditions} ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function insert(array $values): int {
    $columns = implode(', ', array_keys($values));
    $bindColumns = ':' . implode(', :', array_keys($values));

    $this->addStatement("INSERT INTO {$this->table} ({$columns}) VALUES ({$bindColumns}) ");
    $this->addValues($values);

    return $this->execute()->getLastInsertedId();
  }

  /**
   * {@inheritDoc}
   */
  public function update(array $values): QueryInterface {
    $this->addStatement("UPDATE {$this->table} SET ");

    $bindColumns = array_keys($values);
    foreach ($bindColumns as $bindColumn) {
      $comma = array_key_last($values) !== $bindColumn ? ',' : '';

      $this->addStatement("{$bindColumn} = :{$bindColumn}{$comma} ");
    }

    $this->addValues($values);

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function delete(string $column, int $status): QueryInterface {
    $this->update([$column => $status]);

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function permanentDelete(): QueryInterface {
    $this->addStatement("DELETE FROM {$this->table} ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function orderBy(string $filter, ...$columns): QueryInterface {
    $implodedColumns = $this->columnsToString($columns);
    $this->addStatement("ORDER BY {$implodedColumns} {$filter} ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function groupBy(...$columns): QueryInterface {
    $implodedColumns = $this->columnsToString($columns);
    $this->addStatement("GROUP BY {$implodedColumns} ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function limit(int $limit = 1): QueryInterface {
    $this->addStatement("LIMIT {$limit} ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function execute(): DatabaseProcessorInterface {
    return new DatabaseProcessor($this->getQuery(), $this->getValues());
  }

  /**
   * {@inheritDoc}
   */
  public function fetchAll(int $fetchMethod, $fetchArgument = NULL, array $ctorArgs = []): ?array {
    return $this->execute()->fetchAll($fetchMethod, $fetchArgument, $ctorArgs);
  }

  /**
   * {@inheritDoc}
   */
  public function fetch(int $fetchMethod, $cursorOrientation = PDO::FETCH_ORI_NEXT, $cursorOffset = 0): array|object|null {
    return $this->execute()->fetch($fetchMethod, $cursorOrientation, $cursorOffset);
  }

  /**
   * {@inheritDoc}
   */
  public function get(): ?array {
    return $this->execute()->all();
  }

  /**
   * {@inheritDoc}
   */
  public function all(): ?array {
    return $this->execute()->all();
  }

  /**
   * {@inheritDoc}
   */
  public function allToArray(): array {
    return $this->execute()->allToArray();
  }

  /**
   * {@inheritDoc}
   */
  public function allToClass(string $class): array {
    return $this->execute()->allToClass($class);
  }

  /**
   * {@inheritDoc}
   */
  public function first(): ?stdClass {
    return $this->execute()->first();
  }

  /**
   * {@inheritDoc}
   */
  public function firstToArray(): array {
    return $this->execute()->firstToArray();
  }

  /**
   * {@inheritDoc}
   */
  public function firstToClass(string $class): ?object {
    return $this->execute()->firstToClass($class);
  }

  /**
   * {@inheritDoc}
   */
  public function getLastInsertedId(): int {
    return $this->execute()->getLastInsertedId();
  }

  /**
   * {@inheritDoc}
   */
  public function addStatement(string $statement): Query {
    if (str_contains($this->query, 'WHERE')) {
      $statement = preg_replace(pattern: '/\b(WHERE)\b/', replacement: 'AND', subject: $statement);
    }

    $this->query .= $statement;

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function addStatementWithValues(string $statement, array $values): QueryInterface {
    if (str_contains($this->query, 'WHERE')) {
      $statement = replace_string(remove: 'WHERE', replace: 'AND', subject: $statement);
    } elseif (preg_match_all('/\b(WHERE)\b/', $statement) !== FALSE) {
      $statement = replace_all_except_first_string(remove: 'WHERE', replace: 'AND', subject: $statement);
    }

    $this->query .= $statement;
    $this->addValues($values);

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getQuery(): string {
    $this->addHooksForJoins();

    return $this->query;
  }

  /**
   * {@inheritDoc}
   */
  public function addValues(array $values): void {
    foreach ($values as $column => $condition) {
      $this->values[$column] = $condition;
    }
  }

  /**
   * {@inheritDoc}
   */
  public function getValues(): array {
    return $this->values;
  }

  /**
   * {@inheritDoc}
   */
  #[Pure] public function columnsToString(array $columns): string {
    return implode(',', $columns);
  }

  /**
   * Counts the amount of inner joins in the query.
   *
   * @return int
   */
  protected function countJoins(): int {
    return (int) preg_match_all('/\b(JOIN)\b/', $this->query);
  }

  /**
   * Adds hooks for inner joins to the query. The hooks will only be added when
   * there are inner joins used.
   *
   * This function should be called when the query is going to be executed or
   * you want to get the query.
   */
  protected function addHooksForJoins(): void {
    $countedJoins = $this->countJoins();
    if ($countedJoins === 0) {
      return;
    }

    $hooks = '';
    for ($x = 0; $x < $countedJoins; $x++) {
      $hooks .= '(';
    }

    $this->query = (string) preg_replace(pattern: '/\b(FROM)\b/', replacement: "FROM {$hooks}", subject: $this->query);
    if ($this->countJoins() === 1) {
      $this->query = (string) preg_replace(pattern: '/[()]/', replacement: '', subject: $this->query);
    }
  }

}
