<?php
declare(strict_types = 1);

namespace Middlewares\Utils;

use Psr\Http\Message\MessageInterface;

/**
 * Class with common helpers
 */
abstract class Helpers
{
    /**
     * Fix the Content-Length header
     * Used by middlewares that modify the body content
     */
    public static function fixContentLength(MessageInterface $response): MessageInterface
    {
        if (!$response->hasHeader('Content-Length')) {
            return $response;
        }

        if ($response->getBody()->getSize() !== null) {
            return $response->withHeader('Content-Length', (string) $response->getBody()->getSize());
        }

        return $response->withoutHeader('Content-Length');
    }
}
