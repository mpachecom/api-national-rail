<?php

namespace NationalRailBundle\Controller;

use NationalRailBundle\Utils\NationalRail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('NationalRailBundle:Default:index.html.twig');
    }

    public function getTimesAction()
    {
        return $this->render('NationalRailBundle:Default:index.html.twig');
    }

    public function getTimesGetAction($method,$nRows,$crs,$fCrs,$fType,$tOffset,$tWindow)
    {
        return $this->requestTimes($method,$nRows,$crs,$fCrs,$fType,$tOffset,$tWindow);
    }

    /**
     * @param $serviceID
     * @return Response
     */
    public function geServiceGetAction($serviceID)
    {
        return $this->requestServiceID(urldecode($serviceID));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function getTimesDataAction(Request $request)
    {

        $method = $request->request->get('method');
        $nRows = $request->request->get('NumRows');
        $crs = $request->request->get('crs');
        $fCrs = $request->request->get('filterCrs');
        $fType = $request->request->get('filterType');
        $tOffset = $request->request->get('timeOffset');
        $tWindow = $request->request->get('timeWindow');

        return $this->requestTimes($method,$nRows,$crs,$fCrs,$fType,$tOffset,$tWindow);
    }

    public function getServiceDetailsDataAction(Request $request)
    {
        return $this->requestServiceId($request->request->get('serviceID'));

    }

    public function getServiceDetailsAction()
    {
        return $this->render('NationalRailBundle:Default:service-details.html.twig');

    }


    /**
     * @param $method
     * @param $nRows
     * @param $crs
     * @param $fCrs
     * @param $fType
     * @param $tOffset
     * @param $tWindow
     * @return Response
     */
    private function requestTimes($method,$nRows,$crs,$fCrs,$fType,$tOffset,$tWindow){

        $nationalRail = new NationalRail();
        $nationalRail->setMethod($method);
        $nationalRail->setNumRows($nRows);
        $nationalRail->setCrs($crs);
        $nationalRail->setFCrs($fCrs);
        $nationalRail->setFType($fType);
        $nationalRail->setTOffset($tOffset);
        $nationalRail->setTWindow($tWindow);

        return $this->returnJson($nationalRail->get());

    }

    /**
     * @param $serviceID
     * @return Response
     */
    private function requestServiceId($serviceID){

        $nationalRail = new NationalRail();
        $nationalRail->setServiceId($serviceID);
        return $this->returnJson($nationalRail->GetServiceDetails());
    }

    private function returnJson($nationalRail){
        $response = new Response(json_encode($nationalRail));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
