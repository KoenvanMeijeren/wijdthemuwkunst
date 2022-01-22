<?php
declare(strict_types=1);

namespace Components\Collection;

use Components\Collection\Exceptions\DuplicatedCollectionKeyException;

/**
 * Provides a class for CollectionBase.
 *
 * @package Components\Collection;
 */
abstract class CollectionBase implements CollectionInterface {

  /**
   * ArrayBase constructor.
   *
   * @param array $items
   *   The array to interact with.
   */
  public function __construct(
    protected array $items = [],
  ) {}

  /**
   * {@inheritDoc}
   */
  public function add(string $key, mixed $value): void {
    if ($this->exists($key)) {
      throw new DuplicatedCollectionKeyException($key);
    }

    $this->items[$key] = $value;
  }

  /**
   * {@inheritDoc}
   */
  public function all(): array {
    return $this->items;
  }

  /**
   * {@inheritDoc}
   */
  public function get(string $key, mixed $default = NULL): mixed {
    if (!$this->exists($key)) {
      return $default;
    }

    return $this->items[$key];
  }

  /**
   * {@inheritDoc}
   */
  public function exists(string $key): bool {
    return isset($this->items[$key]);
  }

  /**
   * {@inheritDoc}
   */
  public function unset(string $key): bool {
    if ($this->exists($key)) {
      unset($this->items[$key]);

      return TRUE;
    }

    return FALSE;
  }

}
