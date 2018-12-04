<?php
namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Event;

class EventService {
    private $om;

    public function __construct( ObjectManager $om ){
        $this->om = $om;
    }

    public function getAll(){
        $repo = $this->om->getRepository( Event::class );
        return $repo->findAll();
    }

    public function getOne( $id ) {
        $repo = $this->om->getRepository( Event::class );
        return $repo->find( $id );
    }

    public function search($name, $sort, $page)
    {
        $repo = $this->om->getRepository( Event::class );
        return $repo->search( $name, $sort, $page );
    }

    public function count()
    {
        $repo = $this->om->getRepository( Event::class );
        return $repo->countIncoming();
    }

}


?>
