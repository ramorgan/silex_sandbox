<?php

namespace Sandbox;

use Silex\Application as SilexApplication;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class Application extends SilexApplication
{
    public function __construct()
    {
        parent::__construct();

        $this->registerServices($this);
        $this->registerProviders($this);
        $this->registerRoutes($this);
        $this->createRoutes($this);
        $this->registerErrorListeners($this);
        $this->registerBeforeListeners($this);
        $this->registerViewListeners($this);
        $this->registerAfterListeners($this);
    }

    private function createRoutes(Application $app)
    {

    }

    protected function registerServices(Application $app)
    {
    }

    protected function registerProviders(Application $app)
    {

    }

    protected function registerRoutes(Application $app)
    {

    }

    protected function registerErrorListeners(Application $app)
    {
    }

    protected function registerBeforeListeners(Application $app)
    {

    }

    protected function registerViewListeners(Application $app)
    {

    }

    protected function registerAfterListeners(Application $app)
    {

    }
}
