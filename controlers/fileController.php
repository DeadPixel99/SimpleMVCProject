<?php

require_once getFromConfig('models').'fileModel.php';

function view()
{
    pageRender('head', ['title'=>'View']);
    if(function_exists("readFileAs{$_GET['type']}"))
    {
        $file = call_user_func("readFileAs{$_GET['type']}" ,$_GET['path']);
        pageRender('navigator/file', ['content'=>$file, 'path'=>$_GET['path'], 'type'=>$_GET['type']]);
    }
    else
    {
        redirectBack();
    }
}

function edit()
{
    $editableTypes = ['Text'];
    if(!isset($_POST['fileLocation']) || !is_file($_POST['fileLocation'])){
        redirectBack(true);
    }
    $path = $_POST['fileLocation'];
    pageRender('head', ['title'=>'View']);
    if(!isset($_POST['fileType']) || !in_array($_POST['fileType'], $editableTypes))
    {
        echo '<h2>Ooops, looks like we have not added yet feature to edit files with that type 	¯\_(ツ)_/¯</h2>';
    }
    else
    {
        pageRender('navigator/fileEdit', ['path'=>$path, 'content'=>readFileAsText($path), 'type'=>$_POST['fileType']]);
    }

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
    header("Location: view?path={$_POST['fileLocation']}&type={$_POST['fileType']}");
}

