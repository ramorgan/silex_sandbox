<?php
require_once __DIR__.'/../vendor/autoload.php';

$app          = new Silex\Application();
$app['debug'] = true;

$app->get(
    '/',
    function () use ($app) {
        return 'Home';
    }
)->bind('homepage');

$app->get(
    '/hello',
    function () use ($app) {
        return 'Hello World!.';
    }
);

$app->get(
    '/hello/{name}',
    function ($name) use ($app) {
        return 'Hello '.$app->escape($name);
    }
);


$blogPosts = [
    1 => [
        'date'   => '2011-03-29',
        'author' => 'igorw',
        'title'  => 'Using Silex',
        'body'   => '...',
    ],
    2 => [
        'date'   => '2017-10-24',
        'author' => 'rmorgan',
        'title'  => 'Setting up a Silex sandbox.',
        'body'   => 'I used the Silex <a href="https://silex.symfony.com/doc/2.0/">docs</a> to set up a sandbox for me to lean how to use Silex',
    ],
];

$app->get(
    '/blog',
    function () use ($blogPosts) {
        $output = '';
        foreach ($blogPosts as $id => $post) {
            $output .= "<a href='/blog/$id'> ".$post['title']."</a>";
            $output .= '<br />';
        }

        return $output;
    }
);

$app->get(
    '/blog/{id}',
    function (Silex\Application $app, $id) use ($blogPosts) {
        if ( ! isset($blogPosts[$id])) {
            $app->abort(404, "Post $id does not exist.");
        }

        $post = $blogPosts[$id];

        return "<h1>{$post['title']}</h1>".
               "<p>{$post['body']}</p>";
    }
)->assert('id', '\d+');


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->post(
    '/feedback',
    function (Request $request) {
//        $message = $request->get('message');
        $message = 'this is a test';
        mail('feedback@yoursite.com', '[YourSite] Feedback', $message);

        return new Response('Thank you for your feedback!', 201);
    }
);

//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpFoundation\Request;

//$app->error(
//    function (\Exception $e, Request $request, $code) {
//        return new Response('We are sorry, but something went terribly wrong.');
//    }
//);

$app->run();
