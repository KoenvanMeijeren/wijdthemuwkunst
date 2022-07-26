<?php

declare(strict_types=1);

namespace Components\Database\Schema;

use Components\Database\DatabaseProcessor;
use Components\Database\Query;

/**
 * Provides a class for SchemaBuilder.
 *
 * @package Components\Database\Schema
 */
final class SchemaBuilder implements SchemaBuilderInterface
{

  public function createDatabase(string $name): self {
    new DatabaseProcessor(
      "CREATE DATABASE {$name};"
    );

    return $this;
  }

  public function dropDatabase(string $name): self {
    new DatabaseProcessor(
      "DROP DATABASE {$name};"
    );

    return $this;
  }

  public function backupDatabase(string $name, ?string $disk = null, bool $differential = false): self {
    $query = "BACKUP DATABASE {$name}";
    if ($disk) {
      $query .= " TO DISK = '{$disk}'";
    }

    if ($differential) {
      $query .= " WITH DIFFERENTIAL";
    }

    new DatabaseProcessor("{$query};");

    return $this;
  }

  public function createTable(string $name): self {
    throw new \LogicException('This function is not yet implemented!');
  }

  public function alterTable(string $name): self {
    throw new \LogicException('This function is not yet implemented!');
  }

  public function truncateTable(string $name): self {
    new DatabaseProcessor(
      "TRUNCATE TABLE {$name};"
    );

    return $this;
  }

  public function dropTable(string $name): self {
    new DatabaseProcessor(
      "DROP TABLE {$name};"
    );

    return $this;
  }

}
