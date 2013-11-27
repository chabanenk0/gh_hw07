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

