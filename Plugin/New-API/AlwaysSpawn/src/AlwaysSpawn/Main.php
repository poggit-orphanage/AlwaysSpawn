<?php

namespace AlwaysSpawn;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\level\Level;
use pocketmine\entity\Entity;
use pocketmine\Player;
use pocketmine\Server;

class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("[INFO] AlwaysSpawn Loaded!");
    }
    
    /**
     * @param PlayerJoinEvent $event
     *
     * @priority       NORMAL
     * @ignoreCanceled false
     */
    public function onSpawn(PlayerJoinEvent $event){
        $player->teleport($player->getLevel()->getSafeSpawn());
    }
    
    public function onDisable(){
        $this->getLogger()->log("[INFO] AlwaysSpawn Unloaded!");
    }
}
