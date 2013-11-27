RssUpdaterBundle
========================

This is Symfony2 bundle with the service RssUpdateService, that gets 
RSS feed from remote url and updates the database records.

Installing notes
----------------------------------

1. Download this project from github.com
2. install vendors
composer install
This project depends on the following projects, that are not available 
from composer. You must download the zip of the master's branch
of SonataGoutteBundle
 http://knpbundles.com/sonata-project/SonataGoutteBundle
to the folder vendor/Sonnata/SonataGoutteBundle
and the project
https://github.com/fabpot/Goutte
to the folder vendor/Goutte/

Register the bundle in app/AppKernel.php::
<?php

// app/AppKernel.php
public function registerBundles()
{
    return array(
        // ...
        new Sonata\GoutteBundle\SonataGoutteBundle(),
        // ...
    );
}

Register namespaces in app/autoload.php::
<?php
$loader->registerNamespaces(array(
    // ...
    'Goutte'           => __DIR__.'/../vendor/goutte/src',
    'Sonata'           => __DIR__.'/../vendor/Sonnata/SonataGoutteBundle/',
));

Configuration

edit app/autoload.php and AppKernel.php to add the appropriate lines for the Sonata namespace.
edit your config.yml and add these lines
sonata_goutte:
    class: Sonata\GoutteBundle\Manager
    clients:
        default:
            config:
                adapter: Zend\Http\Client\Adapter\Socket

        curl:
            config:
                maxredirects: 0
                timeout: 30
                useragent: Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.6; en-US) Gecko/20100401 Firefox/3.6.3
                adapter: Sonata\GoutteBundle\Adapter\Curl
                verbose_log: %kernel.logs_dir%/curl.log
                verbose: true

3. Create database structure
run the commands:
app/console doctrine:database:create
app/console doctrine:schema:create


4. configure a service
You should edit 

Browsing the Demo Application
--------------------------------

This bundle have a route to /hello/
It updates the rss feed. See implementation of the index action in the default controller.
The route /list/
shows the list of the uploaded newsfeeds.

