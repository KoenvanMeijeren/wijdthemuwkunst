<?php
declare(strict_types=1);

namespace Components\View;

use Components\SuperGlobals\Url\Uri;

/**
 * Provides a class for normal views.
 *
 * @package src\View
 */
final class View extends BaseView {

  /**
   * {@inheritDoc}
   */
  protected string $viewDirectory = RESOURCES_PATH . "/partials/";

  /**
   * {@inheritDoc}
   */
  public function __construct(string $name, array $content = []) {
    $layout = self::LAYOUT_PUBLIC;
    if (str_contains(Uri::getUrl(), 'admin')) {
      $layout = self::LAYOUT_ADMIN;
    }

    parent::__construct($layout, $name, $content);
  }

}
