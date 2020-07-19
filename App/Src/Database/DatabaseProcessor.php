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
      $this->statement->bindValue(":{$column}", $value, PDO::PARAM_STR);
    }
  }

  /**
   * Fetch all records from the database with the given fetch method.
   *
   * @param int $fetchMethod
   *   The used method to fetch the database records.
   * @param null $fetchArgument
   *   This argument have a different meaning depending on the value of the
   *   <i>fetch_style</i> parameter: <p><b>PDO::FETCH_COLUMN</b>: Returns the
   *   indicated 0-indexed column. </p>
   * @param array $ctorArgs
   *   Arguments of custom class constructor when the <i>fetch_style</i>
   *   parameter is <b>PDO::FETCH_CLASS</b>.
   *
   * @return mixed[]|null
   *   The fetched records.
   */
  public function fetchAll(int $fetchMethod, $fetchArgument = null, array $ctorArgs = []): ?array {
    if ($fetchArgument !== null) {
      $data = $this->statement->fetchAll($fetchMethod, $fetchArgument, $ctorArgs);
    } else {
      $data = $this->statement->fetchAll($fetchMethod);
    }

    return $data;
  }

  /**
   * Fetch one record from the database with the given fetch method.
   *
   * @param int $fetchMethod
   *   The used method to fetch the database record.
   * @param int $cursorOrientation
   *   For a PDOStatement object representing a scrollable cursor, this value
   *   determines which row will be returned to the caller. This value must be
   *   one of the PDO::FETCH_ORI_* constants, defaulting to PDO::FETCH_ORI_NEXT.
   *   To request a scrollable cursor for your PDOStatement object, you must set
   *   the PDO::ATTR_CURSOR attribute to PDO::CURSOR_SCROLL when you prepare the
   *   SQL statement with <b>PDO::prepare</b>. </p>
   * @param int $cursorOffset
   *   The offset of the cursor.
   *
   * @return string[]|object|null
   *   The fetched record.
   */
  public function fetch(int $fetchMethod, $cursorOrientation = PDO::FETCH_ORI_NEXT, $cursorOffset = 0) {
    return $this->statement->fetch($fetchMethod, $cursorOrientation, $cursorOffset);
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
   * @return string[]|null
   */
  public function allToArray(): ?array {
    return $this->fetchAll(PDO::FETCH_NAMED);
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
   * @return string[]|null
   */
  public function firstToArray(): ?array {
    return $this->fetch(PDO::FETCH_NAMED);
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
