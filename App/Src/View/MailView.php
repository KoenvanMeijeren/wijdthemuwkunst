<?php
declare(strict_types=1);


namespace Src\View;

final class MailView extends BaseMailView
{
    /**
     * Render a partial view into the layout view.
     *
     * @param string    $name      the name of the partial view
     * @param mixed[]   $content   the content of the partial view
     *
     * @return string
     */
    protected function render(string $name, array $content = []): string
    {
        ob_start();

        includeFile("{$name}.view.php", $content);

        return (string) ob_get_clean();
    }
}
