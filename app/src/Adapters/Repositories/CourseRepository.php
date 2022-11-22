<?php

namespace Medi\CourseManagementBackend\Adapters\Repositories;

use FluxIliasRestApiClient\Libs\FluxRestApi\Adapter\Api\RestApi;

class CourseRepository {
    public static function new() {
        return new self();
    }

    public function getList($parentRefId): string {
       // RestApi::new();
        return "[{refId: 20, title: 'any title', description: 'any description'}]";
    }

}