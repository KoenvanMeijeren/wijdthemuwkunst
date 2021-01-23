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
   *
   * @return $this
   *   The called object reference.
   */
  public function delete(string $column): QueryInterface;

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
   * @param string[]  ...$columns
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
