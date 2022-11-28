<?php
require_once __DIR__ . '/../autoload.php';

//todo
require_once  __DIR__ . '/../flux-ilias-rest-api-client/src/Adapter/Api/IliasRestApiClient.php';
require_once  __DIR__ . '/../flux-ilias-rest-api-client/src/Adapter/Api/IliasRestApiClientConfigDto.php';

use Medi\CourseManagementBackend\Adapters\Api\Api;

$server = new Swoole\Http\Server('0.0.0.0', getenv('SWOOLE_HTTP_PORT'));
//'SWOOLE_HTTP_WORKER_NUM'
$server->set(
    [
        'worker_num' => getenv(1),        //number of worker processes
        'max_conn' => getenv('SWOOLE_HTTP_MAX_CONN'),           //Maximum number of connections allowed. This parameter is used to set the maximum number of TCP connections allowed by the Server. After this number is exceeded, new incoming connections will be rejected.
        'max_request' => getenv('SWOOLE_HTTP_MAX_REQUEST'),       //This parameter indicates that the worker process ends after processing n requests. The manager will recreate a worker process. This option is used to prevent memory overflow in the worker process.
        'task_worker_num' => getenv('SWOOLE_HTTP_TASK_WORKER_NUM'),    //Set the maximum number of tasks for the task process
        'task_ipc_mode' => getenv('SWOOLE_HTTP_IPC_MODE'),      //1 evenly distributed, 2 fixed distribution according to FD, 3 preemptive distribution, default is dispatch (dispatch=2)
        'task_max_request' => getenv('SWOOLE_HTTP_TASK_MAX_REQUEST'),   // daemonize
        'dispatch_mode' => getenv('SWOOLE_HTTP_DISPATCH_MODE'),     //How many connections are waiting to accept at the same time
        'daemonize' => getenv('SWOOLE_HTTP_DAEMONIZE'),           //tcp keepalive
        'backlog' => getenv('SWOOLE_HTTP_BACKLOG'),           //Accept is triggered when a TCP connection has data to send
        'open_tcp_keepalive' => getenv('SWOOLE_HTTP_OPEN_TCP_KEEPALIVE'), //tcp keepalive
        'tcp_defer_accept' => getenv('SWOOLE_HTTP_TCP_DEFER_ACCEPT'),   //Accept is triggered when a TCP connection has data to send
        'open_tcp_nodelay' => getenv('SWOOLE_HTTP_OPEN_TCP_NODELAY'),   //When the TCP connection is opened, when sending data, the Nagle merge algorithm will not be closed, and it will be sent to the client connection immediately. In some scenarios, such as Http server, the response speed can be improved.
        //'log_file' => getenv('SWOOLE_HTTP_LOG_FILE_PATH_NAME'),  //log file path
        'document_root' => '/app/data/public',
        'enable_static_handler' => true,
    ]
);

$onRequest = function ($request, $response) use ($server) {
    $rawData = $request->rawContent();
    echo '[' . date('Y-m-d H:i:s') . ']'. PHP_EOL . 'Channel ==>' . $request->server['request_uri'] . PHP_EOL . 'Content of request ==> ' . $rawData . PHP_EOL;

    $httpApi =  Api::new();
    $httpApi->handleHttpRequest($request, $response);
};

$server->on('request', $onRequest);

$server->on('Finish', function ($serv, $task_id, $data) {
    echo "Asynchronous task completed [{$task_id}],data:" . $data . PHP_EOL;
});

$server->on('Task', function ($serv, $task_id, $from_id, $data) {
    echo "New asynchronous task [from process {$from_id}, current process {$task_id}], data:" . $data . PHP_EOL;
    $data = unserialize($data);
    if (is_array($data)) {
        $serv->finish('task -> OK');
    }
});

$server->on('Start', function ($serv) {
    cli_set_process_title('flux-ecosystem_server_http');
    echo 'server has startet';
});


$onWorkerStart = function ($serv, $worker_id) {
    if ($worker_id >= $serv->setting['worker_num']) {
        cli_set_process_title('flux-ecosystem_server_http:task_worker_' . $worker_id);
    } else {
        cli_set_process_title('flux-ecosystem_server_http:worker');

    }
};
$server->on('WorkerStart', $onWorkerStart);


$server->on('ManagerStart', function ($serv) {
    cli_set_process_title('flux-ecosystem_server_http:manager');
});

$server->on('Shutdown', function ($serv) {
    echo 'Shutdown' . PHP_EOL;
});

$server->on('WorkerError', function ($serv, $worker_id, $worker_pid, $exit_code) {
});

$server->start();