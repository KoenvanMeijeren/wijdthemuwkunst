<?php


namespace App\Domain\Admin\Cms\Structure\Controllers;


use App\System\Controller\AdminControllerBase;
use Src\Translation\Translation;
use Src\View\DomainView;

final class StructureControllerBase extends AdminControllerBase
{
    protected string $baseViewPath = 'Admin/Cms/Structure/Views/';

    public function index(): DomainView
    {
        return $this->view('index', [
            'title' => Translation::get('admin_dashboard_title'),
            'items' => $this->indexMenu($this->user),
        ]);
    }

    public function content(): DomainView
    {
        return $this->view('index', [
            'title' => Translation::get('admin_content_title'),
            'items' => $this->contentMenu(),
        ]);
    }

    public function structure(): DomainView
    {
        return $this->view('index', [
            'title' => Translation::get('admin_structure_title'),
            'items' => $this->structureMenu(),
        ]);
    }

    public function configuration(): DomainView
    {
        return $this->view('index', [
            'title' => Translation::get('admin_configuration_title'),
            'items' => $this->configurationMenu(),
        ]);
    }

    public function reports(): DomainView
    {
        return $this->view('index', [
            'title' => Translation::get('admin_reports_title'),
            'items' => $this->reportsMenu(),
        ]);
    }
}
