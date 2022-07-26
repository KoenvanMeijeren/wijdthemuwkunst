<?php

declare(strict_types=1);

namespace Components\Database\Schema;

/**
 * Provides an interface for schema builders.
 *
 * @package Components\Database\Schema
 */
interface SchemaBuilderInterface
{

  /**
   * The CREATE DATABASE statement is used to create a new SQL database.
   */
  public static function createDatabase(string $name): void;

  /**
   * The DROP DATABASE statement is used to drop an existing SQL database.
   */
  public static function dropDatabase(string $name): void;

  /**
   * The DROP DATABASE statement is used to drop an existing SQL database.
   *
   * Always back up the database to a different drive than the actual database.
   * Then, if you get a disk crash, you will not lose your backup file along
   * with the database.
   *
   * A differential back up reduces the back up time (since only the changes are
   * backed up).
   */
  public static function backupDatabase(string $name, ?string $disk = null, bool $differential = false): void;

}