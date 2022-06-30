<?php namespace App\Http\Controllers;

use App\Project;
use App\Services\ProjectRepository;
use Common\Core\BaseController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use League\Flysystem\Adapter\Ftp as Adapter;
use League\Flysystem\Filesystem;
use League\Flysystem\MountManager;
use Storage;

class PublishProjectController extends BaseController
{
    /**
     * Request instance.
     *
     * @var Request
     */
    private $request;

    /**
     * @var Project
     */
    private $project;

    /**
     * @var ProjectRepository
     */
    private $repository;

    /**
     * @param Request $request
     * @param Project $project
     * @param ProjectRepository $repository
     */
    public function __construct(Request $request, Project $project, ProjectRepository $repository)
    {
        $this->request = $request;
        $this->project = $project;
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function publish($id)
    {
        $project = $this->project->findOrFail($id);

        $this->authorize('publish', $project);

        $this->validate($this->request, [
            'host' => 'required|string|min:1',
            'username' => 'required|string|min:1',
            'password' => 'required|string|min:1',
            'port' => 'integer|min:1',
            'root' => 'string|min:1',
            'ssl' => 'required|boolean',
        ]);


        try {
            $this->publishToFtp($project);
        } catch (Exception $e) {
            return $this->error(['*' => $e->getMessage()]);
        }

        return $this->success();
    }

    /**
     * Publish specified project to FTP using flysystem.
     *
     * @param Project $project
     */
    public function publishToFtp(Project $project)
    {
        $directory = $this->request->get('directory');

        $ftp = new Filesystem(new Adapter([
            'host' => $this->request->get('host'),
            'username' => $this->request->get('username'),
            'password' => $this->request->get('password'),
            'port' => $this->request->get('port', $this->getDefaultPort()),
            'passive' => true,
            'ssl' => $this->request->get('ssl', false),
            'timeout' => 30,
        ]));

        $manager = new MountManager([
            'ftp' => $ftp,
            'local' => Storage::disk('projects')->getDriver(),
        ]);

        if ($directory && $directory !== '/' && ! $ftp->has($directory)) {
            $ftp->createDir($directory);
        }

        $projectRoot = $this->repository->getProjectPath($project);

        foreach ($manager->listContents("local://$projectRoot", true) as $file) {
            if ($file['type'] !== 'file') continue;
            $filePath = str_replace($projectRoot, $directory, $file['path']);

            // delete old files from ftp
            if ($ftp->has($filePath)) {
                $ftp->delete($filePath);
            }

            // copy file from local disk to ftp
            $manager->copy('local://'.$file['path'], 'ftp://'.$filePath);
        }
    }

    /**
     * Get default port for ftp.
     *
     * @return int
     */
    private function getDefaultPort() {
        return $this->request->get('ssl') ? 22 : 21;
    }
}
