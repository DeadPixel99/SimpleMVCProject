<?php

function readFileAsText($file)
{
    $output = '';
    if(is_file($file)){
        $buffer = fopen($file, 'r');
        while ($line = fread($buffer, 32))
        {
            $output.=$line;
        }
        fclose($buffer);
    }
    return htmlspecialchars($output);
}

function updateTextFile($filename, $content)
{
    if(is_file($filename))
    {
        $file = fopen($filename, 'w');
        fwrite($file, $content);
        fclose($file);
    }
}

function readFileAsImg($filename)
{
    if(is_file($filename))
    {
        $bufferDir  = str_replace(realpath(__DIR__.'/..'), '..', $filename);
        return "<img src='{$bufferDir}' alt='Permission denied'>";
    }
    return '<p>No image content :(</p>';
}

