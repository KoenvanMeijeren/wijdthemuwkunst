<?php


namespace App\System\Mail;

use PHPMailer\PHPMailer\PHPMailer;

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

  /**
   * Sets the CC address.
   *
   * @param string $email
   *   The email address.
   * @param string $name
   *   The name of the person.
   */
  public function addCc(string $email, string $name): void;

  /**
   * Sets the BCC address.
   *
   * @param string $email
   *   The email address.
   * @param string $name
   *   The name of the person.
   */
  public function addBCC(string $email, string $name): void;

  /**
   * Sets the subject of the mail.
   *
   * @param string $subject
   *   The subject of the mail.
   */
  public function setSubject(string $subject): void;

  /**
   * Sets the body of the mail.
   *
   * @param string $baseViewPath
   *   The path of to the view directory.
   * @param string $mail
   *   The default mail template.
   * @param string $plainTextMail
   *   The fallback mail template.
   * @param string[] $content
   *   The content of the mail.
   */
  public function setBody(string $baseViewPath, string $mail, string $plainTextMail, array $content = []): void;

  /**
   * Sets the alt body of the mail.
   *
   * @param string $body
   *   The textual body.
   */
  public function setAltBody(string $body): void;

  /**
   * Create a message body from an HTML string.
   * Automatically inlines images and creates a plain-text version by converting the HTML,
   * overwriting any existing values in Body and AltBody.
   * Do not source $message content from user input!
   * $basedir is prepended when handling relative URLs, e.g. <img src="/images/a.png"> and must not be empty
   * will look for an image file in $basedir/images/a.png and convert it to inline.
   * If you don't provide a $basedir, relative paths will be left untouched (and thus probably break in email)
   * Converts data-uri images into embedded attachments.
   * If you don't want to apply these transformations to your HTML, just set Body and AltBody directly.
   *
   * @param string $message
   *   HTML message string.
   * @param string $baseDir
   *   Absolute path to a base directory to prepend to relative paths to images.
   */
  public function setHtmlMessage(string $message, string $baseDir): void;

  /**
   * Add an attachment from a path on the filesystem.
   * Never use a user-supplied path to a file!
   * Returns false if the file could not be found or read.
   * Explicitly *does not* support passing URLs; PHPMailer is not an
   * HTTP client. If you need to do that, fetch the resource yourself
   * and pass it in via a local file or string.
   *
   * @param string $path
   *   Path to the attachment.
   * @param string $name
   *   Overrides the attachment name.
   * @param string $encoding
   *   File encoding.
   * @param string $type
   *   Disposition to use.
   */
  public function addAttachment(string $path, string $name = '', string $encoding = PHPMailer::ENCODING_BASE64, string $type = ''): void;

  /**
   * @param string $path
   *   Path to the attachment.
   * @param string $cid
   *   Content ID of the attachment; Use this to reference the content
   *   when using an embedded image in HTML.
   * @param string $name
   *   Overrides the attachment name.
   * @param string $encoding
   *   File encoding.
   * @param string $type
   *   File MIME type.
   */
  public function addEmbeddedImage(string $path, string $cid, string $name = '', string $encoding = PHPMailer::ENCODING_BASE64, string $type = ''): void;

  /**
   * Sends the mail to the specified addresses.
   *
   * @return bool
   *   Wheter the mail was send successfully.
   */
  public function send(): bool;
}
