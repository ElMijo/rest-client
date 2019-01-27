<?php
/**
 * This file is part of the RestClient package.
 *
 *  (c) Colppy <developers@colppy.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace RestClient\Helper;

/**
 * This class implements the UriInterface.
 *
 * @author Jerry Anselmi <jerry.anselmi@colppy.com>
 */
class Uri implements \RestClient\Api\Helper\UriInterface
{

    /**
     * {@inheritdoc}
     *
     * @see \RestClient\Api\Helper\UriInterface::generate()
     */
    public static function generate(string $baseUri, string $path = '', array $routeParams = [], array $query = [])
    {
        // TODO: Implement generate() method.
    }

    /**
     * {@inheritdoc}
     *
     * @see \RestClient\Api\Helper\UriInterface::path()
     */
    public static function path(string $path, array $params)
    {
        return preg_replace("/^\//", '', preg_replace(
            array_map(function ($key) { return "/\{$key\}/"; }, array_keys($params)),
            array_values($params),
            $path
        ));
    }
}