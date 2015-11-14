<?php
namespace PackageFactory\OffRoad\Utility;

class PatternUtility {

    /**
     * Converts the simplified OffRoad pattern syntax to a reular expression
     *
     * @param string $pattern
     * @return string
     */
    public static function translatePatternToRegex($pattern) {
        //
        // Split the pattern by '/' and iterate over the result
        //
        $parts = explode('/', $pattern);

        //
        // Check each part for flag characters and convert them
        //
        $regexParts = array();

        foreach ($parts as $part) {
            switch (true) {
              default:
                  $regexParts[] = preg_quote($part, '/');
                  break;
            }
        }

        return implode('\/', $regexParts);
    }

}
