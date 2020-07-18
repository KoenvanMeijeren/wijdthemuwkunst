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
   * @param null $fetch_argument
   *   This argument have a different meaning depending on the value of the
   *   <i>fetch_style</i> parameter: <p><b>PDO::FETCH_COLUMN</b>: Returns the
   *   indicated 0-indexed column. </p>
   * @param array $ctor_args
   *   Arguments of custom class constructor when the <i>fetch_style</i>
   *   parameter is <b>PDO::FETCH_CLASS</b>.
   *
   * @return mixed[]|null
   *   The fetched records.
   */
  public function fetchAll(int $fetchMethod, $fetch_argument = null, array $ctor_args = []): ?array {
    if ($fetch_argument !== null) {
      $data = $this->statement->fetchAll($fetchMethod, $fetch_argument, $ctor_args);
    } else {
      $data = $this->statement->fetchAll($fetchMethod);
    }

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
   * @param int $cursor_orientation
   *   For a PDOStatement object representing a scrollable cursor, this value
   *   determines which row will be returned to the caller. This value must be
   *   one of the PDO::FETCH_ORI_* constants, defaulting to PDO::FETCH_ORI_NEXT.
   *   To request a scrollable cursor for your PDOStatement object, you must set
   *   the PDO::ATTR_CURSOR attribute to PDO::CURSOR_SCROLL when you prepare the
   *   SQL statement with <b>PDO::prepare</b>. </p>
   * @param int $cursor_offset
   *   The offset of the cursor.
   *
   * @return string[]|object|null
   *   The fetched record.
   */
  public function fetch(int $fetchMethod, $cursor_orientation = PDO::FETCH_ORI_NEXT, $cursor_offset = 0) {
    $data = $this->statement->fetch($fetchMethod, $cursor_orientation, $cursor_offset);
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
   * Fetch all records from the database into an array.
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
   * Fetch all records form the database into classes.
   *
   * @param string $class
   *   The name of the class to fetch the records into.
   *
   * @return array|null
   */
  public function allToClass(string $class): ?array {
    return $this->fetchAll(PDO::FETCH_CLASS, $class);
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
   * Fetch all records form the database into classes.
   *
   * @param string $class
   *   The name of the class to fetch the records into.
   *
   * @return object|null
   */
  public function firstToClass(string $class): ?object {
    $data = $this->fetchAll(PDO::FETCH_CLASS, $class);
    return $data[array_key_first($data)] ?? null;
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
