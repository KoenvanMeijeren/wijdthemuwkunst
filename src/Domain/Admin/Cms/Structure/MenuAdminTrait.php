<?php

declare(strict_types=1);

namespace Domain\Admin\Cms\Structure;

use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\User\Models\User;

/**
 * Provides a trait for the admin menu.
 *
 * @package Domain\Admin\Cms\Structure
 */
trait MenuAdminTrait {

  /**
   *
   */
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
   *
   */
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
   *
   */
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
   *
   */
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
   *
   */
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
