<?php

namespace App\Http\Middleware;

use App\Project;
use App\Services\RenderUserSite;
use Closure;
use Illuminate\Http\Request;

class RedirectIfCustomDomain
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (app()->bound('matchedCustomDomain') && $domain = app('matchedCustomDomain')) {
            $project = app(Project::class)->findOrFail($domain->resource_id);
            return response(app(RenderUserSite::class)->execute($project, $request->segment(1)));
        }

        return $next($request);
    }
}
