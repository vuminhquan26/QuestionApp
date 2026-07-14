<?php

namespace App\Docs;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: "Question API",
    version: "1.0.0",
    description: "API hệ thống đề thi"
)]

#[OA\Server(
    url: "http://127.0.0.1:8000",
    description: "Local Server"
)]
class OpenApi {}
