<?php

namespace Modules\Text;

use System\Module\ModuleBase;

/**
 * Defines the text module.
 *
 * @package Domain\Admin\Text
 */
class TextModule extends ModuleBase {

  /**
   * {@inheritDoc}
   */
  public function getName(): string {
    return 'Text';
  }

}
