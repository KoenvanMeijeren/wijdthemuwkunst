<?php
declare(strict_types=1);


namespace Domain\Admin\Dashboard\Controllers;

use Src\Translation\Translation;
use Src\View\DomainView;

final class DashboardController
{
    private string $baseViewPath = 'Admin/Dashboard/Views/';

    public function index(): DomainView
    {
        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => Translation::get('admin_dashboard_title')
            ]
        );
    }
}
