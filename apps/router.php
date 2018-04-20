<?php
/**
 *  file: router.php
 *  purpose: process url and choose controller or send error page
 */


/**
 * @purpose parses users request and executes it
 */
function processRequest()
{
    $url = parseUrl($_SERVER['REQUEST_URI']);
    executeRequest($url);
}

/**
 * @param string $url
 * @return array
 * @purpose removes from $url needles symbols and splits it on two parts: [{$controllerName}, {$methodName}]
 */
function parseUrl(string $url): array
{
    $buffer = trim($url, " /\t\n\r\0\x0B");
    if(false != $enteringIndex = stripos($url, '?')) {
        $buffer = substr($url, 1, $enteringIndex-1);
    }
    $parsedUrl = explode('/', $buffer);
    return (empty($parsedUrl[0]))?[getFromConfig('home')]:$parsedUrl;
}

/**
 * @param array $data
 * @return null|string
 * @purpose returns controllers link depends on in name in controllers DIR or null
 */
function chooseController(array $data)
{
    $file = getFromConfig('controlers').$data[0].'Controller.php';
    if(file_exists($file)) {
        return $file;
    }
    return null;
}

/**
 * @param string $value
 * @return null
 * @purpose gets info from config or returns null
 */
function getFromConfig(string $value)
{
    global $config;
    return (array_key_exists($value, $config))? $config[$value] : null;
}

/**
 * @param array $request
 * @return mixed
 * @purpose executing users recuest or throws 404 if controller does not exists
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
    throw404();
}

/**
 * @param bool $toDie
 * @purpose redirects user on previous page or to home page and stops script if $toDie == true
 */
function redirectBack($toDie=false)
{
    if(isset($_SERVER['HTTP_REFERER'])){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    else {
        header('Location: ..');
    }
    if($toDie) die;
}

/**
 * @purpose sends header 404 and stops script
 */
function throw404()
{
    header("HTTP/1.0 404 Not Found");
    if(file_exists(getFromConfig('errors').'404.php')) {
        include getFromConfig('errors').'404.php';
    }
    else {
        echo '<h1>404</h1>';
    }
    exit;
}