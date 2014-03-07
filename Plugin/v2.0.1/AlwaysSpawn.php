<?php
/*
__PocketMine Plugin__
name=AlwaysSpawn
description=Force your users to automaticaly spawn every time they login!
version=2.0.1dev
author=Comedyman937
class=AlwaysSpawn
apiversion=6,7,8,9,10,11,12
*/
class AlwaysSpawn implements Plugin{
    private $api, $path, $config;

    public function __construct(ServerAPI $api, $server = false)
    {
        $this->api = $api;
    }

    public function init()
    {
        $this->config = new Config($this->api->plugin->configPath($this)."config.yml", CONFIG_YAML, array(
            'enableConf' => false,
            'spawnWorld' => 'world',
            'X' => 0,
            'Y' => 0,
            'Z' => 0,
        ));
        $this->api->console->register("aslocation", "Get your in game location!", array($this, "location"));
        $this->api->console->register("asset", "Set up the AlwaysSpawn config while in-game!", array($this, "setConf"));
        $this->api->addHandler("player.spawn", array($this, "eventHandler"), 100);
        console("[INFO] AlwaysSpawn 2.0.1 Dev Build #6 Loaded!");
    }

    public function eventHandler($data, $event)
    {
        $enableConf=$this->config->get('enableConf');
        if($enableConf=true){
            console("[INFO] [AlwaysSpawn] 'enableConf' is set to true in the config.yml file!");
            switch($event){
                case 'player.spawn':
                    $XPos=$this->config->get('X');
                    $YPos=$this->config->get('Y');
                    $ZPos=$this->config->get('Z');
                    $Level=$this->config->get('spawnWorld');
                    $username=$data;
                    $spawn=new Position($XPos, $YPos, $ZPos, $Level);
                    $this->api->player->teleport($username, $spawn);
                break;
            }
        }elseif($enableConf=false){
            console("[INFO] [AlwaysSpawn] 'enableConf' is set to false in the config.yml file!");
            switch($event){
                case 'player.spawn':
                    $player->teleport($this->api->level->getSpawn());
                break;
            }
        }else{
            console("[ERROR] [AlwaysSpawn] Nothing is set for 'enableConf' in the config.yml file! AlwaysSpawn has set it to false by default in order to run the plugin correctly!");
        }
    }

    public function location($data, $issuer, $event)
    {
         switch($event){
              case "aslocation":
                   if(!($issuer instanceof Player)){
                        console("[ERROR] [AlwaysSpawn] Please run this command in-game!");
                   }else{
                        $issuer->sendChat("====================\nLocation:\nX: ".ceil($player->entity->x)."\nY: ".ceil($player->entity->y)."\nZ: ".ceil($player->entity->z)."\nWorld: ".$player->entity->level->getName()."\n====================");
              }
              break;
         }
    }

    public function setConf($data, $issuer, $event)
    {
         switch($event){
              case "asset":
                   if(!($issuer instanceof Player)){
                        console("[ERROR] [AlwaysSpawn] Please run this command in-game!");
                   }else{
                        $issuer->sendChat("[AlwaysSpawn] This command currently has no use.\nPlease give me some time to work on this part.");
              }
              break;
         }
    }
   
    public function __destruct(){
        console("[INFO] AlwaysSpawn Unloaded!");
    }
}
?>
