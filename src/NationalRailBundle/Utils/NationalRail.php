<?php

namespace NationalRailBundle\Utils;


class NationalRail
{
    /**
     * @var null|\SoapClient
     */
    private $soapClient = null;

    /**
     * @var String
     */
    private $method;

    /**
     * @var Int
     */
    private $numRows;

    /**
     * @var String
     */
    private $crs;

    /**
     * @var String
     */
    private $fCrs;

    /**
     * @var String
     */
    private $fType;

    /**
     * @var Int
     */
    private $tOffset;

    /**
     * @var Int
     */
    private $tWindow;

    /**
     * @var
     */
    private $serviceId;



    function __construct()
    {

        $this->soapClient = new \SoapClient("https://lite.realtime.nationalrail.co.uk/OpenLDBWS/wsdl.aspx",array('trace' => TRUE,'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP ));
        $soapVar = new \SoapVar(array('ns2:TokenValue' => "2550bbc7-027e-49e5-bec0-4e07af47871a"),SOAP_ENC_OBJECT);
        $soapHeader = new \SoapHeader('http://thalesgroup.com/RTTI/2010-11-01/ldb/commontypes','AccessToken',$soapVar,FALSE);
        $this->soapClient->__setSoapHeaders($soapHeader);
    }

    /**
     * @return String
     */
    public function getCrs()
    {
        return $this->crs;
    }

    /**
     * @param String $crs
     */
    public function setCrs($crs)
    {
        $this->crs = $crs;
    }

    /**
     * @return String
     */
    public function getFCrs()
    {
        return $this->fCrs;
    }

    /**
     * @param String $fCrs
     */
    public function setFCrs($fCrs)
    {
        $this->fCrs = $fCrs;
    }

    /**
     * @return String
     */
    public function getFType()
    {
        return $this->fType;
    }

    /**
     * @param String $fType
     */
    public function setFType($fType)
    {
        $this->fType = $fType;
    }

    /**
     * @return String
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param String $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return Int
     */
    public function getNumRows()
    {
        return $this->numRows;
    }

    /**
     * @param Int $numRows
     */
    public function setNumRows($numRows)
    {
        $this->numRows = $numRows;
    }

    /**
     * @return null|\SoapClient
     */
    public function getSoapClient()
    {
        return $this->soapClient;
    }

    /**
     * @param null|\SoapClient $soapClient
     */
    public function setSoapClient($soapClient)
    {
        $this->soapClient = $soapClient;
    }

    /**
     * @return Int
     */
    public function getTOffset()
    {
        return $this->tOffset;
    }

    /**
     * @param Int $tOffset
     */
    public function setTOffset($tOffset)
    {
        $this->tOffset = $tOffset;
    }

    /**
     * @return Int
     */
    public function getTWindow()
    {
        return $this->tWindow;
    }

    /**
     * @param Int $tWindow
     */
    public function setTWindow($tWindow)
    {
        $this->tWindow = $tWindow;
    }

    /**
     * @return mixed
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * @param mixed $serviceId
     */
    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;
    }

    function GetServiceDetails()
    {
        $params["serviceID"] = $this->serviceId;
        return $this->soapClient->GetServiceDetails($params);
    }

    function get(){

        return $this->performCall($this->method, $this->numRows, $this->crs, $this->fCrs, $this->fType, $this->tOffset, $this->tWindow);

    }

    private function performCall()
    {
        $method = $this->method;

        $parameters["numRows"] = $this->numRows;
        $parameters["crs"] = $this->crs;
        if ($this->fCrs) $parameters["filterCrs"] = $this->fCrs;
        if ($this->fType) $parameters["filterType"] = $this->fType;
        if ($this->tOffset) $parameters["timeOffset"] = $this->tOffset;
        if ($this->tWindow) $parameters["timeWindow"] = $this->tWindow;
        return $this->soapClient->$method($parameters);
    }

}