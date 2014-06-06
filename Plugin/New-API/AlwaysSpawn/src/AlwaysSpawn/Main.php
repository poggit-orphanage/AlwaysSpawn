<php

namespace AlwaysSpawn;

use pocketmine\plugin\PluginBase;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\RemoteConsoleCommandSender;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;

class Main extends PluginBase{

    public function onEnable(){
        $cmd = new PluginCommand("alwaysspawn", "onCommand");
        
        $cmd->setDescription("Admin commands for AlwaysSpawn!");
        $cmd->setAliases(array("as"));
        
        $this->getServer()->getPluginManager()->registerEvents("PlayerJoinEvent", onJoin);
        
        $this->getLogger()->log("[INFO] AlwaysSpawn Loaded!");
    }
    
    public function onJoin(pocketmine\event\player\PlayerJoinEvent $playerjoin){
        
    }
    
    public function onCommand(pocketmine\command\CommandSender $issuer, Command $cmd, $label, array $args){
        $issuer->sendMessage("[AlwaysSpawn] Commands are not currently accessable with the New API!\nThey will be re-aded in a later update!");
    }
    
    public function onDisable(){
        $this->getLogger()->log("[INFO] AlwaysSpawn Unloaded!");
    }
}
