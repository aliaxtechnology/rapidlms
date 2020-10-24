<?php


namespace Lms\Resource\Controller;


use Lms\Core\Response\BadRequestResponse;
use Lms\Core\Response\SuccessResponse;
use Lms\Resource\Services\Command\UpdateResource;
use Lms\Resource\Services\ResourceService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class UpdateResourceController
{

    /**
     * @var ResourceService
     */
    private ResourceService $resourceService;
    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;

    public function __construct(ResourceService $resourceService, ValidatorInterface $validator)
    {
        $this->resourceService = $resourceService;
        $this->validator = $validator;
    }


    /**
     * @Route("/resources", name="resource.update", methods={"PUT"})
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $command = UpdateResource::fromRequest($request->request->all());

        $errors = $this->validator->validate($command);
        if (count($errors) > 0) {
            return new BadRequestResponse($errors);
        }

        $this->resourceService->update($command);

        return new SuccessResponse();
    }
}