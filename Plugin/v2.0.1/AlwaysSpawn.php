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

//===========================================
//This has not been confirmed as functional!
//===========================================


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
        console("[WARNING] This version of AlwaysSpawn has not been confirmed to be functional!");
        console("[WARNING] It is recommended to get a confirmed version to avoid server damage!");
        console("[WARNING] The current confirmed version is 1.0.3");
    }
    
    public function eventHandler($data, $event)
    {
        switch($event)
        {
            case 'player.connect':


                $this->api->schedule(31, array($this, "spawn"), $data);


            break;
        }


    }


    public function spawn($player)
    {
         $player->setSpawn($this->api->level->getSpawn());
    }


    public function __destruct(){


    }


}
