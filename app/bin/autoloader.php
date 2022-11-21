<?php
require_once __DIR__ . "/../flux-ilias-rest-api-client/libs/flux-autoload-api/autoload.php";

$api = json_decode(
    file_get_contents( '/app/definitions/api/api.json'),
    true
);

$namespace = $api['namespace'];
$baseDirectory = '/app/src';

spl_autoload_register(function (string $class) use ($namespace, $baseDirectory) {
    $classNameParts = explode($namespace, $class);
    // not our responsibility
    if (count($classNameParts) !== 2) {
        return;
    }
    $filePath = str_replace('\\', '/', $classNameParts[1]) . '.php';
    require $baseDirectory . '/' . $filePath;
});