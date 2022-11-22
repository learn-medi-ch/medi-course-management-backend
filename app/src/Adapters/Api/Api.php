<?php

namespace Medi\CourseManagementBackend\Adapters\Api;

use Medi\CourseManagementBackend\Adapters;
use Swoole\Http;

class Api
{
    private Adapters\Configs\Configs $configs;

    private function __construct()
    {
        $this->configs = Adapters\Configs\Configs::new();
    }

    public static function new(): self
    {
        return new self();
    }

    final public function handleHttpRequest(Http\Request $request, Http\Response $response): void
    {
        //example request_uri: /projection/courseList/parentIdOrId/333/projectionType/keyValueList
        $requestUri = $request->server['request_uri'];

        $getParam = function ($parameterName) use ($requestUri): string {
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

        $getData = function () use ($requestUri, $getParam, $response): string {
            return $this->configs->data(
                $getParam('projection'),
                $getParam('parentIdOrId')
            );
        };

        $handleProjectTo = function (string $jsonData) use ($requestUri, $getParam, $response): void {
            $this->configs->projectTo(
                $getParam('projectionType'),
                $this->publish($response)
            )($jsonData);
        };

        $handleProjectTo($getData());
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