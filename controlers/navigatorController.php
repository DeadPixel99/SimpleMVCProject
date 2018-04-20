<?php


require_once getFromConfig('models').'navigatorModel.php';

/**
 * @purpose renders list of files depends on GET request
 */
function main()
{
    $link = $_GET['path'] ?? __DIR__;
    $files = getParsedFilesList(getFilesList($link));
    pageRender('head', ['title'=>'Files explorer']);
    pageRender('navigator/filesList', ['li'=>$files]);
}

/**
 * @param $filesArray
 * @return array
 * @purpose parses $filesArray to make it compatible with navigator View
 */
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

/**
 * @purpose depending on users POST request deletes dir or creates new one
 */
function makeOrRemoveDir()
{
    if(isset($_POST['futurePath']) && isset($_POST['dirName']) && isset($_POST['buttn'])){
        if($_POST['buttn'] == 'Create dir' && !empty($_POST['dirName'])) {
            createDir($_POST['futurePath'], $_POST['dirName']);
        }
        if($_POST['buttn'] == 'Remove dir' && !empty($_POST['dirName'])) {
            removeDir("{$_POST['futurePath']}/{$_POST['dirName']}");
        }
    }
    redirectback();

}

/**
 * @purpose loads file from form in specified by POST request path
 */
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


