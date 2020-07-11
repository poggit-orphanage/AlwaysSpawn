<?php
namespace philipshilling\alwaysspawn;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use philipshilling\alwaysspawn\Loader;

class ResourceManager {
    private static $instance = null;
    private $resUpdaterInstance = null;
    private $pluginInstance = null;
    private $serverInstance = null;
    private $pluginVersion = null;
    private $config = [];

    private function __construct(Loader $plugin, Server $sv) {
        $this->pluginInstance = $plugin;
        $this->serverInstance = $sv;
        $this->resUpdaterInstance = ResourceUpdater::getInstance($this);

        $this->pluginVersion = $this->pluginInstance->getDescription()->getVersion();
    }

        public static function getInstance(Loader $plugin, Server $sv)
    {
        if(ResourceManager::$instance === null)
            ResourceManager::$instance = new ResourceManager($plugin, $sv);

        return ResourceManager::$instance;
    }
    
    public function getConfig() {
        return $this->config;
    }

    public function getConfigVersion() {
        if (isset($this->config['version']))
            return $this->config['version'];

        return null;
    }

    public function loadResources() {
        if (! is_dir($path = $this->pluginInstance->getDataFolder())) {
            mkdir($path);
        }
        $this->loadConfig($path);
    }

    public function loadConfig($path) {
        if (is_file($path . 'config.yml')) {
            $this->config = yaml_parse_file($path . 'config.yml');
        } else {
            $this->config = $this->resUpdaterInstance->getDefaultConfig();

            yaml_emit_file($path . 'config.yml', $this->config);
        }
    }

    public function saveConfig($config) {
        $this->config = $config;

        $path = $this->pluginInstance->getDataFolder();
        yaml_emit_file($path . 'config.yml', $this->config);
    }
}
