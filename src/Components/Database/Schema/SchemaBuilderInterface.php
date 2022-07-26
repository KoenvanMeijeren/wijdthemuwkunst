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
  public function createDatabase(string $name): self;

  /**
   * The DROP DATABASE statement is used to drop an existing SQL database.
   */
  public function dropDatabase(string $name): self;

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
  public function backupDatabase(string $name, ?string $disk = null, bool $differential = false): self;

}
