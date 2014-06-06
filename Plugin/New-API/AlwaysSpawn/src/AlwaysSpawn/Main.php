<php

namespace AlwaysSpawn;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\RemoteConsoleCommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\level\Level;
use pocketmine\entity\Entity;
use pocketmine\Player;

class Main extends PluginBase implements Listener, CommandExecutor{

    public function onEnable(){
        $cmd = new PluginCommand("alwaysspawn", "onCommand");
        
        $cmd->setDescription("Admin commands for AlwaysSpawn!");
        $cmd->setAliases(array("as"));
        
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
    
    public function onCommand(CommandSender $issuer, Command $cmd, $label, array $args){
        switch($cmd->getName){
            case "alwaysspawn":
                $issuer->sendMessage("[AlwaysSpawn] Commands have not yet been implemented for the New API!");
                return true;
            default:
                return false;
        }
    }
    
    public function onDisable(){
        $this->getLogger()->log("[INFO] AlwaysSpawn Unloaded!");
    }
}
