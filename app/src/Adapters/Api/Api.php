<?php

namespace Medi\CourseManagementBackend\Adapters\Api;

//todo
require_once __DIR__ . '/../../../flux-ilias-rest-api-client/src/Adapter/Api/IliasRestApiClient.php';
require_once __DIR__ . '/../../../flux-ilias-rest-api-client/src/Adapter/Api/IliasRestApiClientConfigDto.php';

use Medi\CourseManagementBackend\Core\Ports;
use ProcessHandler;
use Swoole\Http;
use FluxIliasRestApiClient\Adapter\Api\IliasRestApiClient;
use Medi\CourseManagementBackend\Core\Ports\Commands;
use Medi\CourseManagementBackend\Core\Domain;
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
            ),
            Repositories\CategoryRepository::new(
                IliasRestApiClient::new()
            )
        );
    }

    public static function new(): self
    {
        return new self();
    }

    /**
     * @throws \Exception
     */
    final public function handleHttpRequest(Http\Request $request, Http\Response $response): void
    {
        $requestUri = $request->server['request_uri'];

        $getCommand = function ($requestUri) {
            $parts = explode("/", $requestUri);
            //first part is an empty string.
            $payload = Domain\Models\Value::from($parts[1])->get($parts[2]);
            return Commands\Command::from($parts[array_key_last($parts)])->get($payload);
        };


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

        //postRequest
        if ($request->rawContent()) {
            $payload = json_decode($request->rawContent());
            $process = Process::fromPayload($payload);
            $this->process($process, $this->publish($response));
        }

        //handleProcessRequest
        if (str_contains($requestUri, 'handle')) {
            require_once __DIR__ . "/../../../definitions/processes/ProcessHandler.php";

            $process = $getParam('process'); //todo enum

            $value = Domain\Models\Institution::new($getParam('institution')); //todo from ValueEnum

            $params = Domain\Models\Params::new([$value]);

            ProcessHandler::from($process)->process($params);


            $this->publish($response)(Domain\Models\BoolValue::new(true));
        }

        //queries
        switch (true) {
            case str_contains($requestUri, 'get'):
                $command = $getCommand($requestUri);
                $this->publish($response)($this->service->{$command->name}($command));
                break;
        }
    }

    /**
     * @param Commands\CommandInstance[] $commands
     * @param callable $next
     * @return void
     */
    private function handle(array $commands, callable $onNext)
    {
        $results = [];
        foreach ($commands as $command) {
            $results[] = $this->service->{$command->name}($command);
        }
        $onNext($results);
    }

    public function process(Process $process, ?callable $onPublish = null)
    {
        if ($process->next !== null) {
            $nextProcess = $process->next;
            $onNext = function (array $results) use ($nextProcess, $onPublish) {
                $nextCommands = $nextProcess->commands;
                foreach ($nextCommands as $nextCommand) {
                    foreach ($results as $result) {
                        //todo - create a new command?
                        $nextCommand->setProperty($result);
                    }
                }
                $this->process(Process::new($nextCommands, $nextProcess->next), $onPublish);
            };
        } else {
            $onNext = function (array $result) use ($onPublish) {
                if ($onPublish !== null) {
                    $onPublish(Processed::new($result));
                }
            };
        }

        $this->handle($process->commands, $onNext);
    }

    private function publish(Http\Response $response)
    {
        return function (object $result) use ($response) {
            $response->header('Content-Type', 'application/json');
            $response->header('Cache-Control', 'no-cache');
            $response->end(json_encode($result)); //json_encode($data, JSON_UNESCAPED_UNICODE)
        };
    }
}