<?php

namespace App\System\Controller;

use App\Domain\Admin\Cms\Structure\MenuTrait;
use Domain\Admin\Accounts\User\Models\User;
use Src\Core\Request;
use Src\View\DomainView;

abstract class AdminControllerBase
{
    use MenuTrait;

    protected string $baseViewPath = '';
    protected array $menuItems = [];

    protected Request $request;
    protected User $user;

    public function __construct()
    {
        $this->user = new User();
        $this->request = new Request();

        $this->menuItems['menuItems'] = [
            'content' => $this->contentMenu(),
            'structure' => $this->structureMenu(),
            'configuration' => $this->configurationMenu(),
            'reports' => $this->reportsMenu(),
        ];
    }

    /**
     * Returns a domain view.
     *
     * @param string $name
     * @param array $content
     *
     * @return DomainView
     */
    protected function view(string $name, array $content = []): DomainView
    {
        $content = array_merge($content, $this->menuItems);

        return new DomainView($this->baseViewPath . $name, $content);
    }
}
