<?php
namespace PackageFactory\OffRoad\HTTP\Components;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Http\Component\ComponentInterface;
use TYPO3\Flow\Http\Component\ComponentContext;
use PackageFactory\OffRoad\Domain\Service\MappingService;

/**
 *
 */
class MappingComponent implements ComponentInterface {

    /**
     * @Flow\InjectConfiguration(path="mapping")
     * @var array
     */
    protected $mapping = array();

    /**
     * @Flow\Inject
     * @var MappingService
     */
    protected $mappingService;

    /**
     * @param ComponentContext $componentContext
     * @return void
     */
    public function handle(ComponentContext $componentContext) {
        $requestUri = $componentContext->getHttpRequest()->getUri();
        $requestPath = $requestUri->getPath();

        foreach ($this->mapping as $from => $to) {
            if ($this->mappingService->requestPathMatches($requestPath, $from)) {
                $requestPath = $this->mappingService->mapRequestPathToTarget($requestPath, $from, $to);;
            } else if ($this->mappingService->requestPathMatches($requestPath, $to)) {
                $response = $componentContext->getHttpResponse();
                $response->setStatus(301);
                $response->setHeader('Location', $this->mappingService->mapRequestPathToTarget($requestPath, $to, $from));
            }
        }

        $requestUri->setPath($requestPath);
    }
}
