<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Service\EventService;


class EventController extends AbstractController
{

    /**
     * @Route("/event", name="event_list")
     */
    public function list(Request $request, EventService $eventService )
    {
        $querySort = $request->query->get('sort');
        $querySearch = $request->query->get('querySearch');
        return $this->render('event/eventList.html.twig', [
            "events" => $eventService->search($querySearch, $querySort),
            "incomingEvent" => $eventService->count(),
        ]);
    }

    /**
     * @Route("/event/{id}", name="event_show", requirements={"id"="\d+"})
     */
    public function show( EventService $eventService, $id )
    {

        return $this->render('event/eventShow.html.twig', [
            "event" => $eventService->getOne( $id )
        ]);
    }

    /**
     * @Route("/event/new", name="event_add")
     */
    public function add( EventService $eventService )
    {
        return new Response( "Ajouter un événement");
    }


    /**
     * @Route("/event/{id}/join", name="event_join", requirements={"id"="\d+"})
     */
    public function join( EventService $eventService, $id )
    {
        return new Response( "Rejoindre un événement");
    }

}
