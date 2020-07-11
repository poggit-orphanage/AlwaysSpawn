<?php
namespace philipshilling\alwaysspawn;

class ResourceUpdater
{

    private static $instance = null;

    private $resourceManagerInstance = null;

    private $defaultConfig = null;

    private function __construct(ResourceManager $resourceManagerInstance)
    {
        $this->resourceManagerInstance = $resourceManagerInstance;

        $this->defaultConfig = array(
            "version" => $this->resourceManagerInstance->getPluginVersion(),
            "alwaysspawn with proxy" => false
        );
    }

    public static function getInstance(ResourceManager $resourceManagerInstance)
    {
        if (ResourceUpdater::$instance === null)
            ResourceUpdater::$instance = new ResourceUpdater($resourceManagerInstance);

        return ResourceUpdater::$instance;
    }

    public function isConfigResourceOutdated(): bool
    {
        $ver = $this->resourceManagerInstance->getConfigVersion();

        /**
         * Old versions do not have this field so if its not set its obviously an outdated one
         */
        if ($ver === null)
            return true;

        if ($ver !== $this->resourceManagerInstance->getPluginVersion())
            return true;

        return false;
    }

    public function getDefaultConfig()
    {
        return $this->defaultConfig;
    }

    /**
     * For each resource file check it's version and if it doesn't match have it updated
     */
    public function updateResourcesIfRequired($forceUpdate = false)
    {
        if ($this->isConfigResourceOutdated() || $forceUpdate === true) {
            $oldConfig = $this->resourceManagerInstance->getConfig();

            $newConfigKeys = array_keys($this->getDefaultConfig());

            /**
             * If a key from the new config is not present in the old config, then add it
             */
            foreach ($newConfigKeys as $key) {
                if (! isset($oldConfig[$key]))
                    $oldConfig[$key] = $this->getDefaultConfig()[$key];
            }

            /**
             * Change the file version to match the current version
             */
            $oldConfig['version'] = $this->resourceManagerInstance->getPluginVersion();

            $this->resourceManagerInstance->saveConfig($oldConfig);
        }
    }
}
