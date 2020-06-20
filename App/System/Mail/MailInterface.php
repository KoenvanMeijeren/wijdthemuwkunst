<?php


namespace App\System\Mail;

/**
 * Provides a interface for subclasses of the mail.
 *
 * @package App\System\Mail
 */
interface MailInterface
{

  /**
   * Sets the mail from address.
   *
   * @param string $email
   *   The email address.
   * @param string $name
   *   The name of the person.
   */
  public function setFrom(string $email, string $name): void;

  /**
   * Adds a address to send the mail to.
   *
   * @param string $email
   *   The email address.
   * @param string $name
   *   The name of the person.
   */
  public function addAddress(string $email, string $name): void;

  /**
   * Sets the reply to address.
   *
   * @param string $email
   *   The email address.
   * @param string $name
   *   The name of the person.
   */
  public function addReplyTo(string $email, string $name): void;

}
