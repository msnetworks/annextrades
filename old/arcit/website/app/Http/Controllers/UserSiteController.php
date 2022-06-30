<?php

namespace App\Http\Controllers;

use App\Project;
use App\Services\RenderUserSite;
use Common\Core\BaseController;
use Common\Settings\Settings;
use Illuminate\Http\Request;

class UserSiteController extends BaseController
{
    /**
     * @var Project
     */
    private $project;

    /**
     * @var Settings
     */
    private $settings;

    /**
     * @var Request
     */
    private $request;

    /**
     * @param Project $project
     * @param Settings $settings
     * @param Request $request
     */
    public function __construct(
        Project $project,
        Settings $settings,
        Request $request
    )
    {
        $this->project = $project;
        $this->settings = $settings;
        $this->request = $request;
    }

    /**
     * @param string $projectSlug
     * @param string|null $pageName
     * @param null $tls
     * @param null $page
     * @return string
     */
    public function show($projectSlug, $pageName = null, $tls = null, $page = null)
    {
        $project = $this->project->where('slug', $projectSlug)->firstOrFail();

        //if it's subdomain routing, laravel will pass subdomain, domain, tls and then page name
        $pageName = $page ? $page : $pageName;

        $this->authorize('show', $project);

        return app(RenderUserSite::class)->execute($project, $pageName);
    }
}
