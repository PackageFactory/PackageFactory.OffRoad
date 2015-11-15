<?php
namespace PackageFactory\OffRoad\Tests\Unit\Utility;

use TYPO3\Flow\Tests\UnitTestCase;
use PackageFactory\OffRoad\Domain\Service\MappingService;

class MappingServiceTest extends UnitTestCase {

    public function matchingGroups() {
        return [
            ['/some/uri', '/some/uri', true],
            ['/some/uri', '/some/uri2', false]
        ];
    }

    /**
     * @test
     * @dataProvider matchingGroups
     */
    public function matchesRequestPaths($requestPath, $pattern, $expectedResult) {
        $mappingService = new MappingService();

        $this->assertEquals($expectedResult, $mappingService->requestPathMatches($requestPath, $pattern));
    }

}
