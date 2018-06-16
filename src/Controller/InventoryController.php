<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Message;
use App\Entity\Character;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Utils\Utilities;


class InventoryController extends Controller
{
    /**
     * @Route("/juego/inventory", name="inventory")
     */
    public function index()
    {
        foreach ($this->getUser()->getUCharacter()->getHaveItems() as $i) {
            var_dump($i->getIequipment());
        }
        return $this->render('inventory/inventory.html.twig', [
            'items' => $this->getUser()->getUCharacter()->getHaveItems()
        ]);
    }

    /**
     * @Route("/juego/inventory/{id}/equip", name="equip_item")
     */
    public function equip(Request $request)
    {

    }
}
