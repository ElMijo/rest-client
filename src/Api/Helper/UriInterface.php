<?php
/**
 * This file is part of the RestClient package.
 *
 *  (c) Jerry Anselmi <jerry.anselmi@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */


namespace RestClient\Api\Helper;

/**
 * This interface implements methods to generate an uri.
 *
 * @author Jerry Anselmi <jerry.anselmi@colppy.com>
 */
interface UriInterface
{
    /**
     * Generate an uri with arguments passed.
     *
     * Parameters
     * ----------
     *
     * - __baseUrl__
     *      - http://domain.com
     *      - http://domain.com:80
     *      - http://domain.com:80/api/v1
     *  - __path__
     *      - /path/to/{any}
     *      - /path/to/{any}/with/{any_other}
     *  - __routeParams__
     *      - ["any" => "any-value"]
     *      - ["any" => "any-value", "any_other" => "any-other-value"]
     *  - __query__
     *      - ["name" => "Jerry Anselmi", "profession" => "developer"]
     *
     *
     * @param string $baseUri       Base uri with protocol and port, also you can pass part of the path.
     * @param string $path          The path to generate the uri, this value can contain params that after can be merged
     *                              with $routeParams.
     * @param array $routeParams    List of route parameters, this values will be merged with $path.
     * @param array $query          List of query parameters.
     *
     * @return string
     *
     * @throws \RestClient\Exception\UriException   if the $baseUri is not a valid url.
     */
    public static function generate(string $baseUri, string $path = '', array $routeParams = [], array $query = []);

    /**
     * Generate the path with the route params. To build the road it is necessary that the parameters to be replaced
     * are between keys.
     *
     * Parameters
     * ----------
     *  - __path__
     *      - /path/to/{any}
     *      - /path/to/{any}/with/{any_other}
     *  - __routeParams__
     *      - ["any" => "any-value"]
     *      - ["any" => "any-value", "any_other" => "any-other-value"]
     *
     * @param string $path  The path with the route params
     * @param array $params List of route parameters.
     *
     * @return string
     */
    public static function path(string $path, array $params);
}
