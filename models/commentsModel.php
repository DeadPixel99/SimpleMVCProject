<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 14.04.2018
 * Time: 16:03
 */


function addComment(string $comment)
{
    $file = fopen(getFromConfig('files').'comments/'.getFileName('comment.txt'), 'w');
    fwrite($file, $comment);
    fclose($file);
}

function filthWordsFilter(string $toFilter):string
{
    $filthFilter = [
        'fuck','asshole','bitch','nigger','crap'
    ];
    foreach ($filthFilter as $word) {
        $toFilter = str_replace($word, '***', strtolower($toFilter));
    }
    return $toFilter;
}

function getFileName(string $prefix): string
{
    do {
        $filename = time().$prefix;
    } while(file_exists(getFromConfig('files').'comments/'.$filename));
    return $filename;
}

function newComment(array $commentArr)
{
    if(!isset($commentArr['sender']) || empty($commentArr['sender']))
        return;
    if(!isset($commentArr['message']) || empty($commentArr['message']))
        return;
    $commentArr['message'] = filthWordsFilter($commentArr['message']);
    addComment(serialize($commentArr));
}

function getAllComments():array
{
    $path = getFromConfig('files').'comments/';
    $files = array_diff(scandir($path), ['.','..','.gitignore']);
    foreach ($files as $file){
        $comments[] = array_merge(unserialize(file_get_contents($path.$file)), ['file'=>$file]);
    }
    return $comments ?? [];
}

function commentUnlink($filename)
{
    $file = getFromConfig('files')."comments/{$filename}";
    if(file_exists($file)) {
        unlink($file);
    }
}