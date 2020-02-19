<?php
declare(strict_types=1);


namespace Src\View;

abstract class BaseMailView
{
    private string $mail;

    /**
     * @param string    $baseViewPath    the layout of the whole view.
     * @param string    $name            the name of the partial view.
     * @param mixed[]   $content         the content of the partial view.
     */
    public function __construct(string $baseViewPath, string $name, array $content)
    {
        $this->mail = $this->render(DOMAIN_PATH . '/' . $baseViewPath . '/' . $name, $content);
    }

    public function __toString()
    {
        return $this->mail;
    }

    /**
     * Render a partial view into the layout view.
     *
     * @param string    $name      the name of the partial view
     * @param mixed[]   $content   the content of the partial view
     *
     * @return string
     */
    abstract protected function render(string $name, array $content = []): string;
}
