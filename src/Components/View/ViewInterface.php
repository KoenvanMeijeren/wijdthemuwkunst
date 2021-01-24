<?php

namespace Components\View;

/**
 * Provides an interface for subclasses of the view.
 *
 * @package src\View
 */
interface ViewInterface {

  /**
   * The different layout types.
   *
   * @var string
   */
  public const LAYOUT_PUBLIC = 'layout.view.php';
  public const LAYOUT_ADMIN = 'admin.layout.view.php';

}
