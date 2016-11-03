<?php  //test
function __autoload($name){
    require "classes/{$name}.php";
}