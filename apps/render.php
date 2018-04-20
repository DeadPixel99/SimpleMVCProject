<?php
/*
 * file: render.php
 * purpose: render views
 */


/**
 * @param string $pageName
 * @param array $elements
 * @return mixed
 * @purpose renders html template with dynamic $elements
 */
function pageRender(string $pageName, $elements = []) {
    extract($elements);
    return include findView($pageName);
}

/**
 * @param string $pageName
 * @return string
 * @purpose finds $pageName template in ../vievs folder specified as {$pageName}View.php
 */
function findView(string $pageName)
{
    global $config;
    if(!file_exists($config['views'].$pageName.'View.php')) {
        die;
    }
    return $config['views'].$pageName.'View.php';
}