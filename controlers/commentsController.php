<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 14.04.2018
 * Time: 16:04
 */
require_once getFromConfig('models').'commentsModel.php';

function main() {
    pageRender('head', ['title'=>'Comments']);
    foreach (getAllComments() as $comment) {
        pageRender('comments', $comment);
    }
    pageRender('addComment');
}

function addnew()
{
   if(isset($_POST['sender']) || !empty($_POST['sender'])
       || isset($_POST['message']) || !empty($_POST['message']))
   {
       newComment(['sender'=>$_POST['sender'], 'message'=>$_POST['message']]);
   }

   header("Location: /comments");
}

function delete() {
if(isset($_POST['file'])) {
    $file = getFromConfig('files').$_POST['file'];
    if(file_exists($file)) {
        unlink($file);
    }
}
header("Location: /comments");
}