<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class SecurityController extends Controller
{
    private $session;
    
    /**
    * Constructor de la variable de Sesión
    */
    public function __construct() {
        $this->session = new Session();
    }

    /**
     * @Route("/juego/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {   
        $this->check_ban();

        // get the login error if there is one
        $m_error = $authenticationUtils->getLastAuthenticationError();
        
        if(isset($m_error)){
            $status = "¡Usuario o contraseña inválidos!";
            $class = "alert-danger";
            $this->session->getFlashBag()->add("class", $class);
            $this->session->getFlashBag()->add("status", $status);
        }

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
        ));
    }

    public function check_ban()
    {
        foreach($_COOKIE as $element){
            if(strpos($element, 'baneado') !== false){
                $class = "alert-danger";
                $this->session->getFlashBag()->add("class", $class);
                $this->session->getFlashBag()->add("status", $_COOKIE['banned']);
                setcookie('banned', null, -1, "/");
            }
        }
    }
}
