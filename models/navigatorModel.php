<?php

/**
 * @param $path
 * @return array
 * @purpose scans dir $path and returns array with information about all content in it
 */
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
                'type' => $type,
                'location'=>$path
            ];
        }
    }
    return $filesList;
}

/**
 * @param $path
 * @param $name
 * @purpose $creates new dir {$path}/{$name}
 */
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

/**
 * @param $path
 * @purpose recursive remove of $path dir and all contend in it
 */
function removeDir($path)
{
    if(is_dir($path))
    {
        $files = array_diff(scandir($path), ['.','..']);
        foreach ($files as $filename)
        {
            $element = "{$path}/{$filename}";
            if(!is_dir($element)) {
                unlink($element);
            } else {
                removeDir($element);
            }
        }
        rmdir($path);
    }
}

/**
 * @param $path
 * @return string
 * @purpose gets type of file
 */
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

/**
 * @param $type
 * @return string
 * @purpose gets icon for navigator View depends on filetype $type
 */
function getIconForFile($type)
{
    switch ($type){
        case 'Dir': return '<i class="fa fa-folder-o"></i>';
        case 'Text': return '<i class="fa fa-file-text-o"></i>';
        case  'Img': return '<i class="fa fa-file-image-o"></i>';
        default: return '<i class="fa fa-window-close-o"></i>';
    }
}

/**
 * @param string $name
 * @return array
 * @purpose returns all uploaded files as user-friendly array
 */
function getUploadedFiles(string $name): array
{
    if (is_string($_FILES[$name]['name'])) {
        return [$_FILES[$name]];
    }
    $files = [];
    $count = count($_FILES[$name]['name']);
    $keys = array_keys($_FILES[$name]);
    for ($i = 0; $i < $count; $i++) {
        foreach ($keys as $key) {
            $files[$i][$key] = $_FILES[$name][$key][$i];
        }
    }
    return $files;
}