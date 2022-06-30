<?php

namespace Common\Files\Controllers;

use Common\Core\BaseController;
use Common\Files\Actions\GetServerMaxUploadSize;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServerMaxUploadSizeController extends BaseController
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        if ( ! $this->request->user()->hasPermission('admin')) {
            abort(403);
        }

        return $this->success([
            'maxSize' => app(GetServerMaxUploadSize::class)->execute()['original'],
        ]);
    }
}
