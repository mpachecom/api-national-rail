<?php

namespace NationalRailBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

class DefaultControllerTest extends WebTestCase
{

    private $client;

    public function setUp(){
        $this->client = static::createClient();
    }

    public function test_getTimesGet(){

        $client = self::createClient();


        $client->request('GET','/GetTimes/');

        $crawler = new Crawler($client->getResponse()->getContent());

        $this->assertContains("Method",$crawler->filterXPath('//form/table/tr[3]/td/span')->text());
        $this->assertContains("NumRows",$crawler->filterXPath('//form/table/tr[4]/td/span')->text());
        $this->assertContains("crs",$crawler->filterXPath('//form/table/tr[5]/td/span')->text());
        $this->assertContains("filterCrs",$crawler->filterXPath('//form/table/tr[6]/td/span')->text());
        $this->assertContains("filterType",$crawler->filterXPath('//form/table/tr[7]/td/span')->text());
        $this->assertContains("timeOffset",$crawler->filterXPath('//form/table/tr[8]/td/span')->text());
        $this->assertContains("timeWindow",$crawler->filterXPath('//form/table/tr[9]/td/span')->text());

    }

    public function test_getDepartureBoardResponseKeys(){

        $client = self::createClient();

        $client->request('GET','/GetTimes/GetDepartureBoard/10/GTW');

        $this->assertContains("GetStationBoardResult",$client->getResponse()->getContent());
        $this->assertContains("locationName",$client->getResponse()->getContent());
        $this->assertContains("crs",$client->getResponse()->getContent());
        $this->assertContains("platformAvailable",$client->getResponse()->getContent());
        $this->assertContains("trainServices",$client->getResponse()->getContent());

    }



}
