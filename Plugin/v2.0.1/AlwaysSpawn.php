<?php


/*
__PocketMine Plugin__
name=AlwaysSpawn
description=Force your users to automatically spawn every time they login!
version=2.0.1
author=Comedyman937
class=AlwaysSpawn
apiversion=6,7,8,9,10,11
*/


    class AlwaysSpawn implements plugin{


    private $api;


    public function __construct(ServerAPI $api, $server = false)
    {
        $this->api = $api;
    }


    public function init()
    {
        $this->api->addHandler("player.connect", array($this, "eventHandler"), 100);
        console("[INFO] AlwaysSpawn loaded!");
        console("[INFO] Your players will connect to the server at the Spawn Point!");
    }
    
    public function eventHandler($data, $event)
    {
        switch($event)
        {
            case 'player.connect':


                $player->setSpawn($this->api->level->getSpawn());


            break;
        }


    }


    public function __destruct(){


    }


}
