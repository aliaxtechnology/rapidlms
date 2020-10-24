<?php


namespace Lms\Core\Response;


use Symfony\Component\HttpFoundation\JsonResponse;

final class SuccessResponse extends JsonResponse
{

    public function __construct(array $data = [])
    {
        parent::__construct($this->formatData($data), 200);
    }

    private function formatData(array $data)
    {
        return count($data) > 0 ? ['data' => $data] : [];
    }
}