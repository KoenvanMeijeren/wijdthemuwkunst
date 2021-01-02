<?php
declare(strict_types=1);

namespace Components\Encrypt;

/**
 * Provides an interface for encrypting data.
 *
 * @package Components\Encrypt
 */
interface EncryptInterface {

    /**
     * Encrypts the data.
     *
     * @return string
     *   The encrypted data.
     *
     * @throws \Defuse\Crypto\Exception\BadFormatException
     * @throws \Defuse\Crypto\Exception\EnvironmentIsBrokenException
     */
    public function encrypt(): string;

    /**
     * Decrypts the data.
     *
     * @return string
     *   The decrypted data.
     *
     * @throws \Defuse\Crypto\Exception\BadFormatException
     * @throws \Defuse\Crypto\Exception\EnvironmentIsBrokenException
     * @throws \Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException
     */
    public function decrypt(): string;

}
