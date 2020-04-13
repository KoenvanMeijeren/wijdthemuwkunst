<?php


namespace App\Domain\Admin\Cms\Structure\Controllers;


use Domain\Admin\Accounts\User\Models\User;
use Src\Translation\Translation;
use Src\View\DomainView;

final class StructureController
{
    private User $user;

    private string $baseViewPath = 'Admin/Cms/Structure/Views/';

    public function __construct()
    {
        $this->user = new User();
    }

    public function index(): DomainView
    {
        $items = [
            'content' => [
                'icon' => 'far fa-file-alt',
                'title' => Translation::get('admin_content_title'),
                'link' => '/admin/content',
            ],
            'structure' => [
                'icon' => 'fas fa-sitemap',
                'title' => Translation::get('admin_structure_title'),
                'link' => '/admin/structure',
            ],
            'configuration' => [
                'icon' => 'fas fa-cogs',
                'title' => Translation::get('admin_configuration_title'),
                'link' => '/admin/configuration',
            ],
            'accounts' => [
                'icon' => 'fas fa-users',
                'title' => Translation::get('admin_accounts_title'),
                'link' => '/admin/accounts',
            ],
            'reports' => [
                'icon' => 'fas fa-chart-bar',
                'title' => Translation::get('admin_reports_title'),
                'link' => '/admin/reports',
            ],
        ];

        return $this->view(Translation::get('admin_dashboard_title'), $items);
    }

    public function content(): DomainView
    {
        $items = [
            'pages' => [
                'icon' => 'far fa-file-alt',
                'title' => Translation::get('admin_menu_pages'),
                'link' => '/admin/pages',
            ],
            'events' => [
                'icon' => 'fas fa-church',
                'title' => Translation::get('admin_menu_events'),
                'link' => '/admin/concerten',
            ],
            'contact-form' => [
                'icon' => 'far fa-envelope',
                'title' => Translation::get('admin_menu_contact_form'),
                'link' => '/admin/contact-form',
            ],
        ];

        return $this->view(Translation::get('admin_content_title'), $items);
    }

    public function structure(): DomainView
    {
        $items = [
            'menu' => [
                'icon' => 'fas fa-bars',
                'title' => Translation::get('admin_menu_menu'),
                'link' => '/admin/menu',
            ],
        ];

        return $this->view(Translation::get('admin_structure_title'), $items);
    }

    public function configuration(): DomainView
    {
        $items = [
            'texts' => [
                'icon' => 'fas fa-language',
                'title' => Translation::get('admin_menu_texts'),
                'link' => '/admin/texts',
            ],
            'settings' => [
                'icon' => 'fas fa-sliders-h',
                'title' => Translation::get('admin_menu_settings'),
                'link' => '/admin/settings',
            ],
        ];

        return $this->view(Translation::get('admin_configuration_title'), $items);
    }

    public function reports(): DomainView
    {
        $items = [
            'application' => [
                'icon' => 'fas fa-server',
                'title' => Translation::get('admin_reports_application_title'),
                'link' => '/admin/reports/application',
            ],
            'logs' => [
                'icon' => 'fas fa-database',
                'title' => Translation::get('admin_reports_logs_title'),
                'link' => '/admin/reports/logs',
            ],
            'storage' => [
                'icon' => 'far fa-copy',
                'title' => Translation::get('admin_reports_storage_title'),
                'link' => '/admin/reports/storage',
            ],
        ];

        return $this->view(Translation::get('admin_reports_title'), $items);
    }

    private function view(string $title, array $items): DomainView
    {
        return new DomainView($this->baseViewPath . 'index', [
            'title' => $title,
            'items' => $items,
        ]);
    }
}
