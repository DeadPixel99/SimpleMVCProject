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
            'type'=> $file['type'],
            'location'=>$file['location']
        ];
    }
    return $parsedFiles;
}

function makeDirForm()
{
    if(isset($_POST['futurePath']))
    {
        pageRender('head', ['title'=>'Make dir']);
        pageRender('navigator/createDir', ['path'=>$_POST['futurePath']]);
    }
}

function makeDirProccess()
{
    if(isset($_POST['path']) && $_POST['folderName']){
        createDir($_POST['path'], $_POST['folderName']);
        header("Location: ../navigator?path={$_POST['path']}");
    }
    else
        header("Location: ../navigator");

}

function navDelete()
{

}

function loadFile()
{
        foreach (getUploadedFiles("uploadedFile") as $file)
        {
            if(isset($_POST['futurePath']) && !empty($file['tmp_name'])) {
                copy($file['tmp_name'], $_POST['futurePath']."/{$file['name']}");
            }
        }
        redirectBack();
}


