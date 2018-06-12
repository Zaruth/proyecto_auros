<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Route("/juego/user")
 */
class UserController extends Controller
{
    private $session;
    
    /**
    * Constructor de la variable de Sesión
    */
    public function __construct() {
        $this->session = new Session();
    }

    /**
     * @Route("/", name="user_index", methods="GET")
     */
    public function index(UserRepository $userRepository): Response
    {
        $this->check_ban();

        $status = "Bienvenido ".$this->getUser()->getUsername();
        $class = "alert-dismissible alert-info";
        $this->session->getFlashBag()->add("class", $class);
        $this->session->getFlashBag()->add("status", $status);

        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($this->getUser()->getId());
        $user->setIpLogin("192.168.4.26");
        $user->setLastLogin(\DateTime::createFromFormat("H:i:s d-m-Y",date("H:i:s d-m-Y")));
        $entityManager->flush();

        return $this->redirectToRoute('user_show',array('id'=>$user->getId()));
    }

    /**
     * @Route("/{id}", name="user_show", methods="GET")
     */
    public function show(User $user): Response
    {
        if($this->getUser()->getId() != $user->getId()){
            return $this->show($this->getUser());
        }
        return $this->render('user/show.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods="GET|POST")
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder): Response
    {   
        $this->check_ban();

        if($this->getUser()->getId() != $user->getId()){
            return $this->show($this->getUser());
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $this->getDoctrine()->getManager()->flush();
            
            $status = "Datos de usuario modificados con éxito.";
            $class = "alert-success";
            $this->session->getFlashBag()->add("class", $class);
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    public function check_ban()
    {
        $isBanned = $this->getUser()->getBanned();
        if ($isBanned != null){
            if(date("H:i:s d-m-Y") > $isBanned){
                $this->getUser()->setBanned(null);
                return false;
            }
            else{
                $status = "Estas baneado hasta ".$isBanned->format('H:i:s d-m-Y');
                $class = "alert-danger";
                $this->session->getFlashBag()->add("class", $class);
                $this->session->getFlashBag()->add("status", $status);
                setcookie('banned', $status, time() + (86400 * 120), "/"); // 86400 = 1 day // 120 days
                return $this->redirectToRoute('logout');
            }
        }
    }
}
