<?php
declare(strict_types=1);

namespace Components\Database;

use PDO;

/**
 * Provides a class to receive a connection with the database.
 *
 * @package src\Database
 */
interface DatabaseConnectionInterface {

  /**
   * The undefined identifier value.
   *
   * @var int
   */
  public const UNDEFINED_IDENTIFIER = -1;

  /**
   * The offset of the cursor.
   *
   * @var int
   */
  public const DEFAULT_CURSOR_OFFSET = 0;

  /**
   * The default cursor orientation.
   *
   * @var int
   */
  public const DEFAULT_CURSOR_ORIENTATION = PDO::FETCH_ORI_NEXT;

  /**
   * Fetch all records from the database with the given fetch method.
   *
   * @param int $fetchMethod
   *   The used method to fetch the database records.
   * @param int|string|null $fetchArgument
   *   This argument has a different meaning depending on the value of the
   *   <i>fetch_style</i> parameter: <p><b>PDO::FETCH_COLUMN</b>: Returns the
   *   indicated 0-indexed column. </p>.
   * @param array $ctorArgs
   *   Arguments of custom class constructor when the <i>fetch_style</i>
   *   parameter is <b>PDO::FETCH_CLASS</b>.
   *
   * @return array|null
   *   The fetched records.
   */
  public function fetchAll(int $fetchMethod, int|string $fetchArgument = NULL, array $ctorArgs = []): ?array;

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
   *   SQL statement with <b>PDO::prepare</b>. </p>.
   * @param int $cursorOffset
   *   The offset of the cursor.
   *
   * @return string[]|object|null
   *   The fetched record.
   */
  public function fetch(int $fetchMethod, int $cursorOrientation = self::DEFAULT_CURSOR_ORIENTATION, int $cursorOffset = self::DEFAULT_CURSOR_OFFSET): array|object|null;

}
