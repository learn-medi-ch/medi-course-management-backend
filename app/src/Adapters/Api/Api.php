<?php

namespace Medi\CourseManagementBackend\Adapters\Api;

use Medi\CourseManagementBackend\Adapters;
use Medi\CourseManagementBackend\Core;

use Swoole\Http;

class Api
{
    const REQUEST_TYPE_COMMAND = 'command';
    const REQUEST_TYPE_QUERY = 'query';

    private function __construct(private Core\Actor $actor)
    {

    }

    public static function new() : self
    {
        return new self(Core\Actor::new(Adapters\Configs\Configs::new()));
    }

    final public function handleHttpRequest(Http\Request $request, Http\Response $response) : array
    {

        $iliasUserId = $request->header['x-flux-ilias-api-user-id'];
        echo $iliasUserId;

        $requestUri = $request->server['request_uri'];

        //todo handle with api.json

        //toRemove
        return ['status' => 'success', 'request' => $requestUri];
    }

    private function response(Http\Response $response)
    {
        return function (object $event) use ($response) {
            $response->header('Content-Type', 'application/json');
            $response->header('Cache-Control', 'no-cache');
            $response->end(json_encode($event, JSON_UNESCAPED_UNICODE));
        };
    }

}