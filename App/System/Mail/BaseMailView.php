<?php

declare(strict_types=1);


namespace System\Mail;

/**
 * Provides a base class for mail views.
 *
 * @package Src\View
 */
abstract class BaseMailView {

  /**
   * The name of the mail template.
   *
   * @var string
   */
  protected string $mail;

  /**
   * Constructs the mail view.
   *
   * @param string $baseViewPath
   *   The layout of the whole view.
   * @param string $name
   *   The name of the partial view.
   * @param mixed[] $content
   *   The content of the partial view.
   */
  public function __construct(string $baseViewPath, string $name, array $content) {
    $this->mail = $this->render(DOMAIN_PATH . '/' . $baseViewPath . '/' . $name, $content);
  }

  /**
   * Converts the mail view to a string.
   *
   * @return string
   *   The renderable mail view.
   */
  public function __toString() {
    return $this->mail;
  }

  /**
   * Render a partial view into the layout view.
   *
   * @param string $name
   *   The name of the partial view.
   * @param mixed[] $content
   *   The content of the partial view.
   *
   * @return string
   *   The renderable mail view.
   */
  abstract protected function render(string $name, array $content = []): string;

}
