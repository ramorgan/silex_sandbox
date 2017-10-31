<?php

Namespace rm;

use Silex\Application as SilexApplication;
use Silex\Provider\DoctrineServiceProvider;
use Igorw\Silex\ConfigServiceProvider;


class rmApp extends SilexApplication
{
    public function __construct()
    {
        parent::__construct();

        $this->registerServices($this);
        $this->registerProviders($this);
        $this->createRoutes($this);
    }

    protected function registerServices(rmApp $app)
    {

    }

    protected function registerProviders(rmApp $app)
    {

        // Load the installation-specific configuration file. This should never be in Git.
        $app->register(new ConfigServiceProvider(__DIR__."/../../config/settings.json"));

        // Load environment-specific configuration.
        $app->register(new ConfigServiceProvider(__DIR__."/../../config/{$app['environment']}.json"));

        $app->register(
            new DoctrineServiceProvider(),
            [
                'db.options' => [
                    'driver'   => 'pdo_mysql',
                    'dbname'   => $app['database']['dbname'],
                    'host'     => $app['database']['host'],
                    'user'     => $app['database']['user'],
                    'password' => $app['database']['password'],
                ],
            ]
        );
    }

    protected function createRoutes(rmApp $app)
    {

        $app->get(
            '/',
            function () {
                return 'base';
            }
        )->bind('home');
        $app->get(
            'db',
            function () use ($app) {
                var_dump($app['database']);

                return 'nbsp';
            }
        );

        $app->get('/reinstall', function () use ($app) {
            /** @var \Doctrine\DBAL\Connection $conn */
            $conn = $app['db'];

            /** @var \Doctrine\DBAL\Schema\AbstractSchemaManager $sm */
            $sm = $conn->getSchemaManager();

            $schema = new \Doctrine\DBAL\Schema\Schema();

            $table = $schema->createTable('users');
            $table->addColumn("id", "integer", ["unsigned" => true]);
            $table->addColumn("username", "string", ["length" => 32]);
            $table->addColumn("age", "integer", ["unsigned" => true]);
            $table->setPrimaryKey(["id"]);
            $table->addUniqueIndex(["username"]);
            $schema->createSequence("users_seq");
            $sm->dropAndCreateTable($table);

            $table = $schema->createTable('messages');
            $table->addColumn("id", "integer", ["unsigned" => true]);
            $table->addColumn("author", "string", ["length" => 32]);
            $table->addColumn("parent", "integer", ["unsigned" => true]);
            $table->addColumn("message", "string", ["length" => 256]);
            $table->setPrimaryKey(["id"]);
            $sm->dropAndCreateTable($table);

            return 'DB installed';
        });
    }
}
