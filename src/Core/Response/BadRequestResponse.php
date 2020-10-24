<?php


namespace Lms\Core\Response;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class BadRequestResponse extends JsonResponse
{

    /**
     * ErrorReponse constructor.
     * @param ConstraintViolationListInterface $errors
     */
    public function __construct(ConstraintViolationListInterface $errors)
    {
        parent::__construct($this->formatError($errors), 422);
    }

    private function formatError(ConstraintViolationListInterface $errors): array
    {
        $errorsFormated = [];

        /**
         * @var ConstraintViolationInterface $error
         */
        foreach ($errors as $error) {
            $errorsFormated[$error->getPropertyPath()][] = $error->getMessage();
        }

        return ['errors' => $errorsFormated];
    }
}