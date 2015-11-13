<?php
namespace PackageFactory\OffRoad\HTTP\Components;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Http\Component\ComponentInterface;
use TYPO3\Flow\Http\Component\ComponentContext;

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
     * @param ComponentContext $componentContext
     * @return void
     */
    public function handle(ComponentContext $componentContext) {
        $requestUri = $componentContext->getHttpRequest()->getUri();
        $requestPath = $requestUri->getPath();

        foreach ($this->mapping as $from => $to) {
            if ($requestPath === $from) {
                $requestPath = $to;
            } else if ($requestPath === $to) {
                $response = $componentContext->getHttpResponse();
                $response->setStatus(301);
                $response->setHeader('Location', $from);
            }
        }

        $requestUri->setPath($requestPath);
    }
}
