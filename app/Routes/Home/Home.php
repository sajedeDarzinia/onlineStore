<?php
use App\Controllers\SiteController;

$app->router->get('/contact' , [SiteController::class , 'contact']);

$app->router->post('/contact' , [SiteController::class , 'handleContact']);

