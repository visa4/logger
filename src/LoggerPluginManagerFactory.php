<?php
namespace MiddlewareLogger;

use Zend\Log\LoggerInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class LoggerPluginManagerFactory
 */
class LoggerPluginManagerFactory extends FactoryInterface
{
    const NAMESPACE_CONFIG = 'pluginmanager-logger-factory-config';

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        if (isset($config[self::NAMESPACE_CONFIG])) {
            $config = $config[self::NAMESPACE_CONFIG];
        } else {
            $config = [];
        }

        return new LoggerPluginManager($container, $config);
    }
}