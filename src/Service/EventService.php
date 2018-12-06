<?php
namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Event;
use App\Entity\User;

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

    public function add( $event ) {
        $repo = $this->om->getRepository( User::class );
        $user = $repo->find( 1 ); // C'est du dev hein...
        $event->setOwner( $user );

        $this->setupMedia( $event );

        $this->om->persist( $event );
        $this->om->flush();
    }

    private function setupMedia( $event ){
        if( !empty( $event->getPosterUrl() ) ){
            return $event->setPoster( $event->getPosterUrl() );
        }

        $file = $event->getPosterFile();
        $filename = md5( uniqid() ) . '.' . $file->guessExtension();

        $file->move( './data', $filename );

        return $event->setPoster( $filename );
    }
}


?>
