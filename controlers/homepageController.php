<?php

/**
 * @purpose renders link to existing controllers
 */
function main()
{
    pageRender('head', ['title'=>'homepage']);
    pageRender('home', []);
}

