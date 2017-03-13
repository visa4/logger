<?php
namespace MiddlewareLogger\Error;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Log\LoggerAwareInterface;
use Zend\Log\LoggerAwareTrait;
use Zend\Stratigility\ErrorMiddlewareInterface;

class ErrorLogMiddleware implements LoggerAwareInterface, ErrorMiddlewareInterface
{
    use LoggerAwareTrait;

    public function __invoke($error, Request $request, Response $response, callable $out = null)
    {
        if ($error instanceof \Throwable) {
            $this->logger->error($error->getMessage() . '. File: ' . $error->getFile() . ':' . $error->getLine());
        }

        if ($next !== null) {
            return $next($request, $response, $error);
        }

        return $response;
    }
}