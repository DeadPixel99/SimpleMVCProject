<?php


function getFilesList($path)
{
    $filesList = [];
    if(file_exists($path) && is_dir($path))
    {
        foreach (scandir($path) as $filename)
        {
            $type = getTypeOfFile($path.'/'.$filename);
            $filesList[] = [
                'name' => $filename,
                'path' => realpath($path.'/'.$filename),
                'type' => $type
            ];
        }
    }
    return $filesList;
}

function createDir($path, $name)
{
    $dir = "{$path}/{$name}";
    if (file_exists($dir)) {
        $counter = 1;
        $tmpDir = $dir;
        do {
            $dir = "{$tmpDir}_{$counter}";
            $counter++;
        } while (file_exists($dir));
    }
    mkdir($dir);
}

function getTypeOfFile($path)
{
    if(is_dir($path))
        return 'Dir';
    $mimeType = explode('/', mime_content_type($path))[0];
    switch ($mimeType)
    {
        case 'text': return 'Text';
        case 'image': return 'Img';
        default: return 'Other';
    }
}

function getIconForFile($type)
{
    switch ($type){
        case 'Dir': return '<i class="fa fa-file"></i>';
        case 'Text': return '<i class="fa fa-file-text-o"></i>';
        case  'Img': return '<i class="fa fa-file-image-o"></i>';
        default: return '';
    }
}