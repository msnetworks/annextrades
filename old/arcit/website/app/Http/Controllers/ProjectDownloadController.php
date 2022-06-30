<?php

namespace App\Http\Controllers;

use App\Services\ProjectRepository;
use Common\Core\BaseController;
use Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Zipper;

class ProjectDownloadController extends BaseController
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
     * Download specified project as a .zip
     *
     * @param int $id
     * @return BinaryFileResponse
     */
    public function download($id)
    {
        $project = $this->projectRepository->findOrFail($id);

        $this->authorize('download', $project);

        $source = Storage::disk('projects')->path($this->projectRepository->getProjectPath($project));
        $destination = "$source/$project->name.zip";

        // delete old project zip file
        if (file_exists($destination)) {
            unlink($destination);
        }

        // create a zip
        $files = glob($source);
        Zipper::make($destination)->add($files)->close();

        //download
        return response()->download($destination);
    }
}
