<?php

$app->get(
    '/',
    function () use ($app) {
        return $app['twig']->render('index.html.twig', array());
    }
)
    ->bind('homepage');

$app->mount("/blogs", new \Sandbox\Controller\Provider\Blogs());

