<?php
	namespace philipshilling\alwaysspawn;
	
	use pocketmine\level\Position;
    use pocketmine\plugin\PluginBase as Plugin;
	use pocketmine\event\Listener;
	use pocketmine\event\player\PlayerJoinEvent;
				
	class Loader extends Plugin implements Listener {
		public function onEnable() {
			$this->getServer()->getPluginManager()->registerEvents($this, $this);
			$this->getServer()->getLogger()->info("AlwaysSpawn Enabled!");
		}
		
		public function onPlayerLogin(PlayerJoinEvent $event) {
			$player = $event->getPlayer();
			$x = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getX();
			$y = $this->getServer()->getDefaultLevel()->getSafeSpawn()-> getY();
			$z = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getZ();
			$level = $this->getServer()->getDefaultLevel();
			$player->teleport(new Position($x, $y, $z, $level));
		}

	}