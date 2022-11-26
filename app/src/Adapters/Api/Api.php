<?php

namespace Medi\CourseManagementBackend\Adapters\Api;

//todo
require_once __DIR__ . '/../../../flux-ilias-rest-api-client/src/Adapter/Api/IliasRestApiClient.php';
require_once __DIR__ . '/../../../flux-ilias-rest-api-client/src/Adapter/Api/IliasRestApiClientConfigDto.php';

use Medi\CourseManagementBackend\Core\Ports;
use Medi\CourseManagementBackend\Adapters\Projections\Projection;
use Medi\CourseManagementBackend\Adapters\Publishers\Publisher;
use Swoole\Http;
use Medi\CourseManagementBackend\Adapters\Formatter\Formatter;
use FluxIliasRestApiClient\Adapter\Api\IliasRestApiClient;
use Medi\CourseManagementBackend\Core\Domain\Models\KeyValueObject;
use Medi\CourseManagementBackend\Adapters\Repositories;

class Api
{
    private Ports\Service $service;

    private function __construct()
    {
        $this->service = Ports\Service::new(
            Repositories\UserRepository::new(
                IliasRestApiClient::new()
            ),
            Repositories\CourseRepository::new(
                IliasRestApiClient::new()
            )
        );
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
                    Operation::ENROLL_TO_COURSE->get($restApiClient),
                    Publisher::JSON_DATA_PUBLISHER->get($this->publish($response))
                );
                break;
        }

        /**
         *   $addressParts = explode("/",$address);
         * $operationName = end($addressParts);
         * $payloadObject = json_decode($payload);
         * $payloadObject = $this->hydratePayload($address,$operationName, $payloadObject);
         */

    }

    private function handle(string $operationName, object $operation, callable $next)
    {
        $next($this->service->{$operationName}($operation));
    }

    public function process(Operation $operation, callable $publish)
    {
        $currentCommand = $operation->command;
        $result = $this->service->{$currentCommand->name}($currentCommand);
        $currentCommand->setProperty($result);

        if ($operation->next !== null) {
            $nextCommand = $operation->next->command;
            $overNextOperation = $operation->next->next;
            $nextCommand->setProperty($result);
            $this->process(
                Operation::new(
                    $nextCommand, $overNextOperation
                ),
                $publish
            );
        } else {
            $publish($currentCommand);
        }



        /*
        if ($payload->next !== null) {
            $this->handle($payload->operationName, $payload->operationPayload, fn(object $result) => $this->process(
                Operation::new(
                    $payload->next->operationName,
                    (object) array_merge((array) $payload->operation, (array) $result),
                    $payload->next->next
                ),
                $publish
            ));
        }*/

        /*$this->handle($payload->operationName, $payload->operationPayload,
            fn(object $result) => $publish(json_encode($result))
        );*/
    }

    private function hydratePayload(string $address, string $operationName, object $payloadObject)
    {
        $addressParts = explode("crsmgmt-backend", $address);

        next($addressParts);
        foreach ($addressParts as $key => $part) {
            if ($addressParts[$key] === $operationName) {
                return $payloadObject;
            }
            $payloadObject->{$addressParts[$key]} = $addressParts[$key + 1];
            next($addressParts);
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