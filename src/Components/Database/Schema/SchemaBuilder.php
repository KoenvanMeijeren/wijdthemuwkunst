<?php

declare(strict_types=1);

namespace Components\Database\Schema;

use Components\Database\DatabaseProcessor;

/**
 * Provides a class for SchemaBuilder.
 *
 * @package Components\Database\Schema
 */
final class SchemaBuilder implements SchemaBuilderInterface
{

  public static function createDatabase(string $name): void {
    new DatabaseProcessor(
      "CREATE DATABASE {$name};"
    );
  }

  public static function dropDatabase(string $name): void {
    new DatabaseProcessor(
      "DROP DATABASE {$name};"
    );
  }

  public static function backupDatabase(string $name, ?string $disk = null, bool $differential = false): void {
    $query = "BACKUP DATABASE {$name}";
    if ($disk) {
      $query .= " TO DISK = '{$disk}'";
    }

    if ($differential) {
      $query .= " WITH DIFFERENTIAL";
    }

    new DatabaseProcessor("{$query};");
  }

  public static function createTable(string $name): void {
    throw new \LogicException('This function is not yet implemented!');
  }

  public static function alterTable(string $name): void {
    throw new \LogicException('This function is not yet implemented!');
  }

  public static function truncateTable(string $name): void {
    new DatabaseProcessor(
      "TRUNCATE TABLE {$name};"
    );
  }

  public static function dropTable(string $name): self {
    new DatabaseProcessor(
      "DROP TABLE {$name};"
    );
  }

}
