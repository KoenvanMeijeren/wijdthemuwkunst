<?php
declare(strict_types=1);

namespace Components\Encrypt;

use Components\ComponentsTrait;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

/**
 * Provides a class for encrypting data.
 *
 * @package Components\Encrypt
 */
final class Encrypt implements EncryptInterface {

  use ComponentsTrait;

  /**
   * Constructs the encrypt class.
   *
   * @param string $data
   *   The data to be encrypted.
   */
  public function __construct(
    private string $data
  ) {}

  /**
   * {@inheritDoc}
   */
  public function encrypt(): string {
    return Crypto::encrypt($this->data, $this->loadKeyFromConfig());
  }

  /**
   * {@inheritDoc}
   */
  public function decrypt(): string {
    return Crypto::decrypt($this->data, $this->loadKeyFromConfig());
  }

  /**
   * Loads the key from the config.
   *
   * @return \Defuse\Crypto\Key
   *
   * @throws \Defuse\Crypto\Exception\BadFormatException
   * @throws \Defuse\Crypto\Exception\EnvironmentIsBrokenException
   */
  protected function loadKeyFromConfig(): Key {
    return Key::loadFromAsciiSafeString($this->request()->env('crypto_encryption_token'));
  }

}
