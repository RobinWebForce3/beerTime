<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;

class EventController extends AbstractController
{

    /**
     * @Route("/event", name="event_list")
     */
    public function list()
    {
        return new Response( "Liste des événements");
    }

    /**
     * @Route("/event/{id}", name="event_show", requirements={"id"="\d+"})
     */
    public function show( $id )
    {
        return new Response( "Un événement");
    }

    /**
     * @Route("/event/new", name="event_add")
     */
    public function add()
    {
        return new Response( "Ajouter un événement");
    }


    /**
     * @Route("/event/{id}/join", name="event_join", requirements={"id"="\d+"})
     */
    public function join( $id )
    {
        return new Response( "Rejoindre un événement");
    }

}
