<?php


require_once getFromConfig('models').'navigatorModel.php';

function main()
{
    $link = $_GET['path'] ?? __DIR__;
    $files = getParsedFilesList(getFilesList($link));
    pageRender('head', ['title'=>'Files explorer']);
    pageRender('navigator/filesList', ['li'=>$files]);
}


function outFile()
{
    print_r(readFileAsText($_GET['path']));
}

function getParsedFilesList($filesArray)
{
    $parsedFiles = [];
    foreach ($filesArray as $file)
    {
        $parsedFiles[] = [
            'name' => $file['name'],
            'realPath' => $file['path'],
            'path' => ($file['type']=='Dir')? 'navigator?path='.$file['path'] : 'file/view?path='.$file['path'],
            'icon'=> getIconForFile($file['type']),
            'type'=> $file['type']
        ];
    }
    return $parsedFiles;
}

function makeDir()
{

}

function navDelete()
{

}

