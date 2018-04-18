<?php


require_once getFromConfig('models').'navigatorModel.php';

function main()
{
    $link = $_GET['path'] ?? __DIR__;
    pageRender('head', ['title'=>'Files explorer']);
    pageRender('navigator/filesList', ['li'=>getFilesList($link)]);
}


function outFile()
{
    print_r(readFileAsText($_GET['path']));
}

function getParsedFilesList($filesArray)
{

}