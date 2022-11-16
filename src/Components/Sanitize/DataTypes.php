<?php
declare(strict_types=1);

namespace Components\Sanitize;

use JetBrains\PhpStorm\Pure;

/**
 * Provides an enumeration for the different data types.
 *
 * @package \Components\Sanitize
 */
enum DataTypes: string {
  case STRING = 'string';
  case INT = 'integer';
  case FLOAT = 'float';
  case URL = 'url';

  /**
   * Sets the data type.
   *
   * @param string $data_type
   *   The data type.
   *
   * @return \Components\Sanitize\DataTypes
   *   The data type.
   *
   * @throws \Components\Sanitize\InvalidDataTypeException
   */
  public static function set(string $data_type): DataTypes {
    return match ($data_type) {
      self::STRING->value => self::STRING,
      self::INT->value => self::INT,
      self::FLOAT->value => self::FLOAT,
      self::URL->value => self::URL,
      default => throw new InvalidDataTypeException($data_type),
    };
  }

  /**
   * Determines if the data type is equal or not.
   *
   * @param string $data_type
   *   The data type.
   *
   * @return bool
   *   Whether the data type is equal or not.
   */
  #[Pure]
  public function isEqualString(string $data_type): bool {
    return $this->value === $data_type;
  }

  /**
   * Determines if the data type is equal or not.
   *
   * @param \Components\Sanitize\DataTypes $data_type
   *   The data type.
   *
   * @return bool
   *   Whether the data type is equal or not.
   */
  #[Pure]
  public function isEqual(DataTypes $data_type): bool {
    return $this->isEqualString($data_type->value);
  }
}
