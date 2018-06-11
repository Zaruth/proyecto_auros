<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Thread;
use App\Form\ThreadType;
use App\Repository\PostRepository;
use App\Repository\ThreadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/juego/forum")
 */
class ThreadController extends Controller
{
    /**
     * @Route("/", name="thread_index", methods="GET")
     */
    public function index(ThreadRepository $threadRepository): Response
    {
        return $this->render('thread/index.html.twig', ['threads' => $threadRepository->findBy([],['date' => 'DESC'])]);
    }

    /**
     * @Route("/c/{category}", name="thread_category", methods="GET")
     */
    public function category(Request $request, ThreadRepository $threadRepository): Response
    {
        return $this->render('thread/index.html.twig', ['threads' => $threadRepository->findBy(['category' => $request->get('category')],['date' => 'DESC'])]);
    }

    /**
     * @Route("/new", name="thread_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
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

    /**
     * @Route("/{id}/new", name="post_new", methods="GET|POST")
     */
    public function new_post(Thread $thread, Request $request): Response
    {
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

    /**
     * @Route("/{id}", name="thread_show", methods="GET")
     */
    public function show(Thread $thread): Response
    {
        return $this->render('thread/show.html.twig', ['thread' => $thread]);
    }

    /**
     * @Route("/{id}/edit", name="thread_edit", methods="GET|POST")
     */
    public function edit(Request $request, Thread $thread): Response
    {
        $form = $this->createForm(ThreadType::class, $thread);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('thread_edit', ['id' => $thread->getId()]);
        }

        return $this->render('thread/edit.html.twig', [
            'thread' => $thread,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="thread_delete", methods="GET")
     */
    public function delete(Request $request): Response
    {
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
