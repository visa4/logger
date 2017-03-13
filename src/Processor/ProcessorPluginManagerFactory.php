<?php
namespace MiddlewareLogger\Processor;

use Interop\Container\ContainerInterface;
use Zend\Log\LoggerInterface;
use Zend\Log\ProcessorPluginManager;
use Zend\Log\WriterPluginManager;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ProcessorPluginManagerFactory
 */
class ProcessorPluginManagerFactory implements FactoryInterface
{
    const NAMESPACE_CONFIG = 'log_processors';

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

        return new ProcessorPluginManager($container, $config);
    }
}