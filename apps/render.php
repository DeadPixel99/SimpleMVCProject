<?php
/*
 * file: render.php
 * purpose: render views
 */

function pageRender(string $pageName, $elements = []) {
    extract($elements);
    return include findView($pageName);
}

function findView(string $pageName)
{
    global $config;
    if(!file_exists($config['views'].$pageName.'View.php')) {
        die;
    }
    return $config['views'].$pageName.'View.php';
}