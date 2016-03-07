<?php

function isPost()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function drawMenu($menu)
{
    echo "<ul class='nav navbar-nav'>";
    foreach ($menu as $m) {
        echo "<li>";
        echo "<a href='{$m['href']}'>{$m['title']} </a>";
        echo "</li>";
    }
    echo "</ul>";
}

function isCookie($key)
{
    return isset($_COOKIE[$key]);
}

function getData($key, $default = null)
{
    return (isset($_REQUEST[$key])) ? $_REQUEST[$key] : $default;
}