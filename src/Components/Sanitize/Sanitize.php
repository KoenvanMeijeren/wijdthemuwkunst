<?php
declare(strict_types=1);

namespace Components\Sanitize;

use JetBrains\PhpStorm\Pure;

/**
 * Provides a class for sanitizing data.
 *
 * @package Components\Sanitize
 */
final class Sanitize implements SanitizeInterface {

  /**
   * Constructs the data.
   *
   * @param string|float|int|bool $data
   *   The data to be sanitized.
   * @param string $type
   *   The type of the data.
   * @param int $flags
   *   The flags for htmlspecialchars filtering.
   * @param string $encoding
   *   The encoding for htmlspecialchars filtering.
   */
  public function __construct(
    private string|float|int|bool $data,
    private string $type = '',
    private int $flags = ENT_NOQUOTES,
    private string $encoding = 'UTF-8'
  ) {
    $this->type = $type === '' ? gettype($data) : $type;
  }

  /**
   * {@inheritDoc}
   */
  #[Pure]
  public function __toString(): string {
    return $this->data();
  }

  /**
   * {@inheritDoc}
   */
  #[Pure]
  public function data(): string|float|int|bool {
    if (is_string($this->data)) {
      $data = htmlspecialchars($this->data, $this->flags, $this->encoding);
    }

    return $this->filterData($data ?? $this->data);
  }

  /**
   * Filters the data based on the specified type.
   *
   * @param string|float|int|bool $data
   *   the data to be filtered.
   *
   * @return string|float|int|bool
   */
  #[Pure]
  protected function filterData(float|bool|int|string $data): float|bool|int|string {
    if ($this->type === self::TYPE_STRING) {
      $data = (string) filter_var($data);
      return trim($data);
    }

    if ($this->type === self::TYPE_INT) {
      return (int) filter_var($data, FILTER_SANITIZE_NUMBER_INT);
    }

    if ($this->type === self::TYPE_FLOAT) {
      return (float) filter_var($data);
    }

    if ($this->type === self::TYPE_URL) {
      $parsedUrl = parse_url((string) $data, PHP_URL_PATH);
      $data = trim((string) $parsedUrl, '/');
      return filter_var($data, FILTER_SANITIZE_URL);
    }

    return filter_var($data);
  }

}
