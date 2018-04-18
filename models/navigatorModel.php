<?php


function getFilesList($path)
{
    $filesList = [];
    if(file_exists($path) && is_dir($path))
    {
        foreach (scandir($path) as $filename)
        {
            $type = (is_dir($path.'/'.$filename))? 'dir' : 'file';
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

