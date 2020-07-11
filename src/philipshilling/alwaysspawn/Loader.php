<?php
namespace philipshilling\alwaysspawn;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase as Plugin;
use pocketmine\Server;
use ResourceManager;
use ResourceUpdater;

class Loader extends Plugin implements Listener
{

    public $resourceManager = null;

    public $resourceUpdater = null;

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getLogger()->info("AlwaysSpawn Enabled!");
        $this->resourceManager = ResourceManager::getInstance($this, $this->getServer());
        $this->resourceManager->loadResources();
        $this->resourceUpdater = ResourceUpdater::getInstance($this->resourceManager);
        $this->resourceUpdater->updateResourcesIfRequired(true);
    }

    public function onPlayerJoin(PlayerJoinEvent $event)
    {
        if ($this->resourceManager->getConfig()["alwaysspawn with proxy"] === false) {
            $event->getPlayer()->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn());
        }
    }

    public function onPlayerLogin(PlayerLoginEvent $event)
    {
        if ($this->resourceManager->getConfig()["alwaysspawn with proxy"] === true) {
            $event->getPlayer()->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn());
        }
    }
}
