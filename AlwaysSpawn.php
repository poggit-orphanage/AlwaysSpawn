<?php

/*
__PocketMine Plugin__
name=AlwaysSpawn
description=Force your users to automatically spawn every time they login!
version=1.0.3
author=Comedyman937
class=Spawner
apiversion=6,7,8,9,10,11
*/

    class Spawner implements plugin{

    private $api;

    public function __construct(ServerAPI $api, $server = false)
    {
        $this->api = $api;
    }

    public function init()
    {
        $this->api->addHandler("player.spawn", array($this, "eventHandler"), 100);
    }
    
    public function eventHandler($data, $event)
    {
        switch($event)
        {
            case 'player.spawn':

                // PocketMine core schedules lots of teleports - ugh, we need to wait awhile
                $this->api->schedule(31, array($this, "teleport"), $data);

            break;
        }

    }

    public function teleport($player)
    {
         $player->teleport($this->api->level->getSpawn());
    }

    public function __destruct(){

    }

}
