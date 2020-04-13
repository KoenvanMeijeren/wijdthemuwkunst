<?php
declare(strict_types=1);


namespace Support;

use Src\Security\CSRF;
use Src\Translation\Translation;

final class Resource
{
    public static function loadStringMessage(): void
    {
        includeFile(RESOURCES_PATH . '/partials/error.view.php');
    }

    public static function loadFlashMessage(): void
    {
        includeFile(RESOURCES_PATH . '/partials/flash.view.php');
    }

    public static function addTableEditColumn(
        string $editAction,
        string $destroyAction,
        string $destroyMessageWarning,
        bool $disableDestroyButton = false
    ): string {
        $disabledDestroyButton = '';
        $removeBorder = '';
        if ($disableDestroyButton) {
            $removeBorder = 'border-0';
            $disabledDestroyButton = 'disabled';
        }

        return '<div class="table-edit-row flex">
                    <a href="' . $editAction . '"
                       class="btn btn-success flex-child edit-button"
                       data-toggle="tooltip"
                       data-placement="top"
                       title="' . Translation::get('table_row_edit') . '">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form method="post"
                          action="' . $destroyAction . '">
                          ' . CSRF::insertToken($destroyAction) . '
                        <button class="btn btn-danger flex-child edit-button ' . $removeBorder . '"
                                type="submit"
                                data-toggle="tooltip"
                                data-placement="top"
                                ' . $disabledDestroyButton . '
                                title="' . Translation::get('table_row_delete') . '"
                                onclick="return confirm(\'' . $destroyMessageWarning . '\')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>';
    }

    /**
     * Add a table button action column.
     */
    public static function addTableButtonActionColumn(
        string $action,
        string $actionTitle,
        string $icon,
        string $classes = 'btn-primary',
        string $actionWarningMessage = '',
        bool $disableAction = false
    ): string {
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
                        <button class="btn '.$classes.' flex-child edit-button"
                                type="submit"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="' . $actionTitle . '"
                                '.$message.'>
                            <i class="'.$icon.'"></i>
                        </button>
                    </form>';
    }

    /**
     * Add a table link action column.
     */
    public static function addTableLinkActionColumn(
        string $action,
        string $actionTitle,
        string $icon
    ): string {
        return '<a href="' . $action . '"
                       class="btn btn-success flex-child edit-button"
                       data-toggle="tooltip"
                       data-placement="top"
                       title="' . $actionTitle . '">
                        <i class="'.$icon.'"></i>
                    </a>';
    }
}
