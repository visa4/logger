<?php
namespace MiddlewareLogger\Error;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use MiddlewareLogger\LoggerPluginManager;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ErrorMiddlewareFactory
 */
class ErrorLogMiddlewareFactory implements FactoryInterface
{
    const NAMESPACE_CONFIG = 'middleware-logger-factory-config';
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

        if (!isset($config['logger'])
            || !$container->has(LoggerPluginManager::class)
            || !$container->get(LoggerPluginManager::class)->has($config['logger'])
        ) {
            throw new ServiceNotCreatedException('Middleware error log wrong setting');
        }

        $errorLogMiddleware = new ErrorLogMiddleware();
        return $errorLogMiddleware->setLogger(
            $container->get(LoggerPluginManager::class)->get($config['logger'])
        );
    }
}