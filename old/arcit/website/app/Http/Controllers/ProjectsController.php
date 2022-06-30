<?php namespace App\Http\Controllers;

use App\Project;
use App\Services\ProjectRepository;
use Common\Core\BaseController;
use Common\Database\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectsController extends BaseController {

	/**
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
     * @return JsonResponse
     */
	public function index()
    {
        $this->authorize('index', [Project::class, $this->request->get('user_id')]);

        $paginator = (new Paginator($this->project, $this->request->all()));
        $paginator->with(['domain', 'users']);

        if ($this->request->has('user_id')) {
            $paginator->query()->whereHas('users', function(Builder $q) {
                return $q->where('users.id', $this->request->get('user_id'));
            });
        }

        if ($this->request->has('published') && $this->request->get('published') !== 'all') {
            $paginator->query()->where('published', $this->request->get('published'));
        }

        $pagination = $paginator->paginate();

        return $this->success(['pagination' => $pagination]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $project = $this->project->with('pages', 'users')->findOrFail($id);

        $this->authorize('show', $project);

        $project = $this->repository->load($project);

        return $this->success(['project' => $project]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function update($id)
    {
        $project = $this->project->with('users')->find($id);

        $this->authorize('update', $project);

        $this->validate($this->request, [
            'name' => 'string|min:1|max:255',
            'css' => 'nullable|string|min:1',
            'js' => 'nullable|string|min:1',
            'template' => 'nullable|string|min:1|max:255',
            'framework' => 'nullable|string|min:1|max:255',
            'theme' => 'nullable|string|min:1|max:255',
            'custom_element_css' => 'nullable|string|min:1',
            'published' => 'boolean',
            'pages' => 'array',
            'pages.*' => 'array',
        ]);

        $this->repository->update($project, $this->request->all());

        return $this->success(['project' => $this->repository->load($project)]);
    }

    /**
     * @return JsonResponse
     */
	public function store()
	{
	    $this->authorize('store', Project::class);

        $this->validate($this->request, [
            'name' => 'required|string|min:1|max:255|unique:projects',
            'slug' => 'string|min:3|max:30|unique:projects',
            'css' => 'nullable|string|min:1|max:255',
            'js' => 'nullable|string|min:1|max:255',
            'template' => 'nullable|array',
            'template.id' => 'integer',
            'template.css' => 'nullable|string|min:1',
            'template.js' => 'nullable|string|min:1',
            'uuid' => 'required|string|size:36',
            'published' => 'boolean',
            'framework' => 'nullable|string|max:255',
        ]);

        $project = $this->repository->create($this->request->all());

        return $this->success(['project' => $this->repository->load($project)]);
	}

    /**
     * @param int id
     * @return JsonResponse
     */
	public function destroy()
    {
        foreach ($this->request->get('ids') as $id) {
            $project = $this->project->findOrFail($id);

            $this->authorize('destroy', $project);

            $this->repository->delete($project);
        }

        return $this->success();
    }
}
