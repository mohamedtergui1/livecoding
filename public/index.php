<?php 
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];




    require '../vendor/autoload.php';
    require '../core/Router.php';
    new Router();