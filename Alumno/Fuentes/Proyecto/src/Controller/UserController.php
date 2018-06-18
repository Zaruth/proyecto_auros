<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Message;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Controlador de usuario: Maneja todo lo relacionado con el usuario.
 * 
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
     * Index del usuario
     * 
     * @Route("/", name="user_index", methods="GET")
     */
    public function index(UserRepository $userRepository): Response
    {
        if($this->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }
        else{
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
    }

    /**
     * Muestra la info del usuario
     * @Route("/{id}", name="user_show", methods="GET")
     */
    public function show(User $user): Response
    {
        if($this->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }
        else{
            if($this->getUser()->getId() != $user->getId()){
                return $this->show($this->getUser());
            }
            return $this->render('user/show.html.twig', ['user' => $user]);
        }
    }

    /**
     * Edita la información de un usuario
     * @Route("/{id}/edit", name="user_edit", methods="GET|POST")
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder): Response
    {   
        if($this->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }
        else{
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
    }

    /**
     * Muestra el panel de moderación
     * @Route("/modpanel/", name="modpanel", methods="GET")
     */
    public function modpanel(UserRepository $userRepository, MessageRepository $messageRepository)
    {
        if($this->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }
        else{
            $entityManager = $this->getDoctrine()->getManager();
            $users = $entityManager->getRepository(User::class)->findBy(['role' => 'ROLE_USER']);

            $messages = $entityManager->getRepository(Message::class)->findBy(['reported' => true]);
            
            return $this->render('user/mod.html.twig',['users' => $users,'messages' => $messages]);
        }
    }

    /**
     * Silencia un usuario desde el panel de moderación
     * @Route("/modpanel/mute", name="modmuteuser", methods="GET")
     */
    public function modmuteuser(Request $request, UserRepository $userRepository)
    {
        if($this->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }
        else{
            $status = "Silencio actualizado";
            $class = "alert-danger";
            $this->session->getFlashBag()->add("class", $class);
            $this->session->getFlashBag()->add("status", $status);
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->find($request->get('muteselect')[0]);
            $user->setSilenced(\DateTime::createFromFormat("H:i:s d-m-Y",date("H:i:s d-m-Y", strtotime('+'.$request->get('mutetime').' hours'))));
            $entityManager->flush();
            return $this->redirectToRoute('modpanel');
        }
    }

    /**
     * Quita el silencio a un usario desde el panel de moderación
     * @Route("/modpanel/unmute", name="modunmuteuser", methods="GET")
     */
    public function modunmuteuser(Request $request, UserRepository $userRepository)
    {
        if($this->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }
        else{
            $status = "Silencio eliminado";
            $class = "alert-warning";
            $this->session->getFlashBag()->add("class", $class);
            $this->session->getFlashBag()->add("status", $status);
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->find($request->get('id')[0]);
            $user->setSilenced(null);
            $entityManager->flush();
            return $this->redirectToRoute('modpanel');
        }
    }

    /**
     * Quita el reporte de un mensaje desde el panel de moderación
     * @Route("/modpanel/removereport", name="modremovereport", methods="GET")
     */
    public function modremovereport(Request $request, UserRepository $userRepository, MessageRepository $messageRepository)
    {
        if($this->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }
        else{
            $status = "Reporte eliminado";
            $class = "alert-warning";
            $this->session->getFlashBag()->add("class", $class);
            $this->session->getFlashBag()->add("status", $status);
            $entityManager = $this->getDoctrine()->getManager();
            $message = $entityManager->getRepository(Message::class)->find($request->get('id'));
            $message->setReported(false);
            $entityManager->flush();
            return $this->redirectToRoute('modpanel');
        }
    }

    /**
     * Muestra el panel de administración
     * @Route("/adminpanel/", name="adminpanel", methods="GET")
     */
    public function adminpanel(UserRepository $userRepository, MessageRepository $messageRepository)
    {
        if($this->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }
        else{
            $entityManager = $this->getDoctrine()->getManager();
            $users = $entityManager->getRepository(User::class)->findBy(['role' => 'ROLE_USER']);

            $moders = $entityManager->getRepository(User::class)->findBy(['role' => 'ROLE_MOD']);

            $messages = $entityManager->getRepository(Message::class)->findBy(['reported' => true]);
            
            return $this->render('user/admin.html.twig',['users' => $users, 'moders' => $moders,'messages' => $messages]);
        }
    }

    /**
     * Banea un usuario desde el panel de administracion
     * @Route("/adminpanel/ban", name="banuser", methods="GET")
     */
    public function banuser(Request $request, UserRepository $userRepository)
    {
        if($this->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }
        else{
            $status = "Baneo actualizado";
            $class = "alert-danger";
            $this->session->getFlashBag()->add("class", $class);
            $this->session->getFlashBag()->add("status", $status);
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->find($request->get('banselect')[0]);
            $user->setBanned(\DateTime::createFromFormat("H:i:s d-m-Y",date("H:i:s d-m-Y", strtotime('+'.$request->get('bantime').' hours'))));
            $entityManager->flush();
            return $this->redirectToRoute('adminpanel');
        }
    }

    /**
     * Quita el baneo a un usuario desde el panel de administracion
     * @Route("/adminpanel/unban", name="unbanuser", methods="GET")
     */
    public function unbanuser(Request $request, UserRepository $userRepository)
    {
        if($this->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }
        else{
            $status = "Silencio eliminado";
            $class = "alert-warning";
            $this->session->getFlashBag()->add("class", $class);
            $this->session->getFlashBag()->add("status", $status);
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->find($request->get('id')[0]);
            $user->setBanned(null);
            $entityManager->flush();
            return $this->redirectToRoute('adminpanel');
        }
    }

    /**
     * Silencia a un usuario desde el panel de administracion
     * @Route("/adminpanel/mute", name="muteuser", methods="GET")
     */
    public function muteuser(Request $request, UserRepository $userRepository)
    {
        if($this->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }
        else{
            $status = "Silencio actualizado";
            $class = "alert-danger";
            $this->session->getFlashBag()->add("class", $class);
            $this->session->getFlashBag()->add("status", $status);
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->find($request->get('muteselect')[0]);
            $user->setSilenced(\DateTime::createFromFormat("H:i:s d-m-Y",date("H:i:s d-m-Y", strtotime('+'.$request->get('mutetime').' hours'))));
            $entityManager->flush();
            return $this->redirectToRoute('adminpanel');
        }
    }

    /**
     * Quita el silencio a un usuario desde el panel de administracion
     * @Route("/adminpanel/unmute", name="unmuteuser", methods="GET")
     */
    public function unmuteuser(Request $request, UserRepository $userRepository)
    {
        if($this->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }
        else{
            $status = "Silencio eliminado";
            $class = "alert-warning";
            $this->session->getFlashBag()->add("class", $class);
            $this->session->getFlashBag()->add("status", $status);
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->find($request->get('id')[0]);
            $user->setSilenced(null);
            $entityManager->flush();
            return $this->redirectToRoute('adminpanel');
        }
    }

    /**
     * Quita el reporte de un mensaje desde el panel de administracion
     * @Route("/adminpanel/removereport", name="adminremovereport", methods="GET")
     */
    public function adminremovereport(Request $request, UserRepository $userRepository, MessageRepository $messageRepository)
    {
        if($this->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }
        else{
            $status = "Reporte eliminado";
            $class = "alert-warning";
            $this->session->getFlashBag()->add("class", $class);
            $this->session->getFlashBag()->add("status", $status);
            $entityManager = $this->getDoctrine()->getManager();
            $message = $entityManager->getRepository(Message::class)->find($request->get('id'));
            $message->setReported(false);
            $entityManager->flush();
            return $this->redirectToRoute('adminpanel');
        }
    }

    /**
     * Hace a un usuario moderador desde el panel de administracion
     * @Route("/adminpanel/mod", name="moduser", methods="GET")
     */
    public function moduser(Request $request, UserRepository $userRepository)
    {
        if($this->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }
        else{
            $status = "Moderador Creado";
            $class = "alert-success";
            $this->session->getFlashBag()->add("class", $class);
            $this->session->getFlashBag()->add("status", $status);
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->find($request->get('modselect')[0]);
            $user->setRole('ROLE_MOD');
            $entityManager->flush();
            return $this->redirectToRoute('adminpanel');
        }
    }

    /**
     * Quita la moderacion a un usuario desde el panel de administracion
     * @Route("/adminpanel/unmod", name="unmoduser", methods="GET")
     */
    public function unmoduser(Request $request, UserRepository $userRepository)
    {
        if($this->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }
        else{
            $status = "Moderador Eliminado";
            $class = "alert-warning";
            $this->session->getFlashBag()->add("class", $class);
            $this->session->getFlashBag()->add("status", $status);
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->find($request->get('id')[0]);
            $user->setRole('ROLE_USER');
            $entityManager->flush();
            return $this->redirectToRoute('adminpanel');
        }
    }

    /**
     * Checkea si un usuario está baneado
     */
    public function check_ban(User $user)
    {
        $isBanned = $user->getBanned();
        if ($isBanned != null){
            if(date("H:i:s d-m-Y") > $isBanned){
                $user->setBanned(null);
                return false;
            }
            else{
                $status = "Estas baneado hasta ".$isBanned->format('H:i:s d-m-Y');
                $class = "alert-danger";
                $this->session->getFlashBag()->add("class", $class);
                $this->session->getFlashBag()->add("status", $status);
                setcookie('banned', $status, time() + (86400 * 120), "/"); // 86400 = 1 day // 120 days
                return true;
            }
        }
        else{
            return false;
        }
    }
}
