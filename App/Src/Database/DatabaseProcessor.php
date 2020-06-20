<?php

declare(strict_types=1);


namespace Src\Database;

use PDO;
use stdClass;

/**
 * Provides a class to process data for the database.
 *
 * @package Src\Database
 */
final class DatabaseProcessor extends DatabaseConnection {

  /**
   * @inheritDoc
   */
  protected function bindValues(array $values): void {
    foreach ($values as $column => $value) {
      $this->statement->bindValue(
            ":{$column}",
            $value,
            PDO::PARAM_STR
        );
    }
  }

  /**
   * Fetch all records from the database with the given fetch method.
   *
   * @param int $fetchMethod
   *   The used method to fetch the database records.
   *
   * @return mixed[]|null
   */
  public function fetchAll(int $fetchMethod): ?array {
    $data = $this->statement->fetchAll($fetchMethod);
    if ($data === FALSE) {
      $data = NULL;
    }

    return $data;
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
    $data = $this->statement->fetch($fetchMethod);
    if ($data === FALSE) {
      $data = NULL;
    }

    return $data;
  }

  /**
   * Fetch all records from the database with the given fetch method.
   *
   * @return object[]|null
   */
  public function all(): ?array {
    return $this->fetchAll(PDO::FETCH_OBJ);
  }

  /**
   * Fetch all records from the database with the given fetch method.
   *
   * @return mixed[]
   */
  public function allToArray(): array {
    $data = $this->fetchAll(PDO::FETCH_NAMED);
    if ($data === NULL) {
      $data = [];
    }

    return $data;
  }

  /**
   * Fetch one record from the database with the given fetch method.
   *
   * @return object|null
   */
  public function first(): ?stdClass {
    $result = $this->fetch(PDO::FETCH_OBJ);
    if ($result instanceof stdClass) {
      return $result;
    }

    return NULL;
  }

  /**
   * Fetch one record from the database with the given fetch method.
   *
   * @return string[]
   */
  public function firstToArray(): array {
    $data = $this->fetch(PDO::FETCH_NAMED);
    if ($data === NULL) {
      $data = [];
    }

    return (array) $data;
  }

  /**
   * Gets the last inserted ID.
   *
   * @return int
   */
  public function getLastInsertedId(): int {
    return $this->lastInsertedId;
  }

}
