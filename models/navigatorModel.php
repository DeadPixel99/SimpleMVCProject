<?php



function getFilesList($path)
{
    $filesList = [];
    if(file_exists($path) && is_dir($path))
    {
        foreach (scandir($path) as $filename)
        {
            $type = (is_dir($path.$filename.'/'))? 'dir' : 'file';
            $filesList[] = [
                'name' => $filename,
                'path' => realpath($path.'/'.$filename),
                'type' => $type
            ];
        }
    }
    return $filesList;
}

function readFileAsText($file)
{
    $output = '';
    if(is_file($file)){
        $buffer = fopen($file, 'r');
        while ($line = fread($buffer, 32))
        {
            $output.=$line;
        }
    }
    return $output;
}