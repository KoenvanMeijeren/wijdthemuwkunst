<?php

declare(strict_types=1);


namespace Src\Database\Statements;

use Src\Database\DatabaseProcessor;
use stdClass;

/**
 * Provides a trait with data processing statements to interact with the
 * database.
 *
 * @package src\Database\Statements
 */
trait DataProcessingStatements {

  /**
   * Execute the prepared query.
   *
   * @return \Src\Database\DatabaseProcessor
   *
   * @throws \PDOException
   */
  abstract public function execute(): DatabaseProcessor;

  /**
   * Fetch all records from the database with the given fetch method.
   *
   * @param int $fetchMethod
   *   The used method to fetch the database records.
   *
   * @return string[]|object[]|null
   */
  public function fetchAll(int $fetchMethod): ?array {
    return $this->execute()->fetchAll($fetchMethod);
  }

  /**
   * Fetch one record from the database with the given fetch method.
   *
   * @param int $fetchMethod
   *   The used method to fetch the database record.
   *
   * @return string[]|object|null
   */
  public function fetch(int $fetchMethod) {
    return $this->execute()->fetch($fetchMethod);
  }

  /**
   * Get every record from the table which matches with the given query.
   *
   * @return object[]|null
   */
  public function get(): ?array {
    return $this->execute()->all();
  }

  /**
   * Get every record from the table which matches with the given query.
   *
   * @return string[]
   */
  public function fetchAllToArray(): array {
    return $this->execute()->allToArray();
  }

  /**
   * Get every record from the table which matches with the given query.
   *
   * @param string $class
   *   The name of the class to fetch the records into.
   *
   * @return object[]
   */
  public function fetchAllToClass(string $class): array {
    return $this->execute()->allToClass($class);
  }

  /**
   * Get the first record from the table which matches with the given query.
   *
   * @return object|null
   */
  public function first(): ?stdClass {
    return $this->execute()->first();
  }

  /**
   * Get the first record from the table which matches with the given query.
   *
   * @return string[]
   */
  public function firstToArray(): array {
    return $this->execute()->firstToArray();
  }

  /**
   * Get the first record from the table which matches with the given query.
   *
   * @param string $class
   *   The name of the class to fetch the records into.
   *
   * @return object|null
   */
  public function firstToClass(string $class): ?object {
    return $this->execute()->firstToClass($class);
  }

}
