<?php

function rootUrl(){
    $host = $_SERVER['HTTP_HOST'];
    return $host;
}
function Url(){
    $host = $_SERVER['REQUEST_URI'];
    return $host;
}