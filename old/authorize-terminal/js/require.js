require.config({
    paths: {
        jquery: 'libs/jquery/jquery',
        underscore: 'libs/underscore/underscore',
        backbone: 'libs/backbone/backbone',
        bootstrap: 'libs/bootstrap',
        jquerytablesorter: 'libs/tablesorter/jquery.tablesorter',
        tablesorter: 'libs/tablesorter/tables',
        ajaxupload: 'libs/ajax-upload',
        templates: '../templates'
    },
    shim: {
        'backbone': {
            deps: ['underscore', 'jquery'],
            exports: 'Backbone'
        },
        'jquery': {
            exports: '$'
        },
        'bootstrap': {
            deps: ['jquery'],
            exports: '$'
        },
        'jquerytablesorter': {
            deps: ['jquery'],
            exports: '$'
        },
        'tablesorter': {
            deps: ['jquery'],
            exports: '$'
        },
        'ajaxupload': {
            deps: ['jquery'],
            exports: '$'
        },
        'underscore': {
            exports: '_'
        },
    }
});
require(['app', ], function(App) {
    App.initialize();
});