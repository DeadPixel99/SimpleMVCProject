<?php
/**
 *  file: router.php
 *  purpose: process url and choose controller or send error page
 */


/*
 * parses users request and executes it
 */
function processRequest()
{
    $url = parseUrl($_SERVER['REQUEST_URI']);
    executeRequest($url);
}

/*
 * romoves unsupported by router symbols from URL
 */
function parseUrl(string $url): array
{
    $buffer = trim($url, " /\t\n\r\0\x0B");
    if(false != $enteringIndex = stripos($url, '?')) {
        $buffer = substr($url, 1, $enteringIndex);
    }
    $parsedUrl = explode('/', $buffer);
    return (empty($parsedUrl[0]))?[getFromConfig('home')]:$parsedUrl;
}

/*
 * chooses controller depends on request or throws 404
 */
function chooseController(array $data)
{
    $file = getFromConfig('controlers').$data[0].'Controller.php';
    if(file_exists($file)) {
        return $file;
    }
    return null;
}

/*
 * gets info from config or returns null
 */
function getFromConfig(string $value)
{
    global $config;
    return (array_key_exists($value, $config))? $config[$value] : null;
}

/*
 * executing users recuest or throws 404 if controller does not exists
 */
function executeRequest(array $request)
{
    if(null != $controller = chooseController($request)) {
        require_once $controller;
        $method = $request[1] ?? 'main';
        if(function_exists($method)) {
            return $method();
        }
    }
    header("HTTP/1.0 404 Not Found");
    if(file_exists(getFromConfig('errors').'404.php')) {
        include getFromConfig('errors').'404.php';
    }
    else {
        echo '<h1>404</h1>';
    }
    exit;
}