<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Parser;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $yaml = new Parser();
        $value = $yaml->parse(file_get_contents($this->get('kernel')
                ->getRootDir().'/../src/AppBundle/Resources/config/menu.yml'));

        return $this->render('RichardPQAdminBundle::base.html.twig', ['menus' => $value]);
    }

    /**
     * @Route("/menu", name="menu")
     */
    public function menuAction()
    {
        $yaml = new Parser();
        $value = $yaml->parse(file_get_contents($this->get('kernel')
                ->getRootDir().'/../src/AppBundle/Resources/config/menu.yml'));

        return $this->render('RichardPQAdminBundle:widgets:main-sidebar-left.html.twig', ['menus' => $value]);
    }
}
