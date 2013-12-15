<?php

/*
__PocketMine Plugin__
name=AlwaysSpawn
description=Force your users to automatically spawn every time they login!
version=1.0.3
author=Comedyman937
class=Spawner
apiversion=6,7,8,9,10,11,12,13,14,15,16,17
*/

    class Spawner implements plugin{

    private $api;

    public function __construct(ServerAPI $api, $server = false){

		$this->api = $api;

	}

	public function init(){

        $this->api->addHandler("player.connect", array($this, "eventHandler"), 100);

    }
    
    public function eventHandler($data, $event)
    {
    switch($event)
    {
        case 'player.connect':

            $data['player']->run("spawn");

        break;
    }

    }

    public function __destruct(){

    }

}
