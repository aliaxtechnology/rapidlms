<?php


namespace Lms\Resource\Controller;


use Lms\Resource\Services\Command\CreateResource;
use Lms\Resource\Services\ResourceService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CreateResourceController
{

    /**
     * @var ResourceService
     */
    private ResourceService $resourceService;

    public function __construct(ResourceService $resourceService)
    {
        $this->resourceService = $resourceService;
    }


    /**
     * @Route("/resources", name="resource.create", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $command = new CreateResource($request->get('name'));

        $this->resourceService->create($command);

        return new Response();
    }
}