<?php

namespace ClasseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ClasseBundle:Default:index.html.twig');
    }
}
