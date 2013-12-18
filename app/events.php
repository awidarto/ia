<?php


Event::listen('log.a',function($class, $method, $actor, $result){
    $data = array(
            'timestamp'=>new MongoDate(),
            'class'=>$class,
            'method'=>$method,
            'actor'=>$actor,
            'result'=>$result
        );

    Activelog::insert($data);

    return true;
});