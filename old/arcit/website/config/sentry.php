<?php

return array(
    'dsn' => env('SENTRY_DSN'),

    // capture release as git sha
    'release' => config('common.site.version'),

    // Capture bindings on SQL queries
    'breadcrumbs.sql_bindings' => true,

    // Capture default user context
    'user_context' => false,
);
