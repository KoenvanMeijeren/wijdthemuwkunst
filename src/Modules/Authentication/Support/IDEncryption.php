<?php

declare(strict_types=1);


namespace Modules\Authentication\Support;

use Components\ComponentsTrait;
use JetBrains\PhpStorm\Pure;

/**
 * Provides a class for encrypting identifiers.
 *
 * @package Modules\Authentication\Support
 */
final class IDEncryption {

  use ComponentsTrait;

  /**
   * The secret token.
   *
   * @var string
   */
  private string $secretToken;

  /**
   * IDEncryption constructor.
   */
  public function __construct() {
    $this->secretToken = $this->request()->env('id_encryption_secret_key');
  }

  /**
   * Safely generate the random unique token.
   *
   * @param int $length
   *   The length of the token.
   *
   * @return string
   *   The generated token.
   */
  public function generateToken(int $length = 200): string {
    return bin2hex(random_bytes($length));
  }

  /**
   * Encrypt the id to make sure that it cannot be read by attackers.
   *
   * @param int $id
   *   The id to be encrypted.
   * @param string $token
   *   The token which will be used to encrypt the id.
   *
   * @return string
   *   The encrypted string.
   */
  #[Pure] public function encrypt(int $id, string $token): string {
    $string = "{$id}:{$token}";
    $string .= ':' . hash_hmac('sha256', $string, $this->secretToken);

    return $string;
  }

  /**
   * Decrypt the encrypted id.
   *
   * @param string|null $encryptedId
   *   The encrypted id of the user.
   *
   * @return int
   *   The decrypted id.
   */
  #[Pure] public function decrypt(?string $encryptedId): int {
    if (empty($encryptedId)) {
      return 0;
    }

    [$id, $token, $mac] = explode(':', $encryptedId);

    $data = "{$id}:{$token}";
    if (!hash_equals(hash_hmac('sha256', $data, $this->secretToken), $mac)) {
      return 0;
    }

    return (int) $id;
  }

  /**
   * Make sure that the user is the user which he says he is.
   *
   * @param string $userToken
   *   The login token of the user.
   * @param string|null $encryptedId
   *   The encrypted id of the user.
   *
   * @return bool
   *   If the hash is valid.
   */
  #[Pure] public function validateHash(string $userToken, ?string $encryptedId): bool {
    if (empty($encryptedId)) {
      return TRUE;
    }

    [$id, $token, $mac] = explode(':', $encryptedId);

    return hash_equals($userToken, $token);
  }

}
