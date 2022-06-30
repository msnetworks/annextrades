<?php

namespace App\Http\Controllers;

use Common\Core\BaseController;
use Illuminate\Http\Request;

class ProjectContactFormController extends BaseController
{
    public function sendMessage(Request $request)
    {
        // TODO: implement
        dd($request->all());
    }
}
