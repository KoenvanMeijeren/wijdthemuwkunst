<?php
declare(strict_types=1);

namespace System\View;

use Components\File\Exceptions\FileNotFoundException;
use Components\SuperGlobals\Url\Uri;
use Components\View\BaseView;
use JetBrains\PhpStorm\ArrayShape;
use Modules\Cms\Structure\MenuAdminTrait;
use Modules\Menu\Entity\Menu;
use System\Entity\EntityManager;

/**
 * Provides a base view for domain views.
 *
 * @package System\View
 */
final class DomainView extends BaseView {

  use MenuAdminTrait;

  /**
   * {@inheritDoc}
   */
  protected string $viewDirectory = DOMAIN_PATH . '/';

  /**
   * Determines if the current view must be displayed for admins.
   *
   * @var bool
   */
  protected bool $isAdminView = false;

  /**
   * {@inheritDoc}
   */
  public function __construct(string $name, array $content = []) {
    $this->isAdminView = str_contains(Uri::getUrl(), 'admin');

    $layout = $this->isAdminView ? self::LAYOUT_ADMIN : self::LAYOUT_PUBLIC;
    $globalContent = $this->isAdminView ? $this->globalAdminContent() : $this->globalContent();
    $content = array_merge($content, $globalContent);

    parent::__construct($layout, $name, $content);
  }

  /**
   * {@inheritDoc}
   */
  protected function renderContent(string $name, array $content = []): string {
    try {
      return parent::renderContent($name, $content);
    } catch (FileNotFoundException $exception) {
      $this->viewDirectory = MODULE_PATH . '/';
      return parent::renderContent($name, $content);
    }
  }

  /**
   * Provides global content for domain views.
   *
   * @return array
   *   The global content.
   */
  #[ArrayShape(['menuItems' => "object[]"])]
  protected function globalContent(): array {
    $entityManager = new EntityManager();
    $repository = $entityManager->getStorage(Menu::class)->getRepository();

    return [
      'menuItems' => $repository->all(),
    ];
  }

  /**
   * Provides global content for domain views for admins.
   *
   * @return array
   *   The global content.
   */
  #[ArrayShape(['menuItems' => "array"])]
  protected function globalAdminContent(): array {
    return [
      'menuItems' => [
        'content' => $this->contentMenu(),
        'structure' => $this->structureMenu(),
        'configuration' => $this->configurationMenu(),
        'reports' => $this->reportsMenu(),
      ],
    ];
  }

}
