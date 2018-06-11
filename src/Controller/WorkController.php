<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Character;
use App\Entity\Message;
use App\Repository\UserRepository;
use App\Repository\CharacterRepository;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class WorkController extends Controller
{
    private $session;
    
    /**
    * Constructor de la variable de Sesión
    */
    public function __construct() {
        $this->session = new Session();
    }

    /**
     * @Route("/juego/work", name="work")
     */
    public function index()
    {
        return $this->render('work/index.html.twig', [
            'controller_name' => 'WorkController',
        ]);
    }

    /**
     * @Route("/juego/work/start", name="start_work", methods="GET|POST")
     */
    public function start_work(Request $request): Response
    { 
        $this->getUser()->getUCharacter()->setWorkStart(\DateTime::createFromFormat("H:i:s d-m-Y",date("H:i:s d-m-Y")));
        switch($request->get('selection')){
            case '1':
                $this->getUser()->getUCharacter()->setWorkFinish(\DateTime::createFromFormat("H:i:s d-m-Y",date("H:i:s d-m-Y", strtotime('+10 seconds'))));
                break;
            case '2':
                $this->getUser()->getUCharacter()->setWorkFinish(\DateTime::createFromFormat("H:i:s d-m-Y",date("H:i:s d-m-Y", strtotime('+1 hours'))));
                break;
            case '3':
                $this->getUser()->getUCharacter()->setWorkFinish(\DateTime::createFromFormat("H:i:s d-m-Y",date("H:i:s d-m-Y", strtotime('+2 hours'))));
                break;
            case '4':
                $this->getUser()->getUCharacter()->setWorkFinish(\DateTime::createFromFormat("H:i:s d-m-Y",date("H:i:s d-m-Y", strtotime('+3 hours'))));
                break;
            case '5':
                $this->getUser()->getUCharacter()->setWorkFinish(\DateTime::createFromFormat("H:i:s d-m-Y",date("H:i:s d-m-Y", strtotime('+4 hours'))));
                break;
        }
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('work');
    }

    /**
     * @Route("/juego/work/finish", name="finish_work", methods="GET|POST")
     */
    public function finish_work(Request $request): Response
    {
        $ahora = \DateTime::createFromFormat("H:i:s d-m-Y",date("H:i:s d-m-Y"));
        $inicio = $this->getUser()->getUCharacter()->getWorkStart();
        $fin = $this->getUser()->getUCharacter()->getWorkFinish();
        $diferencia = date_timestamp_get($fin) - date_timestamp_get($ahora);
        if($diferencia <= 0){
            $status = "Has terminado de trabajar, ve a mensajería para ver la recompensa obtenida.";
            $class = "alert-dismissible alert-info";
            $this->session->getFlashBag()->add("class", $class);
            $this->session->getFlashBag()->add("status", $status);

            $diferencia = date_timestamp_get($fin) - date_timestamp_get($inicio);
            $exp = $diferencia/10;

            $hor = floor($diferencia / 3600);
            $min = floor($diferencia / 60);
            $sec = $diferencia % 60;
            $this->getUser()->getUCharacter()->setExp($this->getUser()->getUCharacter()->getExp() + $exp);
            $this->getUser()->getUCharacter()->setGold($this->getUser()->getUCharacter()->getGold() + 100);

            $msg = new Message();
            $msg->setText("Has trabajado durante {$hor} horas {$min} minutos y {$sec} segundos.<br/>Has ganado {$exp} puntos de experiencia y 100 monedas de oro.");
            $msg->setCharacterfrom($this->getUser()->getUCharacter());
            $msg->setCharacterto($this->getUser()->getUCharacter());
            $msg->setDate($ahora);
            $msg->setReported(false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($msg);
            $em->flush();
        }
        $this->getUser()->getUCharacter()->setWorkStart(null);
        $this->getUser()->getUCharacter()->setWorkFinish(null);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('work');
    }
}
