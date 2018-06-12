<?php

namespace App\Controller;

use App\Entity\Character;
use App\Form\CharacterType;
use App\Repository\CharacterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Utils\Utilities;

/**
 * @Route("/juego/character")
 */
class CharacterController extends Controller
{
    private $session;
    
    /**
    * Constructor de la variable de Sesión
    */
    public function __construct() {
        $this->session = new Session();
    }

    /**
     * @Route("/", name="character_index", methods="GET")
     */
    public function index(CharacterRepository $characterRepository): Response
    {   if($this->ifPjNoExists()){
            return $this->redirectToRoute('character_new');
        }else{
            return $this->redirectToRoute('character_show', ['id' => $this->getUser()->getUCharacter()->getId()]);
        }
    }

    /**
     * @Route("/new", name="character_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        if($this->ifPjExists()){
            return $this->redirectToRoute('character_show', ['id' => $this->getUser()->getUCharacter()->getId()]);
        }else{
            $character = new Character();
            $form = $this->createForm(CharacterType::class, $character);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $character->setBirthdate(\DateTime::createFromFormat("H:i:s d-m-Y",date("H:i:s d-m-Y")));
                $character->setExp(0);
                $character->setEnergy(0);
                $character->setSkillpoints(0);
                $character->setGold(0);
                $character->setSilver(0);
                $character->setCopper(0);
                $character->setWorked(0);
                $character->setFights(0);
                $character->setFightsWon(0);
                $character->setBot(false);
                $this->getUser()->setUCharacter($character);

                $em = $this->getDoctrine()->getManager();
                $em->persist($character);
                $em->flush();

                $status = "¡Personaje registrado!";
                $class = "alert-dismissible alert-success";
                $this->session->getFlashBag()->add("class", $class);
                $this->session->getFlashBag()->add("status", $status);

                return $this->redirectToRoute('character_show', ['id' => $character->getId()]);
            }

            return $this->render('character/new.html.twig', [
                'character' => $character,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/{id}", name="character_show", methods="GET")
     */
    public function show(Character $character, Utilities $utilities): Response
    {   
        if($this->ifPjNoExists()){
            return $this->redirectToRoute('character_new');
        }else{
            $exp = $this->getUser()->getUCharacter()->getExp();
            $lvl = $utilities->getLvl($exp);
            $expNextLvl = $utilities->expLvl($lvl+1) - $exp;
            return $this->render('character/show.html.twig', [
                'character' => $this->getUser()->getUCharacter(),
                'lvl' => $lvl,
                'expNextLvl' => $expNextLvl,
            ]);
        }
    }

    /**
     * @Route("/classi/{n}", name="classi", methods="GET")
     */
    public function show(Request $request, CharacterRepository $characterRepository): Response
    {   
        $per_page = 10;
        $num_pag = $request->get('n');

        if($this->ifPjNoExists()){
            return $this->redirectToRoute('character_new');
        }else{
            if($num_pag !== null){
                if($num_pag < 1){
                    $num_pag = 1;
                }
            } else{
                $num_pag = 1;
            }
            $users = $entityManager->getRepository(Character::class)->findBy(['bot' => false],['exp' => 'DESC']);

            //$empresas = $empresa_repo->getPaginateEntries($num_pag,$per_pag);
        
            $totalitems = count($users);
            $pageCount = ceil($users/$per_pag);
            
            if($num_pag > $pageCount){
                $num_pag = $pageCount;
                //$empresas = $empresa_repo->getPaginateEntries($num_pag,$per_pag);
            }

            $totalitems = count($users);
            $pageCount = ceil($users/$per_pag);

            return $this->render('character/classi.html.twig', [
                'users' => $users,
            ]);
        }
    }

    public function ifPjExists(){
        if($this->getUser()->getUCharacter() != null){
            $status = "¡Ya tienes un personaje registrado!";
            $class = "alert-dismissible alert-warning";
            $this->session->getFlashBag()->add("class", $class);
            $this->session->getFlashBag()->add("status", $status);
            return true;
        }
        else{
            return false;
        }
    }

    public function ifPjNoExists(){
        if($this->getUser()->getUCharacter() == null){
            $status = "Por favor, registra primero un personaje para jugar.";
            $class = "alert-dismissible alert-warning";
            $this->session->getFlashBag()->add("class", $class);
            $this->session->getFlashBag()->add("status", $status);
            return true;
        }
        else{
            return false;
        }
    }
}
