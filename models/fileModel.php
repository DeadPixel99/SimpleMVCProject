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
    return nl2br(htmlspecialchars($output));
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