<?php
/**
 * This file is part of the RestClient package.
 *
 *  (c) Colppy <developers@colppy.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Tests\Helper;


/**
 * Test for the Testing the class Uri.
 *
 * @author Jerry Anselmi <jerry.anselmi@colppy.com>
 */
class UriTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test that the class is instantiable.
     * 
     * @test
     * @group PathGenerator
     */
    public function caseOne()
    {
        $this->assertInstanceOf(\RestClient\Api\Helper\UriInterface::class, new \RestClient\Helper\Uri);
    }

    /**
     * Test path generate with empty path and empty params.
     *
     * @test
     * @group PathGenerator
     */
    public function caseTwo()
    {
        $path = \RestClient\Helper\Uri::path('', []);
        $this->assertNotNull($path);
        $this->assertTrue(gettype($path) === "string");
        $this->assertEquals('', $path);
    }

    /**
     * Test path generate with valid path and empty params.
     *
     * @test
     * @group PathGenerator
     */
    public function caseThree()
    {
        $path = \RestClient\Helper\Uri::path("/path/to/{any}/with/{any_other}", []);
        $this->assertNotNull($path);
        $this->assertTrue(gettype($path) === "string");
        $this->assertEquals("path/to/{any}/with/{any_other}", $path);
    }

    /**
     * Test path generate with empty path and not empty params.
     *
     * @test
     * @group PathGenerator
     */
    public function caseFour()
    {
        $path = \RestClient\Helper\Uri::path("", ["any" => "any-value"]);
        $this->assertNotNull($path);
        $this->assertTrue(gettype($path) === "string");
        $this->assertEquals("", $path);
    }

    /**
     * Test path generate with valid path and wrong params.
     *
     * @test
     * @group PathGenerator
     */
    public function caseFive()
    {
        $path = \RestClient\Helper\Uri::path("path/to/{id}/with/{token}", ["any" => "any-value"]);
        $this->assertNotNull($path);
        $this->assertTrue(gettype($path) === "string");
        $this->assertEquals("path/to/{id}/with/{token}", $path);
    }

    /**
     * Test path generate with valid path and params.
     *
     * @test
     * @group PathGenerator
     */
    public function caseSix()
    {
        $path = \RestClient\Helper\Uri::path(
            "path/to/{any}/with/{any-other}",
            ["any" => "any-value", "any-other" => "any-other-value"]
        );
        $this->assertNotNull($path);
        $this->assertTrue(gettype($path) === "string");
        $this->assertEquals("path/to/any-value/with/any-other-value", $path);
    }
}
