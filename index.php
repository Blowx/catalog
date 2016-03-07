<?php
error_reporting(E_ALL);
require_once "inc/functions.php";
require_once 'inc/data.php';
include 'inc/seo.php';
require 'autoload.php';

$product = new Product();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <?php drawMenu($menu); ?>
        </div>
    </div>
</nav>

<div class="container">
    <div class="starter-template">
        <p class="lead">
            <?php require_once 'inc/route.php'; ?>
        </p>
    </div>
    <hr>
</div>