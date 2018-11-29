<?php

namespace App\Service;

class EventService {

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

    public function getAll() {
        return $this->events;
    }

    public function getOne( $id ) {

        foreach ($this->events as $key => $value) {
            if ($value['id'] == $id)
                return $value;
        }
        return null;
    }

}


?>
