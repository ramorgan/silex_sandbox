<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get(
    '/',
    function () use ($app) {
        return $app['twig']->render('index.html.twig', array());
    }
)
    ->bind('homepage');

$app->error(
    function (\Exception $e, Request $request, $code) use ($app) {
        if ($app['debug']) {
            return;
        }

        // 404.html, or 40x.html, or 4xx.html, or error.html
        $templates = array(
            'errors/'.$code.'.html.twig',
            'errors/'.substr($code, 0, 2).'x.html.twig',
            'errors/'.substr($code, 0, 1).'xx.html.twig',
            'errors/default.html.twig',
        );

        return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
    }
);

// define controllers for a blog
$blog = $app['controllers_factory'];
$blog->get(
    '/',
    function () use ($app) {
        return $app['twig']->render(
            'page.html.twig',
            ['title' => 'blog home page', 'message' => 'welcome to the blog homepage']
        );
    }
);
// ...

// define controllers for a forum
$forum = $app['controllers_factory'];
$forum->get(
    '/',
    function () use ($app) {
        return $app['twig']->render(
            'page.html.twig',
            ['title' => 'form home page', 'message' => 'welcome to the form homepage']
        );
    }
);

$app->mount('/blog', $blog);
$app->mount('/forum', $forum);
