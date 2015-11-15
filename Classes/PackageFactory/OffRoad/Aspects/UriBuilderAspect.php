<?php
namespace PackageFactory\OffRoad\Aspects;

use TYPO3\Flow\Annotations as Flow;
use PackageFactory\OffRoad\Domain\Service\MappingService;

/**
 * @Flow\Scope("singleton")
 * @Flow\Aspect
 */
class UriBuilderAspect
{
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
     * @Flow\Around("method(TYPO3\Flow\Mvc\Routing\UriBuilder->build())")
     *
     * @param \TYPO3\FLOW\AOP\JoinPointInterface $joinPoint the join point
     *
     * @return mixed
     */
    public function aroundBuild($joinPoint)
    {
        $uri = $joinPoint->getAdviceChain()->proceed($joinPoint);

        foreach ($this->mapping as $from => $to) {
            if ($this->mappingService->requestPathMatches($uri, $to)) {
                $uri = $this->mappingService->mapRequestPathToTarget($uri , $to, $from);
            }
        }

        return $uri;
    }
}
