<?php


namespace App\System\Breadcrumbs;


use Src\Core\URI;

final class Breadcrumbs
{
    public const MINIMUM_AMOUNT_OF_BREADCRUMBS = 2;

    protected string $url;
    protected array $urlParts = [];
    protected array $breadCrumbs = [];

    public function __construct()
    {
        $this->url = URI::getUrl();
        $this->urlParts = explode('/', $this->url);

        $this->setBreadcrumbs();
    }

    private function setBreadcrumbs(): void
    {
        // Convert the url parts into an array.
        $urlParts = $this->urlParts;
        foreach ($urlParts as $urlPart) {
            $lastUrlPart = array_key_last($urlParts);

            // Get the title for the current url.
            $title = $urlParts[$lastUrlPart];

            $url = '/' . implode('/', $urlParts);
            $this->breadCrumbs[$title] = $url;

            unset($urlParts[$lastUrlPart]);
        }

        $this->breadCrumbs = array_reverse($this->breadCrumbs, true);
    }

    public function generate(): string
    {
        $breadcrumbs = '<ul class="breadcrumb">';
        foreach ($this->breadCrumbs as $title => $url) {
            $breadcrumbs .= $this->buildLink($title, $url);
        }

        $breadcrumbs .= '</ul>';

        return $breadcrumbs;
    }

    private function buildLink($title, string $url): string
    {
        $title = ucfirst($title);

        return "<li><a class='mr-2' href='{$url}'>{$title}</a></li>";
    }

    public function visible(): bool
    {
        return count($this->urlParts) > self::MINIMUM_AMOUNT_OF_BREADCRUMBS;
    }
}
