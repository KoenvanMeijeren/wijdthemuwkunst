<?php
declare(strict_types=1);

namespace Components\Database;

use stdClass;

/**
 * Provides a class for processing the result of executing the query.
 *
 * @package Components\Database
 */
interface DatabaseProcessorInterface {

  /**
   * Fetch all records from the database with the given fetch method.
   *
   * @return object[]|null
   *   The records in object format.
   */
  public function all(): ?array;

  /**
   * Fetch all records from the database into an array.
   *
   * @return string[]|null
   *   The records in array format.
   */
  public function allToArray(): ?array;

  /**
   * Fetch all records form the database into classes.
   *
   * @param string $class
   *   The name of the class to fetch the records into.
   *
   * @return array|null
   *   The records in object format.
   */
  public function allToClass(string $class): ?array;

  /**
   * Fetch one record from the database with the given fetch method.
   *
   * @return object|null
   *   The record in object format.
   */
  public function first(): ?stdClass;

  /**
   * Fetch one record from the database with the given fetch method.
   *
   * @return string[]|null
   *   The record in array format.
   */
  public function firstToArray(): ?array;

  /**
   * Fetch all records form the database into classes.
   *
   * @param string $class
   *   The name of the class to fetch the records into.
   *
   * @return object|null
   *   The record in object format.
   */
  public function firstToClass(string $class): ?object;

  /**
   * Gets the last inserted ID.
   *
   * @return int
   *   The last inserted ID, will be zero if the primary key is not A.I.
   */
  public function getLastInsertedId(): int;

}
