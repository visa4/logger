<?php
namespace MiddlewareLogger;

use Zend\Log\LoggerInterface;
use Zend\ServiceManager\AbstractPluginManager;

/**
 * Class LoggerPluginManager
 */
class LoggerPluginManager extends AbstractPluginManager
{
    protected $instanceOf = LoggerInterface::class;
}