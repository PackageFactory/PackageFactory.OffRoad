<?php
namespace PackageFactory\OffRoad\Tests\Unit\Utility;

use TYPO3\Flow\Tests\UnitTestCase;
use PackageFactory\OffRoad\Domain\Service\MappingService;

class MappingServiceTest extends UnitTestCase {

    public function matchingGroups() {
        return [
            // Equal
            ['/some/uri', '/some/uri', true],
            ['/some/uri', '/some/uri2', false],

            // Rest
            ['/some/uri', '/some/...', true],
            ['/some/other/uri', '/some/...', true],
            ['/different/uri', '/some/...', false]
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

    public function mappingResults() {
        return [
              // Equal
              ['/some/uri', '/some/uri', '/some/other/uri', '/some/other/uri'],

              // Rest
              ['/some/uri', '/some/...', '/some/other/uri', '/some/other/uri'],
              ['/some/thing', '/some/...', '/some/other/...', '/some/other/thing'],
              ['/long/uri/with/a/lot/of/parts', '/long/.../of/...', '/.../.../test', '/uri/with/a/lot/parts/test']
        ];
    }

    /**
     * @test
     * @dataProvider mappingResults
     */
    public function mapsRequestPathToTheirTarget($requestPath, $from, $to, $expectedResult) {
        $mappingService = new MappingService();

        $this->assertEquals($expectedResult, $mappingService->mapRequestPathToTarget($requestPath, $from, $to));
    }

}
