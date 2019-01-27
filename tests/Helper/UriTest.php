<?php
/**
 * This file is part of the RestClient package.
 *
 *  (c) Jerry Anselmi <jerry.anselmi@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\Helper;


/**
 * Testing the class Uri.
 *
 * @author Jerry Anselmi <jerry.anselmi@colppy.com>
 *
 * @testdox Testing the class Uri
 */
class UriTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     * @testdox Test that the class is instantiable.
     * @group PathGenerator
     */
    public function caseOne()
    {
        $this->assertInstanceOf(\RestClient\Api\Helper\UriInterface::class, new \RestClient\Helper\Uri);
    }

    /**
     * @param string $path
     * @param array $params
     * @param string $result
     *
     * @test
     * @testdox Test generate path successfully.
     * @testWith    ["", [], ""]
     *              ["/path/to/{any}/with/{any_other}", [], "/path/to/{any}/with/{any_other}"]
     *              ["/path/to/{any}/with/{any-other}", {"any":"any-value", "any-other":"any-other-value"}, "/path/to/any-value/with/any-other-value"]
     *
     * @group PathGenerator
     */
    public function caseTwo(string $path, array $params, string $result)
    {
        $this->assertEquals($result, \RestClient\Helper\Uri::path($path, $params));
    }

    /**
     * @param string $path
     * @param array $params
     *
     * @test
     * @testdox Test generate path with valid path and wrong params.
     * @testWith    ["/path/to/{id}/with/{token}", {"any":"any-value"}]
     *
     * @group PathGenerator
     */
    public function caseThree(string $path, array $params)
    {
        $this->assertEquals("/path/to/{id}/with/{token}", \RestClient\Helper\Uri::path($path, $params));
    }

    /**
     * @param string $baseUri
     *
     * @test
     * @testdox Test generate url with empty url.
     * @testWith    [""]
     * @expectedException \RestClient\Exception\UriException
     * @expectedExceptionMessage [] is not a valid base url
     *
     * @group UrlGenerator
     */
    public function caseFour(string $baseUri)
    {
        \RestClient\Helper\Uri::generate($baseUri);
    }

    /**
     * @param string $baseUri
     *
     * @test
     * @testdox Test generate url with invalid url.
     * @testWith    ["any"]
     * @expectedException \RestClient\Exception\UriException
     * @expectedExceptionMessage [any] is not a valid base url
     *
     * @group UrlGenerator
     */
    public function caseFive(string $baseUri)
    {
        \RestClient\Helper\Uri::generate($baseUri);
    }

    /**
     * @param string $baseUri
     * @param string $path
     * @param array $routeParams
     * @param array $query
     * @param string $result
     *
     * @test
     * @testdox Test generate url successfully.
     * @testWith    ["http://localhost", "", [], [], "http://localhost/"]
     *              ["http://localhost:80", "search", [], [], "http://localhost:80/search"]
     *              ["http://localhost", "/search", [], [], "http://localhost/search"]
     *              ["http://localhost:80", "/search/{id}/entity", {"id":123}, [], "http://localhost:80/search/123/entity"]
     *              ["http://localhost", "search/{id}/entity", {"id":123}, {"q":"any", "limit":10}, "http://localhost/search/123/entity?q=any&limit=10"]
     *              ["http://localhost", "/search/{id}/entity", {"id":123}, {"q":"any && others", "limit":10}, "http://localhost/search/123/entity?q=any+%26%26+others&limit=10"]
     *
     * @group UrlGenerator
     */
    public function caseSix(string $baseUri, string $path, array $routeParams, array $query, string $result)
    {
        $this->assertEquals($result, \RestClient\Helper\Uri::generate($baseUri, $path, $routeParams, $query));
    }
}
