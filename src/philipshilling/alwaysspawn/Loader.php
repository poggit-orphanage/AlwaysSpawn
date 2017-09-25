<?php

namespace philipshilling\alwaysspawn;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase as Plugin;

class Loader extends Plugin implements Listener{
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getLogger()->info("AlwaysSpawn Enabled!");
	}

	public function onPlayerLogin(PlayerJoinEvent $event){
		$event->getPlayer()->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn());
	}

}