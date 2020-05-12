<?php

namespace KidzyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Kidzy/Default/index.html.twig');
    }
    public function feedAction()
    {
        return $this->render('@Kidzy/feed/feed.html.twig');
    }

    public function pingAction()
    {

    }
}
