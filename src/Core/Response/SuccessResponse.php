<?php


namespace Lms\Core\Response;


use Symfony\Component\HttpFoundation\JsonResponse;

final class SuccessResponse extends JsonResponse
{

    public function __construct(array $data = [])
    {
        parent::__construct(['data' => $data], 200);
    }
}