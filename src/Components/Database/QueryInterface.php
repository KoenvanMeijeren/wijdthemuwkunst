<?php
declare(strict_types=1);

namespace Components\Database;

/**
 * Provides an interface for building queries and interacting with the database.
 *
 * @package Components\Database
 */
interface QueryInterface extends DatabaseProcessorInterface, DatabaseConnectionInterface {

  /**
   * The SELECT statement is used to select data from a database.
   *
   * The data returned is stored in a result table, called the result-set.
   *
   * @param string[]|string ...$columns
   *   The columns to select from the database.
   *
   * @return $this
   *   The called object reference.
   */
  public function select(...$columns): QueryInterface;

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
   *   The called object reference.
   */
  public function selectUnion(...$columns): QueryInterface;

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
   *   The called object reference.
   */
  public function selectUnionAll(...$columns): QueryInterface;

  /**
   * Returns only distinct (different) values.
   *
   * @param string[] ...$columns
   *   The columns to select distinct.
   *
   * @return $this
   *   The called object reference.
   */
  public function selectDistinct(...$columns): QueryInterface;

  /**
   * The MIN() function returns the smallest value of the selected column.
   *
   * @param string[] ...$columns
   *   The columns to be selected.
   *
   * @return $this
   *   The called object reference.
   */
  public function selectMin(...$columns): QueryInterface;

  /**
   * The MAX() function returns the largest value of the selected column.
   *
   * @param string[] ...$columns
   *   The columns to be selected.
   *
   * @return $this
   *   The called object reference.
   */
  public function selectMax(...$columns): QueryInterface;

  /**
   * Returns the number of rows that matches the specified criteria.
   *
   * @param string[] ...$columns
   *   The columns to be selected.
   *
   * @return $this
   *   The called object reference.
   */
  public function selectCount(...$columns): QueryInterface;

  /**
   * The AVG() function returns the average value of a numeric column.
   *
   * @param string[] ...$columns
   *   The columns to be selected.
   *
   * @return $this
   *   The called object reference.
   */
  public function selectAvg(...$columns): QueryInterface;

  /**
   * The SUM() function returns the total sum of a numeric column.
   *
   * @param string[] ...$columns
   *   The columns to be selected.
   *
   * @return $this
   *   The called object reference.
   */
  public function selectSum(...$columns): QueryInterface;

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
   *   The called object reference.
   */
  public function innerJoin(string $table, string $tableOneColumn, string $tableTwoColumn): QueryInterface;

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
   *   The called object reference.
   */
  public function leftJoin(string $table, string $tableOneColumn, string $tableTwoColumn): QueryInterface;

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
   *   The called object reference.
   */
  public function rightJoin(string $table, string $tableOneColumn, string $tableTwoColumn): QueryInterface;

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
   *   The called object reference.
   */
  public function fullOuterJoin(string $table, string $tableOneColumn, string $tableTwoColumn): QueryInterface;

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
   *   The called object reference.
   */
  public function where(string $column, string $operator, string $condition): QueryInterface;

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
   *   The called object reference.
   */
  public function whereExists(string $query, array $values): QueryInterface;

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
   *   The called object reference.
   */
  public function whereAny(string $column, string $operator, string $query, array $values): QueryInterface;

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
   *   The called object reference.
   */
  public function whereAll(string $column, string $operator, string $query, array $values): QueryInterface;

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
   *   The called object reference.
   */
  public function whereNot(string $column, string $operator, string $condition): QueryInterface;

  /**
   * The IS NULL operator is used to test for empty values (NULL values).
   *
   * @param string[] ...$columns
   *   The columns to be filtered.
   *
   * @return $this
   *   The called object reference.
   */
  public function whereIsNull(...$columns): QueryInterface;

  /**
   * The IS NOT NULL operator is used to test for empty values (NULL values).
   *
   * @param string[] ...$columns
   *   The columns to be filtered.
   *
   * @return $this
   *   The called object reference.
   */
  public function whereIsNotNull(...$columns): QueryInterface;

  /**
   * The IN operator allows you to specify multiple values in a WHERE clause.
   *
   * @param string $column
   *   The column to be filtered.
   * @param string[] $condition
   *   The conditions of the filter.
   *
   * @return $this
   *   The called object reference.
   */
  public function whereInValue(string $column, array $condition): QueryInterface;

  /**
   * The NOT IN operator allows you to specify multiple values in WHERE clause.
   *
   * @param string $column
   *   The column to be filtered.
   * @param string[]  ...$condition
   *   The conditions of the filter.
   *
   * @return $this
   *   The called object reference.
   */
  public function whereNotInValue(string $column, ...$condition): QueryInterface;

