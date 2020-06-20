<?php

declare(strict_types=1);


namespace Src\Security;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Src\Core\Request;

/**
 *
 */
final class Encrypt {
  private string $data;

  /**
   * Construct the data.
   *
   * @param string $data
   *   the data to be saved.
   */
  public function __construct(string $data) {
    $this->data = $data;
  }

  /**
   *
   */
  public function encrypt(): string {
    return Crypto::encrypt($this->data, $this->loadKeyFromConfig());
  }

  /**
   *
   */
  public function decrypt(): string {
    return Crypto::decrypt($this->data, $this->loadKeyFromConfig());
  }

  /**
   * Load the key from the config.
   *
   * @return \Defuse\Crypto\Key
   *
   * @throws \Defuse\Crypto\Exception\BadFormatException
   * @throws \Defuse\Crypto\Exception\EnvironmentIsBrokenException
   */
  private function loadKeyFromConfig(): Key {
    $request = new Request();

    return Key::loadFromAsciiSafeString(
          $request->env('crypto_encryption_token')
      );
  }

}
