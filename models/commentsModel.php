<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 14.04.2018
 * Time: 16:03
 */

/**
 * @param string $comment
 * @purpose saves users comment as .txt file in 'files/comments/' directory if it exists
 */
function addComment(string $comment)
{
    $dir = getFromConfig('files').'comments';
    if(file_exists($dir))
    {
        $file = fopen($dir.'/'.getFileName('comment.txt'), 'w');
        fwrite($file, $comment);
        fclose($file);
    }
}

/**
 * @param string $toFilter
 * @return string
 * @purpose replaces in $toFilter filth words by '***'
 */
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

/**
 * @param string $prefix
 * @return string
 * @purpose generates filename for comment
 */
function getFileName(string $prefix): string
{
    do {
        $filename = time().$prefix;
    } while(file_exists(getFromConfig('files').'comments/'.$filename));
    return $filename;
}

/**
 * @param array $commentArr
 * @purpose checks if $commentArr is legit comment and saves it as file in that case
 */
function newComment(array $commentArr)
{
    if(!isset($commentArr['sender']) || empty($commentArr['sender']))
        return;
    if(!isset($commentArr['message']) || empty($commentArr['message']))
        return;
    $commentArr['message'] = filthWordsFilter($commentArr['message']);
    addComment(serialize($commentArr));
}

/**
 * @return array
 * @purpose returns all comments in folder as array
 */
function getAllComments():array
{
    $path = getFromConfig('files').'comments/';
    $files = array_diff(scandir($path), ['.','..','.gitignore']);
    foreach ($files as $file){
        $comments[] = array_merge(unserialize(file_get_contents($path.$file)), ['file'=>$file]);
    }
    return $comments ?? [];
}

/**
 * @param $filename
 * @purpose removes $filename comment from folder
 */
function commentUnlink($filename)
{
    $file = getFromConfig('files')."comments/{$filename}";
    if(file_exists($file)) {
        unlink($file);
    }
}