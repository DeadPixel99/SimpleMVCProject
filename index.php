<?php
/**
 * File: index.html
 *Purpose: Point of entry
 */

$config = [
    'router'=>__DIR__.'/apps/router.php', // path to routing module
    'render'=>__DIR__.'/apps/render.php', // path to rendering module
    'models'=>__DIR__.'/models/',
    'views'=>__DIR__.'/views/',
    'controlers'=>__DIR__.'/controlers/',
    'errors'=>__DIR__.'/views/errors/', //folder for errors templates like 404 or 503
    'files'=>__DIR__.'/files/', //files folder
    'home'=>'homepage' //homepage
];

require_once $config['render'];
require_once $config['router'];

processRequest();
