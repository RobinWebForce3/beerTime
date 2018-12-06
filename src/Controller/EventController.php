<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Service\EventService;
use App\Form\EventType;
use App\Entity\Event;

class EventController extends AbstractController
{

    /**
     * @Route("/event", name="event_list")
     */
    public function list(Request $request, EventService $eventService )
    {
        $querySort = $request->query->get('sort');
        $querySearch = $request->query->get('querySearch');
        $page = $request->query->get('page');
        if (empty($page)){
            $page=1;
        }
        return $this->render('event/eventList.html.twig', [
            "events" => $eventService->search($querySearch, $querySort, $page),
            "incomingEvent" => $eventService->count(),
            "page"=>$page
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
    public function add( EventService $eventService, Request $req )
    {
        $event = new Event();
        $form = $this->createForm( EventType::class, $event );

        $form->handleRequest( $req );
        if ( $form->isSubmitted() && $form->isValid() ) {
            $eventService->add( $event );
            return $this->redirectToRoute('event_show', [ 'id' => $event->getId() ]);
        }

        return $this->render('event/add.html.twig', [
            "form" => $form->createView()
        ]);
    }


    /**
     * @Route("/event/{id}/join", name="event_join", requirements={"id"="\d+"})
     */
    public function join( EventService $eventService, $id )
    {
        return new Response( "Rejoindre un événement");
    }

}
