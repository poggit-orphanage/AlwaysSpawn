<?php
namespace philipshilling\alwaysspawn;

class ResourceUpdater {

    private static $instance = null;
    private $resourceManagerInstance = null;
    private $defaultConfig = null;

    private function __construct(ResourceManager $resourceManagerInstance) {
        $this->resourceManagerInstance = $resourceManagerInstance;
        $this->defaultConfig = array(
            "version" => $this->resourceManagerInstance->getPluginVersion(),
            "alwaysspawn with proxy" => false);
    }

    public static function getInstance(ResourceManager $resourceManagerInstance) {
        if (ResourceUpdater::$instance === null)
            ResourceUpdater::$instance = new ResourceUpdater($resourceManagerInstance);
        return ResourceUpdater::$instance;
    }

    public function isConfigResourceOutdated(): bool {
        $ver = $this->resourceManagerInstance->getConfigVersion();
        if ($ver === null)
            return true;
        if ($ver !== $this->resourceManagerInstance->getPluginVersion())
            return true;
        return false;
    }

    public function getDefaultConfig() {
        return $this->defaultConfig;
    }

    public function updateResourcesIfRequired($forceUpdate = false) {
        if ($this->isConfigResourceOutdated() || $forceUpdate === true) {
            $oldConfig = $this->resourceManagerInstance->getConfig();
            $newConfigKeys = array_keys($this->getDefaultConfig());

            foreach ($newConfigKeys as $key) {
                if (! isset($oldConfig[$key]))
                    $oldConfig[$key] = $this->getDefaultConfig()[$key];
            }
            $oldConfig['version'] = $this->resourceManagerInstance->getPluginVersion();
            $this->resourceManagerInstance->saveConfig($oldConfig);
        }
    }
}
