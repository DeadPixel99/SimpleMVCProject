<?php

function main()
{
    pageRender('head', ['title'=>'homepage']);
    pageRender('home', ['clist'=>getControllersList()]);
}

function getControllersList()
{
    $controllersList = [];
    foreach (scandir(getFromConfig('controlers')) as $name)
    {
        array_push($controllersList, $name);
    }

    return $controllersList;
}