<?php

namespace NationalRailBundle\Tests\Utils;

use Guzzle\Tests\GuzzleTestCase,
    Guzzle\Plugin\Mock\MockPlugin,
    Guzzle\Http\Message\Response,
    Guzzle\Http\Client as HttpClient,
    Guzzle\Http\EntityBody;

class SitePointGuzzleTest extends GuzzleTestCase
{
    protected $_client;

    public function testAnotherRequest() {


        $mockResponse = new Response(200);
        $mockResponseBody = EntityBody::factory(fopen('src/NationalRailBundle/Tests/mock/test.json','r'));

        $mockResponse->setBody($mockResponseBody);

        $mockResponse->setHeaders(array(
            "Host" => "host.com",
            "User-Agent" => "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36",
            "Accept" => "application/json",
            "Content-Type" => "application/json"
        ));

        $mockPlugin = new MockPlugin();
        $mockPlugin->addResponse($mockResponse);
        $httpClient = new HttpClient();
        $httpClient->addSubscriber($mockPlugin);

        $request = $httpClient->get(
            '/GetTimes/GetDepartureBoard/10/GTW'
        );
        $response = $request->send();

        //echo $response->getBody();
        //die;

        /*$this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(in_array(
            'Host', array_keys($response->getHeaders()->toArray())
        ));
        $this->assertTrue($response->hasHeader("User-Agent"));
        $this->assertCount(4, $response->getHeaders());
        $this->assertSame(
            $mockResponseBody->getSize(),
            $response->getBody()->getSize()
        );*/



        // ...
    }
}