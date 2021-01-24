<?php
declare(strict_types=1);

namespace Components\View;

use Components\File\File;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;

/**
 * Provides a base view for views.
 *
 * @package src\View
 */
abstract class BaseView implements ViewInterface {

  /**
   * The path to the layout template.
   *
   * @var string
   */
  protected string $layoutPath = RESOURCES_PATH . '/layout/%name%';

  /**
   * Constructs the base view.
   *
   * @param string $layout
   *   The layout of the whole view.
   * @param string $name
   *   The name of the partial view.
   * @param mixed[] $content
   *   The content of the partial view.
   */
  protected function __construct(string $layout, string $name, array $content) {
    $filesystemLoader = new FilesystemLoader($this->layoutPath);
    $templating = new PhpEngine(new TemplateNameParser(), $filesystemLoader);

    echo $templating->render($layout, [
      'content' => $this->renderContent($name, $content),
      'data' => $content,
    ]);
  }

  /**
   * Renders a partial view into the layout view.
   *
   * @param string $name
   *   The name of the partial view.
   * @param mixed[] $content
   *   The content of the partial view.
   *
   * @return string
   *   The rendered content.
   */
  /**
   * {@inheritDoc}
   */
  protected function renderContent(string $name, array $content = []): string {
    $file = new File(directory: RESOURCES_PATH . "/partials/", file: "{$name}.view.php");

    return $file->get($content);
  }

}
