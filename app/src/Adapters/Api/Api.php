<?php

namespace Medi\CourseManagementBackend\Adapters\Api;

use Medi\CourseManagementBackend\Core\Ports;
use Medi\CourseManagementBackend\Adapters\Projections\Projection;
use Medi\CourseManagementBackend\Adapters\Publishers\Publisher;
use Swoole\Http;
use Medi\CourseManagementBackend\Adapters\Formatter\Formatter;
use Medi\CourseManagementBackend\Adapters\Actions\Action;
use FluxIliasRestApiClient\Adapter\Api\IliasRestApiClient;

class Api
{
    private Ports\Service $service;

    private function __construct()
    {
        $this->service = Ports\Service::new();
    }

    public static function new() : self
    {
        return new self();
    }

    /**
     * @throws \Exception
     */
    final public function handleHttpRequest(Http\Request $request, Http\Response $response) : void
    {
        $requestUri = $request->server['request_uri'];

        $getParam = function ($parameterName) use ($requestUri) : string {
            $explodedParam = explode($parameterName . "/", $requestUri, 2);
            if (count($explodedParam) === 2) {
                $explodedParts = explode("/", $explodedParam[1], 2);
                if (count($explodedParts) == 2) {
                    return $explodedParts[0];
                }
                return $explodedParam[1];
            }
            return "";
        };

        $restApiClient = IliasRestApiClient::new();

        switch (true) {
            case str_contains($requestUri, 'publishData'):
                //example request_uri: http://127.0.0.11/flux-ilias-rest-api-proxy/crsmgmt-backend/projection/courseList/parentIdOrId/81/projectionType/keyValueList/publishData
                $this->service->publishData(
                    Formatter::from($getParam('projectionType'))->format(Projection::from($getParam('projection'))->byParentRefId($getParam('parentIdOrId'))),
                    Publisher::JSON_DATA_PUBLISHER->get($this->publish($response)),
                );
                break;
            case str_contains($requestUri, 'enrollClassMembers'):
                //example request_uri: http://127.0.0.11/flux-ilias-rest-api-proxy/crsmgmt-backend/parentIdOrId/81/class/RS_22-25_B/enrollClassMembers
                $this->service->enrollMembers(
                    Formatter::OBJ_ID_ARRAY->format(Projection::USER_LIST->byFieldValue("Klasse", $getParam('class'))),
                    Formatter::REF_ID_ARRAY->format(Projection::COURSE_LIST->byParentRefId($getParam('parentIdOrId'))),
                    Action::ENROLL_TO_COURSE->get($restApiClient),
                    Publisher::JSON_DATA_PUBLISHER->get($this->publish($response))
                );
                break;
        }

    }

    private function publish(Http\Response $response)
    {
        return function (string $jsonData) use ($response) {
            $response->header('Content-Type', 'application/json');
            $response->header('Cache-Control', 'no-cache');
            $response->end($jsonData); //json_encode($data, JSON_UNESCAPED_UNICODE)
        };
    }

}