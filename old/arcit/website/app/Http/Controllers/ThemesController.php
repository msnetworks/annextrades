<?php namespace App\Http\Controllers;

use App\Services\ThemesLoader;
use Common\Core\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ThemesController extends BaseController {

    /**
     * @var Request
     */
    private $request;

    /**
     * @var ThemesLoader
     */
    private $loader;

    /**
     * Create new ThemesController instance.
     *
     * @param Request $request
     * @param ThemesLoader $loader
     */
	public function __construct(Request $request, ThemesLoader $loader)
	{
		$this->request = $request;
        $this->loader = $loader;
    }

    /**
     * Return all available templates.
     *
     * @return JsonResponse
     */
	public function index()
	{
	    $themes = $this->loader->loadAll();

	    return $this->success(['themes' => $themes]);
	}
}
