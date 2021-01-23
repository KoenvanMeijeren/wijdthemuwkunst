<?php
declare(strict_types=1);

namespace Support;

use Src\Security\CSRF;
use Components\Translation\TranslationOld;

/**
 * Provides a class for easy generating some HTML.
 *
 * @package Support
 */
final class Resource {

  /**
   * Loads a message formatted as a string.
   */
  public static function loadStringMessage(): void {
    include_file(RESOURCES_PATH . '/partials/error.view.php');
  }

  /**
   * Loads a message formatted as a one time visible string.
   */
  public static function loadFlashMessage(): void {
    include_file(RESOURCES_PATH . '/partials/flash.view.php');
  }

  /**
   * Adds a table edit column.
   *
   * @param string $editAction
   *   The edit action.
   * @param string $destroyAction
   *   The destroy action.
   * @param string $destroyMessageWarning
   *   The destroy message warning.
   * @param bool $disableDestroyButton
   *   Determine if the destroy button must be disabled.
   *
   * @return string
   *   The table edit column.
   */
  public static function addTableEditColumn(string $editAction, string $destroyAction, string $destroyMessageWarning, bool $disableDestroyButton = FALSE): string {
    $disabledDestroyButton = '';
    $removeBorder = '';
    if ($disableDestroyButton) {
      $removeBorder = 'border-0';
      $disabledDestroyButton = 'disabled';
    }

    return '<div class="table-edit-row flex">
                    <a href="' . $editAction . '"
                       class="btn btn-outline-success table-edit-button"
                       data-toggle="tooltip"
                       data-placement="top"
                       title="' . TranslationOld::get('table_row_edit') . '">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form method="post"
                          action="' . $destroyAction . '">
                          ' . CSRF::insertToken($destroyAction) . '
                        <button class="btn btn-outline-danger table-edit-button ' . $removeBorder . '"
                                type="submit"
                                data-toggle="tooltip"
                                data-placement="top"
                                ' . $disabledDestroyButton . '
                                title="' . TranslationOld::get('table_row_delete') . '"
                                onclick="return confirm(\'' . $destroyMessageWarning . '\')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>';
  }

  /**
   * Adds a table action button.
   *
   * @param string $action
   *   The action.
   * @param string $actionTitle
   *   The title of the action.
   * @param string $icon
   *   The icon of the button.
   * @param string $classes
   *   The extra classes added to the button.
   * @param string $actionWarningMessage
   *   The action warning message.
   * @param bool $disableAction
   *   Determines if the action can be executed by the user.
   *
   * @return string
   *   The table action button.
   */
  public static function addTableButtonActionColumn(string $action, string $actionTitle, string $icon, string $classes = 'btn-outline-primary', string $actionWarningMessage = '', bool $disableAction = FALSE): string {
    if ($disableAction) {
      return '';
    }

    $message = '';
    if ($actionWarningMessage !== '') {
      $message = 'onclick="return confirm(\'' . $actionWarningMessage . '\')"';
    }

    return '<form method="post"
                          action="' . $action . '">
                          ' . CSRF::insertToken($action) . '
                        <button class="btn ' . $classes . ' table-edit-button"
                                type="submit"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="' . $actionTitle . '"
                                ' . $message . '>
                            <i class="' . $icon . '"></i>
                        </button>
                    </form>';
  }

  /**
   * Adds a table link action column.
   *
   * @param string $action
   *   The action.
   * @param string $actionTitle
   *   The title of the action.
   * @param string $icon
   *   The icon.
   *
   * @return string
   *   The action link.
   */
  public static function addTableLinkActionColumn(string $action, string $actionTitle, string $icon): string {
    return '<a href="' . $action . '"
                       class="btn btn-outline-success table-edit-button"
                       data-toggle="tooltip"
                       data-placement="top"
                       title="' . $actionTitle . '">
                        <i class="' . $icon . '"></i>
                    </a>';
  }

}
