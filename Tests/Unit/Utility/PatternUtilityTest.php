<?php
namespace PackageFactory\OffRoad\Tests\Unit\Utility;

use TYPO3\Flow\Tests\UnitTestCase;
use PackageFactory\OffRoad\Utility\PatternUtility;

class PatternUtilityTest extends UnitTestCase {

    public function uriPatternsForRegex() {
        return [
            // Without pattern syntax
            ['/some/uri', '/' . preg_quote('/some/uri', '/') . '/'],
            ['/some/other/uri', '/' . preg_quote('/some/other/uri', '/') . '/'],
            ['/12/34', '/' . preg_quote('/12/34', '/') . '/'],
            ['/-----/+++++', '/' . preg_quote('/-----/+++++', '/') . '/'],

            // With rest part
            ['/some/...', '/' . preg_quote('/some/', '/') . '(?P<__rest0>.+)' . '/'],
            ['/some/other/...', '/' . preg_quote('/some/other/', '/') . '(?P<__rest0>.+)' . '/'],
            ['/some/.../other/...', '/' . preg_quote('/some/', '/') . '(?P<__rest0>.+)' . preg_quote('/other/', '/') . '(?P<__rest1>.+)' . '/']
        ];
    }

    /**
     * @test
     * @dataProvider uriPatternsForRegex
     */
    public function convertsSimplifiedPatternSyntaxToRegularExpression($uriPattern, $expectedResult) {
        $this->assertEquals($expectedResult, PatternUtility::translatePatternToRegex($uriPattern));
    }

    public function uriPatternsForTemplates() {
        return [
            // Without pattern syntax
            ['/some/uri', '/some/uri'],
            ['/some/other/uri', '/some/other/uri'],
            ['/12/34', '/12/34'],
            ['/-----/+++++', '/-----/+++++'],

            // With rest part
            ['/some/...', '/some/{__rest0}'],
            ['/some/other/...', '/some/other/{__rest0}'],
            ['/some/.../other/...', '/some/{__rest0}/other/{__rest1}']
        ];
    }

    /**
     * @test
     * @dataProvider uriPatternsForTemplates
     */
    public function convertsSimplifiedPatternSyntaxToTemplate($uriPattern, $expectedResult) {
        $this->assertEquals($expectedResult, PatternUtility::translatePatternToTemplate($uriPattern));
    }

}
