<?php

namespace Sandbox\Controller;


class BlogController
{
    function index(){
        return $app['twig']->render(
            'page.html.twig',
            ['title' => 'blog home page', 'message' => 'welcome to the blog homepage']
        );
    }
}
