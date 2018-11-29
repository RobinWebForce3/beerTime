<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;

class EventController extends AbstractController
{

    private $events = [
        [
            "id"=> 1,
            "title"=>"Titre 1",
            "description"=>"nfkjbhvkshhvsdhni",
            "start_date"=> "2018-11-29 08:00:00",
            "end_date"=> "2018-11-29 23:00:00"
        ],
        [
            "id"=> 2,
            "title"=>"Titre 2",
            "description"=>"ttototoo",
            "start_date"=> "2018-12-01 08:00:00",
            "end_date"=> "2018-12-01 23:00:00"
        ],
        [
            "id"=> 3,
            "title"=>"Titre 3",
            "description"=>"blablabal",
            "start_date"=> "2018-11-25 08:00:00",
            "end_date"=> "2018-11-25 23:00:00"
        ]
    ];

    /**
     * @Route("/event", name="event_list")
     */
    public function list()
    {
        return $this->render('event/eventList.html.twig', [
            "events" => $this->events
        ]);
    }

    /**
     * @Route("/event/{id}", name="event_show", requirements={"id"="\d+"})
     */
    public function show( $id )
    {

        return $this->render('event/eventShow.html.twig', [
            "event" => $this->events[1]
        ]);
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
