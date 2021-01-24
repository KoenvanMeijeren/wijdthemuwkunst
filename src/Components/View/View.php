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
  public function __construct(string $name, array $content = []) {
    $this->viewDirectory = RESOURCES_PATH . "/partials/";

    $layout = self::LAYOUT_PUBLIC;
    if (str_contains(Uri::getUrl(), 'admin')) {
      $layout = self::LAYOUT_ADMIN;
    }

    parent::__construct($layout, $name, $content);
  }

}
