<?php
declare(strict_types=1);

namespace Modules\Cms\Structure;

use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\User\Models\User;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Provides a trait for the admin menu.
 *
 * @package Modules\Cms\Structure
 */
trait MenuAdminTrait {

  /**
   * The index menu.
   *
   * @param User $user
   *   The current user.
   *
   * @return array[]
   *   The index menu items.
   */
  #[ArrayShape(['content' => "array", 'structure' => "array", 'configuration' => "array", 'reports' => "array", 'accounts' => "array"])]
  protected function indexMenu(User $user): array {
    $items = [
      'content' => [
        'icon' => 'far fa-file-alt',
        'title' => TranslationOld::get('admin_content_title'),
        'link' => '/admin/content',
      ],
      'structure' => [
        'icon' => 'fas fa-sitemap',
        'title' => TranslationOld::get('admin_structure_title'),
        'link' => '/admin/structure',
      ],
      'configuration' => [
        'icon' => 'fas fa-cogs',
        'title' => TranslationOld::get('admin_configuration_title'),
        'link' => '/admin/configuration',
      ],
    ];

    if ($user->getRights() >= User::SUPER_ADMIN) {
      $items['accounts'] = [
        'icon' => 'fas fa-users',
        'title' => TranslationOld::get('admin_accounts_title'),
        'link' => '/admin/account',
      ];
    }

    if ($user->getRights() >= User::DEVELOPER) {
      $items['reports'] = [
        'icon' => 'fas fa-chart-bar',
        'title' => TranslationOld::get('admin_reports_title'),
        'link' => '/admin/reports',
      ];
    }

    return $items;
  }

  /**
   * The content menu.
   *
   * @return array[]
   *   The content menu items.
   */
  #[ArrayShape(['pages' => "array", 'events' => "array", 'contact-form' => "array"])]
  protected function contentMenu(): array {
    return [
      'pages' => [
        'icon' => 'far fa-file-alt',
        'title' => TranslationOld::get('admin_menu_pages'),
        'link' => '/admin/content/pages',
      ],
      'events' => [
        'icon' => 'fas fa-church',
        'title' => TranslationOld::get('admin_menu_events'),
        'link' => '/admin/content/events',
      ],
      'contact-form' => [
        'icon' => 'far fa-envelope',
        'title' => TranslationOld::get('admin_menu_contact_form'),
        'link' => '/admin/content/contact-form',
      ],
    ];
  }

  /**
   * The structure menu.
   *
   * @return array[]
   *   The structure menu items.
   */
  #[ArrayShape(['menu' => "array"])]
  protected function structureMenu(): array {
    return [
      'menu' => [
        'icon' => 'fas fa-bars',
        'title' => TranslationOld::get('admin_menu_menu'),
        'link' => '/admin/structure/menu',
      ],
    ];
  }

  /**
   * The configuration menu.
   *
   * @return array[]
   *   The configuration menu items.
   */
  #[ArrayShape(['texts' => "array", 'settings' => "array"])]
  protected function configurationMenu(): array {
    return [
      'texts' => [
        'icon' => 'fas fa-language',
        'title' => TranslationOld::get('admin_menu_texts'),
        'link' => '/admin/configuration/texts',
      ],
      'settings' => [
        'icon' => 'fas fa-sliders-h',
        'title' => TranslationOld::get('admin_menu_settings'),
        'link' => '/admin/configuration/settings',
      ],
    ];
  }

  /**
   * The reports menu.
   *
   * @return array[]
   *   The reports menu items.
   */
  #[ArrayShape(['application' => "array", 'logs' => "array", 'storage' => "array"])]
  protected function reportsMenu(): array {
    return [
      'application' => [
        'icon' => 'fas fa-server',
        'title' => TranslationOld::get('admin_reports_application_title'),
        'link' => '/admin/reports/application',
      ],
      'logs' => [
        'icon' => 'fas fa-database',
        'title' => TranslationOld::get('admin_reports_logs_title'),
        'link' => '/admin/reports/logs',
      ],
      'storage' => [
        'icon' => 'far fa-copy',
        'title' => TranslationOld::get('admin_reports_storage_title'),
        'link' => '/admin/reports/storage',
      ],
    ];
  }

}
