<?php
namespace PackageFactory\OffRoad\Tests\Unit\Utility;

use TYPO3\Flow\Tests\UnitTestCase;
use PackageFactory\OffRoad\Utility\PatternUtility;

class PatternUtilityTest extends UnitTestCase {

    public function uriPatterns() {
        return [
            ['/some/uri'],
            ['/some/other/uri'],
            ['/12/34'],
            ['/-----/+++++']
        ];
    }

    /**
     * @test
     * @dataProvider uriPatterns
     */
    public function convertsSimplifiedPatternSyntaxToRegularExpression($uriPattern) {
        $this->assertEquals('/' . preg_quote($uriPattern, '/') . '/', PatternUtility::translatePatternToRegex($uriPattern));
    }

}
