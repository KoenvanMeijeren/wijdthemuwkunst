<?php
declare(strict_types=1);

namespace Components\Database;

use PDO;
use stdClass;

/**
 * Provides a class for processing the result of executing the query.
 *
 * @package Components\Database
 */
final class DatabaseProcessor extends DatabaseConnection implements DatabaseProcessorInterface {

  /**
   * {@inheritDoc}
   */
  protected function bindValues(array $values): void {
    foreach ($values as $column => $value) {
      $this->statement->bindValue(":{$column}", $value);
    }
  }

  /**
   * {@inheritDoc}
   */
  public function fetchAll(int $fetchMethod, int|string $fetchArgument = NULL, array $ctorArgs = []): ?array {
    if (!$fetchArgument) {
      return $this->statement->fetchAll($fetchMethod);
    }

    return $this->statement->fetchAll($fetchMethod, $fetchArgument, $ctorArgs);
  }

  /**
   * {@inheritDoc}
   */
  public function fetch(int $fetchMethod, int $cursorOrientation = PDO::FETCH_ORI_NEXT, int $cursorOffset = 0): array|object|null {
    $result = $this->statement->fetch($fetchMethod, $cursorOrientation, $cursorOffset);

    return $result ?: null;
  }

  /**
   * {@inheritDoc}
   */
  public function all(): ?array {
    return $this->fetchAll(PDO::FETCH_OBJ);
  }

  /**
   * {@inheritDoc}
   */
  public function allToArray(): ?array {
    return $this->fetchAll(PDO::FETCH_NAMED);
  }

  /**
   * {@inheritDoc}
   */
  public function allToClass(string $class): ?array {
    return $this->fetchAll(PDO::FETCH_CLASS, $class);
  }

  /**
   * {@inheritDoc}
   */
  public function first(): ?stdClass {
    $result = $this->fetch(PDO::FETCH_OBJ);
    if ($result instanceof stdClass) {
      return $result;
    }

    return NULL;
  }

  /**
   * {@inheritDoc}
   */
  public function firstToArray(): ?array {
    return $this->fetch(PDO::FETCH_NAMED);
  }

  /**
   * {@inheritDoc}
   */
  public function firstToClass(string $class): ?object {
    $data = $this->fetchAll(PDO::FETCH_CLASS, $class);
    return $data[array_key_first($data)] ?? NULL;
  }

  /**
   * {@inheritDoc}
   */
  public function getLastInsertedId(): int {
    return $this->lastInsertedId;
  }

}
