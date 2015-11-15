<?php
namespace PackageFactory\OffRoad\Domain\Service;

use TYPO3\Flow\Annotations as Flow;
use PackageFactory\OffRoad\Utility\PatternUtility;

/**
 * @Flow\Scope("singleton")
 */
class MappingService {

    /**
     * @var array
     */
    protected $memoizedRegexCache = array();

    /**
     * Checks whether a given request path matches a given simplified Uri pattern
     *
     * @param string $requestPath The request path to match
     * @param string $pattern The simplified Uri pattern to match against
     * @return boolean
     */
    public function requestPathMatches($requestPath, $pattern) {
        return preg_match($this->translatePatternToRegex($pattern), $requestPath) !== 0;
    }

    /**
     * Maps a given request path to its configured target path
     *
     * @param string $requestPath The request path
     * @param string $from The source pattern
     * @param string $to The target pattern
     * @return string
     */
    public function mapRequestPathToTarget($requestPath, $from, $to) {
        if (preg_match($this->translatePatternToRegex($from), $requestPath, $matches)) {
            $result = PatternUtility::translatePatternToTemplate($to);
            foreach ($matches as $key => $value) {
                if (is_string($key)) {
                    $result = str_replace(sprintf('{%s}', $key), $value, $result);
                }
            }

            return $result;
        }

        return $requestPath;
    }

    /**
     * Helper function to convert the simplified OffRoad pattern syntax to a reular expression
     *
     * @return string
     */
    protected function translatePatternToRegex($pattern) {
        if (!isset($this->memoizedRegexCache[ $pattern ])) {
            $this->memoizedRegexCache[ $pattern ] = PatternUtility::translatePatternToRegex($pattern);
        }

        return $this->memoizedRegexCache[ $pattern ];
    }

}
