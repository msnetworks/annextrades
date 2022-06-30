<?php

namespace App\Http\Middleware;

use Common\Core\BaseVerifyCsrfToken;

class VerifyCsrfToken extends BaseVerifyCsrfToken
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'billing/stripe/webhook',
        'billing/paypal/webhook',
        'secure/auth/login',
        'secure/auth/register',
        'secure/auth/logout',
    ];
}
