<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 27.11.13
 * Time: 8:54
 */

namespace chabanenk0\RssUpdateBundle\Services;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use chabanenk0\RssUpdateBundle\Entity\Paper;


class RssUpdaterService
{
    protected $doctrine;

    protected $crawler;

    protected $url;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
        //$this->crawler = crawler;
        $this->url = 'http://localhost/rss/physics.xml';
    }

    public function updateRss()
    {
        //$client = $this->get('goutte')
        //    ->getNamedClient('curl');
        $client = new Client();
        //$crawler = $client->request('GET', 'http://export.arxiv.org/rss/physics');
        $crawler = $client->request('GET', 'http://localhost/rss/physics.xml');
        $response = $client->getResponse();
        $content = $response->getContent();

        $em=$this->doctrine->getManager();
        foreach ($crawler->children() as $domElement) {
            //print $domElement->nodeName." ";
            if ($domElement->nodeName=='item') {
                //$paper->setAbout()
                $paper=new Paper();
                $about = $domElement->attributes->getNamedItem('rdf:about')->value;
                $paper->setAbout($about);
                $title = $domElement->getElementsByTagName('title')->item(0)->nodeValue;
                $paper->setTitle($title);
                $link = $domElement->getElementsByTagName('link')->item(0)->nodeValue;
                $paper->setLink($link);
                $description = $domElement->getElementsByTagName('description')->item(0)->nodeValue;
                $paper->setDescription($description);
                $author = $domElement->getElementsByTagName('dc:creator')->item(0)->nodeValue;
                $paper->setAuthors($author);
                $em->persist($paper);
                //var_dump($paper);

            }
        }
        $em->flush();

    }

} 