<?php

require_once getFromConfig('models').'fileModel.php';

function view()
{
    $file = readFileAsText($_GET['path']);
    pageRender('head', ['title'=>'View']);
    pageRender('navigator/file', ['content'=>$file, 'path'=>$_GET['path']]);
}

function edit()
{
    if(!isset($_POST['fileLocation']) || !is_file($_POST['fileLocation'])){
        redirectBack(true);
    }
    $path = $_POST['fileLocation'];
    pageRender('head', ['title'=>'View']);
    pageRender('navigator/fileEdit', ['path'=>$path, 'content'=>readFileAsText($path)]);

}

function saveEditedFile()
{
    if(!isset($_POST['fileLocation']) || !is_file($_POST['fileLocation'])){
        throw404();
    }
    if(!isset($_POST['newContent'])){
        throw404();
    }
    updateTextFile($_POST['fileLocation'], $_POST['newContent']);
    header("Location: view?path={$_POST['fileLocation']}");
}