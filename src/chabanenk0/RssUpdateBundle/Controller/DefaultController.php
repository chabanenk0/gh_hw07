<?php

namespace chabanenk0\RssUpdateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
//use Goutte\Client;
//use Symfony\Component\DomCrawler\Crawler;
//use chabanenk0\RssUpdaterBundle\Entity\Paper;


class DefaultController extends Controller
{
    /**
     * @Route("/hello/")
     * @Template()
     */
    public function indexAction()
    {
        /*
        //$client = $this->get('goutte')
        //    ->getNamedClient('curl');
        $client = new Client();
        //$crawler = $client->request('GET', 'http://export.arxiv.org/rss/physics');
        $crawler = $client->request('GET', 'http://localhost/rss/physics.xml');
        $response = $client->getResponse();
        $content = $response->getContent();

        $em=$this->getDoctrine()->getManager();
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
        $em->flush(); */
        $rss = $this->get('chabanenk0_rss_update.example')->updateRss();
        $content="ok";
        $name="noname";
        return $this->render('chabanenk0RssUpdateBundle:Default:index.html.twig', array('name' => $name,'content'=>$content));
    }

    /**
     * @Route("/list/")
     * @Template()
     */
    public function listAction()
    {
        $papers = $this->getDoctrine()->getRepository('chabanenk0RssUpdateBundle:Paper')->findAll();
        if (!$papers) {
            throw $this->createNotFoundException(
                "No papers found!"
            );
        }
        return $this->render('chabanenk0RssUpdateBundle:Default:papers.html.twig', array('papers' => $papers));
    }
}
    
