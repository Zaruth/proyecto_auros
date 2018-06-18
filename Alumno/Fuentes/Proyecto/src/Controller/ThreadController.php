<?php

namespace App\Controller;

use App\Controller\UserController;
use App\Entity\Post;
use App\Entity\Thread;
use App\Form\ThreadType;
use App\Repository\PostRepository;
use App\Repository\ThreadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Controlador del foro de la aplicación
 * @Route("/juego/forum")
 */
class ThreadController extends Controller
{
    private $session;
    
    /**
    * Constructor de la variable de Sesión
    */
    public function __construct() {
        $this->session = new Session();
    }

    /**
     * Muestra el listado de temas del foro
     * @Route("/", name="thread_index", methods="GET")
     */
    public function index(ThreadRepository $threadRepository, UserController $uc): Response
    {
        if($uc->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }else{
            return $this->render('thread/index.html.twig', ['threads' => $threadRepository->findBy([],['date' => 'DESC'])]);
        }
    }

    /**
     * Muestra el listado de temas del foro en base a una categoría
     * @Route("/c/{category}", name="thread_category", methods="GET")
     */
    public function category(Request $request, ThreadRepository $threadRepository, UserController $uc): Response
    {
        if($uc->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }else{
            return $this->render('thread/index.html.twig', ['threads' => $threadRepository->findBy(['category' => $request->get('category')],['date' => 'DESC'])]);
        }
    }

    /**
     * Crea un nuevo tema en el foro
     * @Route("/new", name="thread_new", methods="GET|POST")
     */
    public function new(Request $request, UserController $uc): Response
    {
        if($uc->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }else{
            $thread = new Thread();
            $form = $this->createForm(ThreadType::class, $thread);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $thread->setDate(\DateTime::createFromFormat("H:i:s d-m-Y",date("H:i:s d-m-Y")));
                $thread->setCthread($this->getUser()->getUCharacter());

                $em = $this->getDoctrine()->getManager();
                $em->persist($thread);
                $em->flush();

                $post = new Post();
                $post->setCpost($this->getUser()->getUCharacter());
                $post->setText($request->get('mensaje'));
                $post->setDate(\DateTime::createFromFormat("H:i:s d-m-Y",date("H:i:s d-m-Y")));
                $post->setThread($thread);

                $em->persist($post);
                $em->flush();

                return $this->redirectToRoute('thread_index');
            }

            return $this->render('thread/new.html.twig', [
                'thread' => $thread,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * Crea un nuevo post en un tema del foro
     * @Route("/{id}/new", name="post_new", methods="GET|POST")
     */
    public function new_post(Thread $thread, Request $request, UserController $uc): Response
    {
        if($uc->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }else{
            $post = new Post();
            $post->setCpost($this->getUser()->getUCharacter());
            $post->setText($request->get('mensaje'));
            $post->setDate(\DateTime::createFromFormat("H:i:s d-m-Y",date("H:i:s d-m-Y")));
            $post->setThread($thread);

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->render('thread/show.html.twig', ['thread' => $thread]);
        }
    }

    /**
     * Muestra un tema del foro
     * @Route("/{id}", name="thread_show", methods="GET")
     */
    public function show(Thread $thread, UserController $uc): Response
    {
        if($uc->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }else{
            return $this->render('thread/show.html.twig', ['thread' => $thread]);
        }
    }

    /**
     * Elimina un tema del foro
     * @Route("/{id}/delete", name="thread_delete", methods="GET")
     */
    public function delete(Request $request, UserController $uc): Response
    {
        if($uc->check_ban($this->getUser())){
            return $this->redirectToRoute('logout');
        }else{
            $em = $this->getDoctrine()->getManager();
            $thread = $em->getRepository(Thread::class)->find($request->get('id'));
            $posts = $thread->getPosts();
            foreach($posts as $post){
                $em->remove($post);
            }
            $em->remove($thread);
            $em->flush();

            return $this->redirectToRoute('thread_index');
        }
    }
}
