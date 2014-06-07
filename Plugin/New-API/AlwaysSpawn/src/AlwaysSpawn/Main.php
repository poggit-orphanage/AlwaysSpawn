<php

namespace AlwaysSpawn;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\level\Level;
use pocketmine\entity\Entity;
use pocketmine\Player;

class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->log("[INFO] AlwaysSpawn Loaded!");
    }
    
    /**
     * @param PlayerJoinEvent $event
     *
     * @priority       NORMAL
     * @ignoreCanceled false
     */
    public function onSpawn(PlayerJoinEvent $event){
        $player->teleport($this->level->getSpawn());
    }
    
    public function onDisable(){
        $this->getLogger()->log("[INFO] AlwaysSpawn Unloaded!");
    }
}
