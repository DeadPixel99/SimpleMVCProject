<?php

/**
 * @param $file
 * @return string
 * @purpose reads $file and returns it as html-ready text
 */
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

/**
 * @param $filename
 * @param $content
 * @purpose rewrites $filename file with $content
 */
function updateTextFile($filename, $content)
{
    if(is_file($filename))
    {
        $file = fopen($filename, 'w');
        fwrite($file, $content);
        fclose($file);
    }
}

/**
 * @param $filename
 * @return string
 * @purpose reads $filename and returns it as html-ready image
 */
function readFileAsImg($filename)
{
    if(is_file($filename))
    {
        $bufferDir  = str_replace(realpath(__DIR__.'/..'), '..', $filename);
        return "<img src='{$bufferDir}' alt='Permission denied'>";
    }
    return '<p>No image content :(</p>';
}

