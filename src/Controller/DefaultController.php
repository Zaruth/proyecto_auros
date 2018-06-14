<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    private $session;
    
    /**
    * Constructor de la variable de Sesión
    */
    public function __construct() {
        $this->session = new Session();
    }

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        if(!$this->getUser()){
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_ANONYMOUSLY');
            return $this->redirectToRoute('inicio');
        }
        else{
            return $this->redirectToRoute('character_index');
        }
    }

    /**
     * @Route("/juego/inicio", name="inicio")
     */
    public function inicio()
    {
        if(!$this->getUser()){
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_ANONYMOUSLY');
            return $this->render('default/index.html.twig', [
                'controller_name' => 'DefaultController',
            ]);
        }
        else{
            return $this->redirectToRoute('character_index');
        }
    }
}
