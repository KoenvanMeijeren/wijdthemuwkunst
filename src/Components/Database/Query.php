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
    protected string $table,
    protected string $query = '',
    protected array $values = []
  ) {}

  /**
   * The SELECT statement is used to select data from a database.
   *
   * The data returned is stored in a result table, called the result-set.
   *
   * @param string[]|string ...$columns
   *   The columns to select from the database.
   *
   * @return $this
   */
  public function select(...$columns): QueryInterface {
    $queryColumns = implode(', ', $columns);
    $this->addStatement("SELECT {$queryColumns} FROM {$this->table} ");

    return $this;
  }

  /**
   * Combine the result-set of two or more SELECT statements.
   *
   * - Each SELECT statement within UNION must have the same number of columns
   * - The columns must also have similar data types
   * - The columns in each SELECT statement must also be in the same order.
   *
   * The UNION operator selects only distinct values by default.
   * To allow duplicate values, use UNION ALL:
   *
   * @param string[] ...$columns
   *   The columns to be union selected.
   *
   * @return $this
   */
  public function selectUnion(...$columns): QueryInterface {
    $queryColumns = implode(', ', $columns);
    $this->addStatement("UNION SELECT {$queryColumns} FROM {$this->table} ");

    return $this;
  }

  /**
   * Combine the result-set of two or more SELECT statements.
   *
   * - Each SELECT statement within UNION must have the same number of columns
   * - The columns must also have similar data types
   * - The columns in each SELECT statement must also be in the same order.
   *
   * The UNION operator selects only distinct values by default.
   * To allow duplicate values, use UNION ALL:
   *
   * @param string[] ...$columns
   *   The columns to be union all selected.
   *
   * @return $this
   */
  public function selectUnionAll(...$columns): QueryInterface {
    $queryColumns = implode(', ', $columns);
    $this->addStatement("UNION ALL SELECT {$queryColumns} FROM {$this->table} ");

    return $this;
  }

  /**
   * Returns only distinct (different) values.
   *
   * @param string[] ...$columns
   *   The columns to select distinct.
   *
   * @return $this
   */
  public function selectDistinct(...$columns): QueryInterface {
    $queryColumns = implode(', ', $columns);
    $this->addStatement("SELECT DISTINCT {$queryColumns} FROM {$this->table} ");

    return $this;
  }

  /**
   * The MIN() function returns the smallest value of the selected column.
   *
   * @param string[] ...$columns
   *   The columns to be selected.
   *
   * @return $this
   */
  public function selectMin(...$columns): QueryInterface {
    $queryColumns = implode(', ', $columns);
    $this->addStatement("SELECT MIN({$queryColumns}) FROM {$this->table} ");

    return $this;
  }

  /**
   * The MAX() function returns the largest value of the selected column.
   *
   * @param string[] ...$columns
   *   The columns to be selected.
   *
   * @return $this
   */
  public function selectMax(...$columns): QueryInterface {
    $queryColumns = implode(', ', $columns);
    $this->addStatement("SELECT MAX({$queryColumns}) FROM {$this->table} ");

    return $this;
  }

  /**
   * Returns the number of rows that matches the specified criteria.
   *
   * @param string[] ...$columns
   *   The columns to be selected.
   *
   * @return $this
   */
  public function selectCount(...$columns): QueryInterface {
    $queryColumns = implode(', ', $columns);
    $this->addStatement("SELECT COUNT({$queryColumns}) FROM {$this->table} ");

    return $this;
  }

  /**
   * The AVG() function returns the average value of a numeric column.
   *
   * @param string[] ...$columns
   *   The columns to be selected.
   *
   * @return $this
   */
  public function selectAvg(...$columns): QueryInterface {
    $queryColumns = implode(', ', $columns);
    $this->addStatement("SELECT AVG({$queryColumns}) FROM {$this->table} ");

    return $this;
  }

  /**
   * The SUM() function returns the total sum of a numeric column.
   *
   * @param string[] ...$columns
   *   The columns to be selected.
   *
   * @return $this
   */
  public function selectSum(...$columns): QueryInterface {
    $queryColumns = implode(', ', $columns);
    $this->addStatement("SELECT SUM({$queryColumns}) FROM {$this->table} ");

    return $this;
  }

  /**
   * Selects records that have matching values in both tables.
   *
   * @param string $table
   *   The table to inner join on.
   * @param string $tableOneColumn
   *   The first table column to inner join on.
   * @param string $tableTwoColumn
   *   The second table column to inner join on.
   *
   * @return $this
   */
  public function innerJoin(string $table, string $tableOneColumn, string $tableTwoColumn): QueryInterface {
    $this->addStatement("INNER JOIN {$table} ON {$tableOneColumn} = {$tableTwoColumn}) ");

    return $this;
  }

  /**
   * The LEFT JOIN keyword returns all records from the left table (table1),
   * and the matched records from the right table (table2).
   *
   * The result is NULL from the right side, if there is no match.
   *
   * @param string $table
   *   The table to left join on.
   * @param string $tableOneColumn
   *   The first table column to left join on.
   * @param string $tableTwoColumn
   *   The second table column to left join on.
   *
   * @return $this
   */
  public function leftJoin(string $table, string $tableOneColumn, string $tableTwoColumn): QueryInterface {
    $this->addStatement("LEFT JOIN {$table} ON {$tableOneColumn} = {$tableTwoColumn}) ");

    return $this;
  }

  /**
   * The RIGHT JOIN keyword returns all records from the right table (table2),
   * and the matched records from the left table (table1).
   *
   * The result is NULL from the left side, when there is no match.
   *
   * @param string $table
   *   The table to right join on.
   * @param string $tableOneColumn
   *   The first table column to right join on.
   * @param string $tableTwoColumn
   *   The second table column to right join on.
   *
   * @return $this
   */
  public function rightJoin(string $table, string $tableOneColumn, string $tableTwoColumn): QueryInterface {
    $this->addStatement("RIGHT JOIN {$table} ON {$tableOneColumn} = {$tableTwoColumn}) ");

    return $this;
  }

  /**
   * The FULL OUTER JOIN keyword return all records when there is a match in
   * either left (table1) or right (table2) table records.
   *
   * @param string $table
   *   The table to full outer join on.
   * @param string $tableOneColumn
   *   The first table column to full outer join on.
   * @param string $tableTwoColumn
   *   The second table column to full outer join on.
   *
   * @return $this
   */
  public function fullOuterJoin(string $table, string $tableOneColumn, string $tableTwoColumn): QueryInterface {
    $this->addStatement("FULL OUTER JOIN {$table} ON {$tableOneColumn} = {$tableTwoColumn}) ");

    return $this;
  }

  /**
   * The WHERE clause is used to filter records.
   *
   * The WHERE clause is used to extract only those records that fulfill a
   * specified condition.
   *
   * @param string $column
   *   The column to specify the filter on.
   * @param string $operator
   *   The operator to be used in the where statement.
   * @param string $condition
   *   The condition to be used in the where statement.
   *
   * @return $this
   */
  public function where(string $column, string $operator, string $condition): QueryInterface {
    $bindColumn = str_replace('.', '', $column);

    $this->addStatement("WHERE {$column} {$operator} :{$bindColumn} ");
    $this->addValues([$bindColumn => $condition]);

    return $this;
  }

  /**
   * The EXISTS operator tests for the existence of any record in a sub query.
   *
   * The EXISTS operator returns true if the sub query returns one or more
   * records.
   *
   * @param string $query
   *   The query to test if any record exists.
   * @param string[] $values
   *   The values to bind to the query.
   *
   * @return $this
   */
  public function whereExists(string $query, array $values): QueryInterface {
    $this->addStatement("WHERE EXISTS ({$query}) ");
    $this->addValues($values);

    return $this;
  }

  /**
   * The ANY and ALL operators are used with a WHERE or HAVING clause.
   *
   * The ANY operator returns true if any of the sub query values meet the
   * condition. The ALL operator returns true if all of the sub query values
   * meet the condition.
   *
   * @param string $column
   *   The column to be filtered.
   * @param string $operator
   *   The operator.
   * @param string $query
   *   The query which checks if all of the values meet the condition.
   * @param string[] $values
   *   The values to bind to the query.
   *
   * @return $this
   */
  public function whereAny(string $column, string $operator, string $query, array $values): QueryInterface {
    $this->addStatement("WHERE {$column} {$operator} ANY ({$query}) ");
    $this->addValues($values);

    return $this;
  }

  /**
   * The ANY and ALL operators are used with a WHERE or HAVING clause.
   *
   * The ANY operator returns true if any of the sub query values meet the
   * condition. The ALL operator returns true if all of the sub query values
   * meet the condition.
   *
   * @param string $column
   *   The column to be filtered.
   * @param string $operator
   *   The operator.
   * @param string $query
   *   The query which checks if all of the sub query values meet the condition.
   * @param string[] $values
   *   The values to bind to the query.
   *
   * @return $this
   */
  public function whereAll(string $column, string $operator, string $query, array $values): QueryInterface {
    $this->addStatement("WHERE {$column} {$operator} ALL ({$query}) ");
    $this->addValues($values);

    return $this;
  }

  /**
   * Add where not statement to the query.
   *
   * @param string $column
   *   The column to be filtered.
   * @param string $operator
   *   The operator.
   * @param string $condition
   *   The condition of the filter.
   *
   * @return $this
   */
  public function whereNot(string $column, string $operator, string $condition): QueryInterface {
    $this->addStatement("WHERE NOT {$column} {$operator} :{$column} ");
    $this->addValues([$column => $condition]);

    return $this;
  }

  /**
   * The IS NULL operator is used to test for empty values (NULL values).
   *
   * @param string[] ...$columns
   *   The columns to be filtered.
   *
   * @return $this
   */
  public function whereIsNull(...$columns): QueryInterface {
    $queryColumns = implode(', ', $columns);
    $this->addStatement("WHERE {$queryColumns} IS NULL ");

    return $this;
  }

  /**
   * The IS NOT NULL operator is used to test for empty values (NULL values).
   *
   * @param string[] ...$columns
   *   The columns to be filtered.
   *
   * @return $this
   */
  public function whereIsNotNull(...$columns): QueryInterface {
    $queryColumns = implode(', ', $columns);
    $this->addStatement("WHERE {$queryColumns} IS NOT NULL ");

    return $this;
  }

  /**
   * The IN operator allows you to specify multiple values in a WHERE clause.
   *
   * @param string $column
   *   The column to be filtered.
   * @param string[] $condition
   *   The conditions of the filter.
   *
   * @return $this
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
   * The NOT IN operator allows you to specify multiple values in WHERE clause.
   *
   * @param string $column
   *   The column to be filtered.
   * @param string[]  ...$condition
   *   The conditions of the filter.
   *
   * @return $this
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
   * Add where or statement to the query.
   *
   * @param string $column
   *   The column to be filtered.
   * @param string[] ...$values
   *   The values of the filter.
   *
   * @return $this
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
   * The IN operator allows you to specify multiple values in a WHERE clause.
   *
   * @param string $column
   *   The column to be filtered.
   * @param string $query
   *   The query to be used as a filter.
   * @param string[] $values
   *   The values of the sub query.
   *
   * @return $this
   */
  public function whereInQuery(string $column, string $query, array $values): QueryInterface {
    $this->addStatement("WHERE {$column} IN ({$query}) ");
    $this->addValues($values);

    return $this;
  }

  /**
   * The BETWEEN operator selects values within a given range.
   *
   * The values can be numbers, text, or dates.
   * The BETWEEN operator is inclusive: begin and end values are included.
   *
   * @param string $column
   *   The column to be filtered.
   * @param string $start
   *   The start range of the filter.
   * @param string $end
   *   The end range of the filter.
   *
   * @return $this
   */
  public function whereBetween(string $column, string $start, string $end): QueryInterface {
    $this->addStatement("WHERE {$column} BETWEEN :{$column}Start AND :{$column}End ");
    $this->addValues([$column . 'Start' => $start, $column . 'End' => $end,]);

    return $this;
  }

  /**
   * The BETWEEN operator selects values within a given range.
   *
   * The values can be numbers, text, or dates.
   * The BETWEEN operator is inclusive: begin and end values are included.
   *
   * @param string $column
   *   The column to be filtered.
   * @param string $start
   *   The start range of the filter.
   * @param string $end
   *   The end range of the filter.
   *
   * @return $this
   */
  public function whereNotBetween(string $column, string $start, string $end): QueryInterface {
    $this->addStatement("WHERE {$column} NOT BETWEEN :{$column}Start AND :{$column}End ");
    $this->addValues([$column . 'Start' => $start, $column . 'End' => $end,]);

    return $this;
  }

  /**
   * The BETWEEN operator selects values within a given range.
   *
   * The values can be numbers, text, or dates.
   * The BETWEEN operator is inclusive: begin and end values are included.
   *
   * @param string $column
   *   The columns to be filtered.
   * @param string $start
   *   The start range of the filter.
   * @param string $end
   *   The end range of the filter.
   *
   * @return $this
   */
  public function whereOrBetween(string $column, string $start, string $end): QueryInterface {
    $this->addStatement("OR {$column} BETWEEN :{$column}Start AND :{$column}End ");
    $this->addValues([$column . 'Start' => $start, $column . 'End' => $end,]);

    return $this;
  }

  /**
   * Search for values in the database for the given attributes.
   *
   * @param array $attributes
   *   The attributes to filter on.
   * @param string $operator
   *   The operator.
   *
   * @return $this
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
  public function delete(string $column): QueryInterface {
    $this->update([$column => TRUE]);

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
    $implodedColumns = implode(', ', $columns);
    $this->addStatement("ORDER BY {$implodedColumns} {$filter} ");

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function groupBy(...$columns): QueryInterface {
    $implodedColumns = implode(', ', $columns);
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
   * @inheritDoc
   */
  public function execute(): DatabaseProcessorInterface {
    $this->addHooksForJoins();

    return new DatabaseProcessor($this->query, $this->values);
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
   * @inheritDoc
   */
  public function addStatement(string $statement): Query {
    if (str_contains($this->query, 'WHERE')) {
      $statement = preg_replace(pattern: '/\b(WHERE)\b/', replacement: 'AND', subject: $statement);
    }

    $this->query .= $statement;

    return $this;
  }

  /**
   * @inheritDoc
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
   * @inheritDoc
   */
  public function getQuery(): string {
    $this->addHooksForJoins();

    return $this->query;
  }

  /**
   * @inheritDoc
   */
  public function addValues(array $values): void {
    foreach ($values as $column => $condition) {
      $this->values[$column] = $condition;
    }
  }

  /**
   * @inheritDoc
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
