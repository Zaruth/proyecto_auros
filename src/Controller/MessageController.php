<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Route("/juego/message")
 */
class MessageController extends Controller
{
    private $session;
    
    /**
    * Constructor de la variable de Sesión
    */
    public function __construct() {
        $this->session = new Session();
    }

    /**
     * @Route("/", name="message_index", methods="GET")
     */
    public function index(MessageRepository $messageRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $messages = $entityManager->getRepository(Message::class)->findBy(['characterto' => $this->getUser()->getUCharacter()],['date' => 'DESC']);
        return $this->render('message/index.html.twig', ['messages' => $messages]);
    }

    /**
     * @Route("/new/{id}", name="message_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {   
        $user = new User();
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($request->get('id'));

        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setCharacterfrom($this->getUser()->getUCharacter());
            $message->setCharacterto($user->getUCharacter());
            $message->setDate(\DateTime::createFromFormat("H:i:s d-m-Y",date("H:i:s d-m-Y")));
            $message->setReported(false);

            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('message_index');
        }

        return $this->render('message/new.html.twig', [
            'message' => $message,
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="message_show", methods="GET")
     */
    public function show(Message $message): Response
    {
        return $this->render('message/show.html.twig', ['message' => $message]);
    }

    /**
     * @Route("/{id}", name="message_delete", methods="DELETE")
     */
    public function delete(Request $request, Message $message): Response
    {
        if ($this->isCsrfTokenValid('delete'.$message->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($message);
            $em->flush();
        }

        return $this->redirectToRoute('message_index');
    }

    /**
     * @Route("/report/{id}", name="message_report")
     */
    public function report(Request $request, Message $message): Response
    {
        $message->setReported(true);
        $this->getDoctrine()->getManager()->flush();
    
        return $this->redirectToRoute('message_index');
    }
}
