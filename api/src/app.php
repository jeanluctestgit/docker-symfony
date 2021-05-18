<?php

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', [
    'year' => null,
    '_controller' => 'Calendar\Controller\LeapYearController::index',
], [], [], '', [], ['GET']));

$routes->add('get_articles', new Routing\Route('/articles', [
    '_controller' => 'Itech\Controller\ArticleController::index',
], [], [], '', [], ['GET']));

$routes->add('add_article', new Routing\Route('/articles', [
    '_controller' => 'Itech\Controller\ArticleController::add',
], [], [], '', [], ['POST']));

$routes->add('show_tarticle', new Routing\Route('/articles/{id}', [
    '_controller' => 'Itech\Controller\ArticleController::show',
], [], [], '', [], ['GET']));

$routes->add('delete_article', new Routing\Route('/articles/{id}', [
    '_controller' => 'Itech\Controller\ArticleController::delete',
], [], [], '', [], ['DELETE']));

$routes->add('update_article', new Routing\Route('/articles/{id}', [
    '_controller' => 'Itech\Controller\ArticleController::update',
], [], [], '', [], ['PUT']));

return $routes;
