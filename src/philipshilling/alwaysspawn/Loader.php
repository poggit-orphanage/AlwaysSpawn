<?php
namespace philipshilling\alwaysspawn;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase as Plugin;
use pocketmine\Server;
use philipshilling\alwaysspawn\ResourceManager;
use philipshilling\alwaysspawn\ResourceUpdater;

class Loader extends Plugin implements Listener {
    
    public $resourceManager = null;
    public $resourceUpdater = null;
    
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getLogger()->info("AlwaysSpawn Enabled!");
        $this->resourceManager = ResourceManager::getInstance($this, $this->getServer());
        $this->resourceManager->loadResources();
        $this->resourceUpdater = ResourceUpdater::getInstance($this->resourceManager);
        $this->resourceUpdater->updateResourcesIfRequired(true);
    }
    public function onPlayerJoin(PlayerJoinEvent $eventjoin) {
        if ($this->resourceManager->getConfig()["alwaysspawn with proxy"] === true) {
            $this->getLogger()->info("Alwaysspawn starts for proxy setting");
        }
        return $eventjoin->getPlayer()->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn());
    }
    
    public function onPlayerLogin(PlayerLoginEvent $eventlogin) {
        if ($this->resourceManager->getConfig()["alwaysspawn with proxy"] === false) {
            $this->getLogger()->info("Alwaysspawn starts without proxy setting");
        }
        return $eventlogin->getPlayer()->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn());
    }
}