  /**
   * Add where or statement to the query.
   *
   * @param string $column
   *   The column to be filtered.
   * @param string[] ...$values
   *   The values of the filter.
   *
   * @return $this
   *   The called object reference.
   */
  public function whereOr(string $column, ...$values): QueryInterface;

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
   *   The called object reference.
   */
  public function whereInQuery(string $column, string $query, array $values): QueryInterface;

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
   *   The called object reference.
   */
  public function whereBetween(string $column, string $start, string $end): QueryInterface;

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
   *   The called object reference.
   */
  public function whereNotBetween(string $column, string $start, string $end): QueryInterface;

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
   *   The called object reference.
   */
  public function whereOrBetween(string $column, string $start, string $end): QueryInterface;

  /**
   * Search for values in the database for the given attributes.
   *
   * @param array $attributes
   *   The attributes to filter on.
   * @param string $operator
   *   The operator.
   *
   * @return $this
   *   The called object reference.
   */
  public function whereAttributes(array $attributes, string $operator = '='): QueryInterface;

    /**
   * The HAVING clause was added to SQL because the WHERE keyword could not be
   * used with aggregate functions.
   *
   * @param string[] ...$conditions
   *   The condition(s) of the having clause.
   *
   * @return $this
   *   The called object reference.
   */
  public function having(...$conditions): QueryInterface;

  /**
   * The INSERT INTO statement is used to insert new records in a table.
   *
   * @param string[] $values
   *   The values to be inserted.
   *
   * @return int
   *   The last inserted id.
   */
  public function insert(array $values): int;

  /**
   * The UPDATE statement is used to modify the existing records in a table.
   *
   * @param string[] $values
   *   The values to be updated.
   *
   * @return $this
   *   The called object reference.
   */
  public function update(array $values): QueryInterface;

  /**
   * Soft deletes a record from the database.
   *
   * @param string $column
   *   The column to be updated. This value will be used to determine if the
   *   record has been deleted.
   * @param int $status
   *   The new value of the column.
   *
   * @return $this
   *   The called object reference.
   */
  public function delete(string $column, int $status): QueryInterface;

  /**
   * The DELETE statement is used to delete existing records in a table.
   *
   * @return $this
   *   The called object reference.
   */
  public function permanentDelete(): QueryInterface;

  /**
   * Orders all selected records by specified columns with a specified filter.
   *
   * @param string $filter
   *   The filter -> ascending (asc) or descending (desc).
   * @param string[]|string  ...$columns
   *   The columns to be ordered.
   *
   * @return $this
   *   The called object reference.
   */
  public function orderBy(string $filter, ...$columns): QueryInterface;

  /**
   * The GROUP BY statement is used to group the records by one or more columns.
   *
   * @param string[] ...$columns
   *   The columns to be grouped into one record.
   *
   * @return $this
   *   The called object reference.
   */
  public function groupBy(...$columns): QueryInterface;

  /**
   * Limits the number of records that are returned from the database.
   *
   * @param int $limit
   *   The maximum number of selected records.
   *
   * @return $this
   *   The called object reference.
   */
  public function limit(int $limit = 1): QueryInterface;

  /**
   * Executes the query and returns a processor for interacting on the result.
   *
   * @return DatabaseProcessorInterface
   *   The database processor.
   */
  public function execute(): DatabaseProcessorInterface;

  /**
   * Gets all records from database.
   *
   * @return array|null
   *   The fetched records.
   *
   * @see DatabaseProcessorInterface::all()
   *   For fetching or getting all records from database.
   */
  public function get(): ?array;

  /**
   * Adds a statement to the query.
   *
   * @param string $statement
   *   The statement to be added to the query.
   *
   * @return QueryInterface
   *   The called object reference.
   */
  public function addStatement(string $statement): QueryInterface;

  /**
   * Adds a statement with values to the query.
   *
   * @param string $statement
   *   The statement to be added to the query.
   * @param string[] $values
   *   The values of the statement.
   *
   * @return QueryInterface
   *   The called object reference.
   */
  public function addStatementWithValues(string $statement, array $values): QueryInterface;

  /**
   * Gets the query.
   *
   * @return string
   *   The built query.
   */
  public function getQuery(): string;

  /**
   * Adds values to the query. These values will be used when the query is
   * going to be executed.
   *
   * @param string[] $values
   *   The values of the query.
   */
  public function addValues(array $values): void;

  /**
   * Gets the values of the query.
   *
   * @return string[]
   *   The values.
   */
  public function getValues(): array;

  /**
   * Renders the columns to string.
   *
   * @param string[] $columns
   *   The columns.
   *
   * @return string
   *   The columns rendered as a string.
   */
  public function columnsToString(array $columns): string;

}
