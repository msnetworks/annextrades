<?php

namespace Common\Core;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;

class BaseVerifyCsrfToken extends VerifyCsrfToken
{

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    /**
     * Determine if the request has a URI/Domain that should pass through CSRF verification.
     *
     * @param  Request  $request
     * @return bool
     */
    protected function inExceptArray($request)
    {
        if (config('common.site.demo')) {
            return true;
        }

        return parent::inExceptArray($request);
    }
}
