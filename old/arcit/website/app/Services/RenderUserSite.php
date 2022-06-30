<?php

namespace App\Services;

use App\Project;
use Common\Settings\Settings;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;

class RenderUserSite
{
    /**
     * @var Project
     */
    private $project;
    /**
     * @var ProjectRepository
     */
    private $repository;
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
     * @param ProjectRepository $repository
     * @param Settings $settings
     * @param Request $request
     */
    public function __construct(
        Project $project,
        ProjectRepository $repository,
        Settings $settings, Request $request
    )
    {
        $this->project = $project;
        $this->repository = $repository;
        $this->settings = $settings;
        $this->request = $request;
    }

    /**
     * @param Project $project
     * @param string $pageName
     * @return string
     */
    public function execute($project, $pageName)
    {
        try {
            $html = $this->repository->getPageHtml($project, $pageName);
            return $this->replaceRelativeLinks($project, $html);
        } catch (FileNotFoundException $e) {
            return abort(404);
        }
    }

    /**
     * Replace relative urls in html to absolute ones.
     *
     * @param Project $project
     * @param string $html
     * @return mixed
     */
    private function replaceRelativeLinks($project, $html)
    {
        preg_match_all('/<a.*?href="(.+?)"/i', $html, $matches);

        //there are no links in html
        if ( ! isset($matches[1])) return $html;

        if ($project->domain || $this->settings->get('builder.enable_subdomains')) {
            $baseForUrls = $this->request->root();
        } else {
            $baseForUrls = url("sites/$project->name");
        }

        $baseForAssets = str_contains($baseForUrls, 'sites') ?
            url('') :
            $baseForUrls;

        $projectRoot = "$baseForAssets/storage/projects/{$project->users->first()->id}/$project->uuid";
        $html = str_replace('<head>', "<head>\n<base href=\"$projectRoot/\">", $html);

        //get rid of duplicate links
        $urls = array_unique($matches[1]);

        foreach ($urls as $url) {
            //if link is already absolute or an ID, continue to next one
            if (starts_with($url, ['//', 'http'])) continue;

            $searchUrl = str_replace('/', '\/', $url);
            $searchStr = "/href=\"$searchUrl\"/i";

            if (starts_with($url, '#')) {
                $html = preg_replace($searchStr, "href=\"{$baseForUrls}{$url}\"", $html);
            } else {
                $html = preg_replace($searchStr, "href=\"$baseForUrls/$url\"", $html);
            }
        }

        return $html;
    }
}
