<?php

namespace Medi\CourseManagementBackend\Adapters\Api;

use Medi\CourseManagementBackend\Adapters;
use Medi\CourseManagementBackend\Core\Ports;

use Swoole\Http;

class Api
{
    private Ports\Service $apiGatewayService;
    const REQUEST_TYPE_COMMAND = 'command';
    const REQUEST_TYPE_QUERY = 'query';

    private function __construct(Ports\Service $apiGatewayService)
    {
        $this->apiGatewayService = $apiGatewayService;
    }

    public static function new() : self
    {
        $apiGatewayService = Ports\Service::new(Adapters\Configs\Configs::new());
        return new self($apiGatewayService);
    }

    final public function handleHttpRequest(Http\Request $request) : array
    {
        $requestUri = $request->server['request_uri'];
        $requestType = $this->getRequestType($requestUri);
        //todo
        $actorId = 'actor@fluxlabs.ch';

        switch ($requestType) {
            case self::REQUEST_TYPE_COMMAND:
                $requestContent = [];
                if (!empty($request->getContent())) {
                    $requestContent = json_decode($request->getContent(), true);
                }
                $this->apiGatewayService->command($actorId, $requestUri, $requestContent);
                return ['status' => 'success'];
            case self::REQUEST_TYPE_QUERY:
                $requestContent = [];
                if (!empty($request->get)) {
                    $requestContent = $request->get;
                }
                return $this->apiGatewayService->query($actorId, $requestUri, $requestContent);
        }
    }

    private function getRequestType(string $requestUri) : string
    {
        if (str_contains($requestUri, self::REQUEST_TYPE_COMMAND)) {
            return self::REQUEST_TYPE_COMMAND;
        }

        if (str_contains($requestUri, self::REQUEST_TYPE_QUERY)) {
            return self::REQUEST_TYPE_QUERY;
        }

        throw new \RuntimeException('No valid Request Type found for requestUri: ' . $requestUri);
    }
}