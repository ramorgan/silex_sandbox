<?php
Namespace Sandbox\Controller\Provider;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;

class Blogs implements ControllerProviderInterface{
    function connect(Application $app)
    {
        /** @var ControllerCollection $blogs */
        $blogs = $app["controllers_factory"];
        $blogs->get("/", "Sandbox\\Controller\\BlogController::index");

        $blogs->post("/", "Sandbox\\Controller\\BlogController::store");

        $blogs->get("/{id}", "Sandbox\\Controller\\BlogController::show");

        $blogs->get("/edit/{id}", "Sandbox\\Controller\\BlogController::edit");

        $blogs->put("/{id}", "Sandbox\\Controller\\BlogController::update");

        $blogs->delete("/{id}", "Sandbox\\Controller\\BlogController::destroy");

        return $blogs;
    }
}
