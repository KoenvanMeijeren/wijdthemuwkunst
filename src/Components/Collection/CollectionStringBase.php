<?php
declare(strict_types=1);

namespace Components\Collection;

use Components\Encrypt\Encrypt;
use Components\Sanitize\Sanitize;
use function is_json;

/**
 * Provides a class for interacting with arrays.
 *
 * @package \Components\Array
 */
abstract class CollectionStringBase extends CollectionBase implements CollectionStringInterface {

  /**
   * ArrayBase constructor.
   *
   * @param string[] $items
   *   The array to interact with.
   * @param bool $sanitize
   *   Whether the data must be sanitized or not.
   * @param bool $encrypt
   *   Whether the data must be encrypted or not.
   */
  public function __construct(
    protected array $items = [],
    private readonly bool $sanitize = false,
    private readonly bool $encrypt = false
  ) {
    parent::__construct($this->items);
  }

  /**
   * {@inheritDoc}
   */
  public function all(): array {
    $items = parent::all();
    if (!$this->encrypt) {
      return $items;
    }

    $result = [];
    foreach (array_keys($items) as $key) {
      $result[$key] = $this->get($key);
    }

    return $result;
  }

  /**
   * {@inheritDoc}
   */
  public function add(string $key, mixed $value): void {
    $this->save($key, $value);
  }

  /**
   * {@inheritDoc}
   */
  public function save(string $key, string $value): void {
    if ($this->exists($key)) {
      return;
    }

    $data = $value;
    if ($this->sanitize) {
      $sanitize = new Sanitize($value);
      $data = (string) $sanitize->data();
    }

    if (!$this->encrypt) {
      parent::add($key, $value);
      return;
    }

    $data = new Encrypt($data);
    parent::add($key, $data->encrypt());
  }

  /**
   * {@inheritDoc}
   */
  public function get(string $key, mixed $default = '', bool $unset = FALSE): string {
    $data = parent::get($key, $default);
    if ($data === '') {
      return $default;
    }

    if (!is_string($data)) {
      return $default;
    }

    if (is_json($data)) {
      return $data;
    }

    if ($unset) {
      $this->unset($key);
    }

    if ($this->sanitize) {
      $sanitize = new Sanitize($data);
      $data = $sanitize->data();
    }

    if (!$this->encrypt) {
      return $data;
    }

    $data = new Encrypt($data);
    return $data->decrypt();
  }

}
