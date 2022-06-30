<?php

namespace App\Listeners;

use App\Project;
use App\Services\ProjectRepository;
use Common\Auth\Events\UsersDeleted;

class DeleteUserProjects
{
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @param  UsersDeleted  $event
     * @return void
     */
    public function handle(UsersDeleted $event)
    {
        $projects = app(Project::class)
            ->whereIn('user_id', $event->users->pluck('id'))
            ->get();

        $projects->each(function(Project $project) {
            $this->projectRepository->delete($project);
        });
    }
}
